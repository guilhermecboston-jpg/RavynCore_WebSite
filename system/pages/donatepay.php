<?php
global $config, $logged, $account_logged, $db;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

if (!$logged) {
    echo 'Você precisa estar logado.';
    return;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Location: ' . getLink('donate'));
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

if (!in_array($gateway, ['mercadopago', 'stripe'], true)) {
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
