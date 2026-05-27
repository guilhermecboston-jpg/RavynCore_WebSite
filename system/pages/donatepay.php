<?php
global $config, $logged, $account_logged, $db;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

function ravynDonateBackBox(string $title, string $message): void
{
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

$packageId = trim($_POST['package_id'] ?? '');
$gateway = trim($_POST['gateway'] ?? '');
$fullName = trim($_POST['full_name'] ?? '');
$birthDate = trim($_POST['birth_date'] ?? '');
$region = ($_POST['region'] ?? 'BR') === 'INTL' ? 'INTL' : 'BR';
$email = trim($_POST['email'] ?? '');
$termsAgree = ($_POST['terms_agree'] ?? '') === '1';

if (!$termsAgree) {
    echo 'Você precisa aceitar os Termos e Condições.';
    return;
}

$packages = ravynDonatePackages();
if (!isset($packages[$packageId])) {
    echo 'Pacote inválido.';
    return;
}

if (!in_array($gateway, ['mercadopago', 'stripe', 'pix'], true)) {
    echo 'Gateway inválido.';
    return;
}

if (strlen($fullName) < 3) {
    echo 'Informe o nome completo.';
    return;
}

if (!ravynDonateValidateBirthDate($birthDate)) {
    echo 'Data de nascimento inválida (use DD/MM/AAAA).';
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'E-mail inválido.';
    return;
}

$taxId = '';
if ($region === 'BR') {
    $taxId = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    if (!ravynDonateValidateCpf($taxId)) {
        echo 'CPF inválido.';
        return;
    }
    if (!ravynDonateVerifyCpfIdentity($taxId, $fullName, $birthDate)) {
        echo 'Não foi possível validar CPF + nome + data de nascimento na base externa configurada.';
        return;
    }
} else {
    $taxId = trim($_POST['document'] ?? '');
    if (strlen($taxId) < 4) {
        echo 'Documento inválido.';
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
    echo 'Erro ao registrar pedido.';
    return;
}

if ($gateway === 'pix') {
    $fakePixCode = 'PIX_PLACEHOLDER_' . $order['order_ref'];
    $db->exec(
        'UPDATE `ravyn_donate_orders` SET `status` = \'pending\', `gateway_ref` = '
        . $db->quote($fakePixCode) . ' WHERE `id` = ' . (int)$order['id']
    );
    echo '<div style="max-width:520px;margin:20px auto;padding:16px;border:1px solid #3a4a6a;border-radius:12px;background:#1a2238;color:#e2ebff;font-family:Verdana,Arial,sans-serif">';
    echo '<h2 style="margin:0 0 12px;color:#f0c86a;">Aguardando Pagamento PIX</h2>';
    echo '<p style="margin:0 0 10px;">PIX ainda não está ativo neste gateway. O fluxo já está preparado para ativar QR Code em seguida.</p>';
    echo '<div style="padding:12px;background:#0f1524;border:1px solid #425683;border-radius:8px;margin-bottom:10px">';
    echo '<strong>Pedido:</strong> ' . htmlspecialchars($order['order_ref'], ENT_QUOTES, 'UTF-8') . '<br/>';
    echo '<strong>Status:</strong> pending<br/>';
    echo '<strong>Código PIX (placeholder):</strong> ' . htmlspecialchars($fakePixCode, ENT_QUOTES, 'UTF-8');
    echo '</div>';
    echo '<a href="' . htmlspecialchars(getLink('donate'), ENT_QUOTES, 'UTF-8') . '" style="display:inline-block;padding:9px 14px;background:#c99a3b;color:#1a1205;text-decoration:none;border-radius:6px;font-weight:bold">Voltar</a>';
    echo '</div>';
    return;
}

$checkoutUrl = null;
if ($gateway === 'mercadopago') {
    $checkoutUrl = ravynDonateCreateMercadoPagoCheckout($order);
} else {
    $checkoutUrl = ravynDonateCreateStripeCheckout($order);
}

if (!$checkoutUrl) {
    echo 'Não foi possível abrir o gateway de pagamento. Tente novamente.';
    return;
}

$db->exec(
    'UPDATE `ravyn_donate_orders` SET `status` = \'redirected\', `gateway_ref` = '
    . $db->quote($checkoutUrl) . ' WHERE `id` = ' . (int)$order['id']
);

header('Location: ' . $checkoutUrl);
exit;
