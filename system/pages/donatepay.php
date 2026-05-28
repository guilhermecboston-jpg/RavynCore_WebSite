<?php
global $config, $logged, $account_logged, $db;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

function ravynDonateBackBox(string $title, string $message): void
{
    if (ravynDonateWantsJson()) {
        ravynDonateJsonResponse(['ok' => false, 'error' => $message], 400);
    }
    $back = getLink('donate');
    echo '<div style="max-width:700px;margin:20px auto;padding:20px;background:#1a2238;border:1px solid #3a4a6a;border-radius:10px;color:#d8e4ff;font-family:Verdana,Arial,sans-serif">';
    echo '<h2 style="margin:0 0 10px;color:#f0c86a;">' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h2>';
    echo '<p style="margin:0 0 14px;">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '<a href="' . htmlspecialchars($back, ENT_QUOTES, 'UTF-8') . '" style="display:inline-block;padding:10px 16px;background:#c99a3b;color:#1a1205;text-decoration:none;border-radius:6px;font-weight:bold">Voltar para Donate</a>';
    echo '</div>';
}

if (!$logged) {
    ravynDonateBackBox('Login necessário', 'Você precisa estar logado para continuar o pagamento.');
    return;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    ravynDonateBackBox('Ação inválida', 'Esta página é usada para processar pagamentos. Selecione um pacote e tente novamente.');
    return;
}

ravynDonateEnsureSchema($db);

$packageId = trim($_POST['package_id'] ?? '');
$gateway = trim($_POST['gateway'] ?? '');
$fullName = trim($_POST['full_name'] ?? '');
$birthDate = ravynDonateNormalizeBirthDate(trim($_POST['birth_date'] ?? ''));
$region = ($_POST['region'] ?? 'BR') === 'INTL' ? 'INTL' : 'BR';
$email = trim($_POST['email'] ?? '');
$termsAgree = ($_POST['terms_agree'] ?? '') === '1';

if (!$termsAgree) {
    ravynDonateBackBox('Donatepay', 'Você precisa aceitar os Termos e Condições.');
    return;
}

$packages = ravynDonatePackages();
if (!isset($packages[$packageId])) {
    ravynDonateBackBox('Donatepay', 'Pacote inválido.');
    return;
}

if (!in_array($gateway, ['mercadopago', 'stripe', 'pix'], true)) {
    ravynDonateBackBox('Donatepay', 'Gateway inválido.');
    return;
}

if (strlen($fullName) < 3) {
    ravynDonateBackBox('Donatepay', 'Informe o nome completo.');
    return;
}

if (!ravynDonateValidateBirthDate($birthDate)) {
    ravynDonateBackBox('Donatepay', 'Data de nascimento inválida (use DD/MM/AAAA).');
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ravynDonateBackBox('Donatepay', 'E-mail inválido.');
    return;
}

$taxId = '';
if ($region === 'BR') {
    $taxId = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    if (!ravynDonateValidateCpf($taxId)) {
        ravynDonateBackBox('Donatepay', 'CPF inválido.');
        return;
    }
    if (!ravynDonateVerifyCpfIdentity($taxId, $fullName, $birthDate)) {
        ravynDonateBackBox('Donatepay', 'Não foi possível validar CPF + nome + data de nascimento na base externa configurada.');
        return;
    }
} else {
    $taxId = trim($_POST['document'] ?? '');
    if (strlen($taxId) < 4) {
        ravynDonateBackBox('Donatepay', 'Documento inválido.');
        return;
    }
}

$pack = $packages[$packageId];
$accountId = (int)$account_logged->getId();

$order = ravynDonateCreateOrder($db, [
    'account_id' => $accountId,
    'account_name' => $account_logged->getName(),
    'package_id' => $packageId,
    'gateway' => $gateway,
    'coins' => (int)$pack['coins'],
    'amount_brl' => (float)$pack['brl'],
    'full_name' => $fullName,
    'birth_date' => $birthDate,
    'region' => $region,
    'tax_id' => $taxId,
    'email' => $email,
    'terms_version' => ravynDonateTermsVersion(),
]);

if (!$order) {
    ravynDonateBackBox('Donatepay', 'Erro ao registrar pedido.');
    return;
}

if ($gateway === 'pix') {
    if (!ravynDonatePixEnabled()) {
        ravynDonateBackBox('Donatepay', 'Pagamento PIX não está habilitado.');
        return;
    }

    $pixError = '';
    $pixData = ravynDonateCreateMercadoPagoPix($order, $pixError);
    if (!$pixData || empty($pixData['payment_id']) || empty($pixData['qr_code'])) {
        $msg = $pixError !== '' ? $pixError : 'Não foi possível gerar PIX via Mercado Pago.';
        $msg .= ' Verifique token/credenciais e tente novamente.';
        ravynDonateBackBox('Donatepay', $msg);
        return;
    }

    try {
        $db->exec(
            'UPDATE `ravyn_donate_orders` SET `status` = \'pending\', `payment_id` = '
            . $db->quote((string)($pixData['payment_id'] ?? '')) . ', `gateway_ref` = '
            . $db->quote((string)$pixData['qr_code']) . ', `payment_status` = '
            . $db->quote((string)($pixData['status'] ?? 'pending'))
            . ' WHERE `id` = ' . (int)$order['id']
        );
    } catch (Throwable $e) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' pix update: ' . $e->getMessage());
        ravynDonateBackBox('Donatepay', 'Erro ao salvar dados do PIX. Tente novamente.');
        return;
    }

    ravynDonateJsonResponse([
        'ok' => true,
        'type' => 'pix',
        'order_ref' => $order['order_ref'],
        'coins' => (int)$order['coins'],
        'amount_brl' => (float)$order['amount_brl'],
        'amount_label' => 'R$ ' . number_format((float)$order['amount_brl'], 2, ',', '.'),
        'qr_code' => (string)$pixData['qr_code'],
        'qr_code_base64' => (string)($pixData['qr_code_base64'] ?? ''),
        'qr_image' => (string)($pixData['qr_image'] ?? 'images/payments/pix-qrcode-mercadopago.png'),
        'payment_status' => (string)($pixData['status'] ?? 'pending'),
        'status_url' => BASE_URL . '?subtopic=donatepixstatus&order=' . urlencode((string)$order['order_ref']),
        'loyalty_points' => ravynDonateOrderLoyaltyPoints($order),
        'success_display_seconds' => max(8, (int)(ravynDonatePixConfig()['success_display_seconds'] ?? 12)),
        'redirect_delay_seconds' => max(8, (int)(ravynDonatePixConfig()['final_delay_seconds'] ?? 15)),
    ]);
}

$checkoutUrl = null;
$gatewayError = '';
if ($gateway === 'mercadopago') {
    $checkoutUrl = ravynDonateCreateMercadoPagoCheckout($order, $gatewayError);
} else {
    $checkoutUrl = ravynDonateCreateStripeCheckout($order, $gatewayError);
}

if (!$checkoutUrl) {
    $msg = $gatewayError !== '' ? $gatewayError : 'Não foi possível abrir o gateway de pagamento. Tente novamente.';
    ravynDonateBackBox('Donatepay', $msg);
    return;
}

$db->exec(
    'UPDATE `ravyn_donate_orders` SET `status` = \'redirected\', `gateway_ref` = '
    . $db->quote($checkoutUrl) . ' WHERE `id` = ' . (int)$order['id']
);

ravynDonateRedirectTo($checkoutUrl);
