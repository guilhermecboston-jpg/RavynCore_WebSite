<?php
global $config, $twig, $logged, $account_logged;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

$hasMercadoPago = false;
$hasStripe = false;

if (file_exists(PLUGINS . 'mercadopago/config.php')) {
    require_once PLUGINS . 'mercadopago/config.php';
    $hasMercadoPago = ($config['mercadoPago']['enabled'] ?? false)
        && ravynDonateMercadoPagoAccessToken() !== '';
}

if (file_exists(PLUGINS . 'stripe/config.php')) {
    require_once PLUGINS . 'stripe/config.php';
    $hasStripe = ($config['stripe']['enabled'] ?? false);
}

ravynDonateSyncGatewayPackages();

if (!$hasMercadoPago && !$hasStripe) {
    echo 'Nenhum gateway de doação configurado.';
    return;
}

if (!extension_loaded('curl')) {
    echo 'Extensão PHP cURL é obrigatória para doações.';
    return;
}

$is_localhost = strpos(BASE_URL, 'localhost') !== false || strpos(BASE_URL, '127.0.0.1') !== false;
$enableDonateLocal = $config['enableDonateLocal'] ?? false;

if (empty($action)) {
    if (!$logged) {
        $was_before = $config['friendly_urls'];
        $config['friendly_urls'] = true;
        echo 'Para comprar coins você precisa estar logado. '
            . generateLink(getLink('?subtopic=accountmanagement') . '&redirect=' . urlencode(getLink('donate')), 'Faça login')
            . ' e volte para esta página.';
        $config['friendly_urls'] = $was_before;
        return;
    }

    echo $twig->render('donate-coins.html.twig', [
        'account_name' => $account_logged->getName(),
        'account_id' => $account_logged->getId(),
        'packages' => ravynDonatePackages(),
        'terms_bullets' => ravynDonateTermsBullets(),
        'terms_version' => ravynDonateTermsVersion(),
        'has_mercado_pago' => $hasMercadoPago,
        'has_stripe' => $hasStripe,
        'has_pix' => ravynDonatePixEnabled(),
        'pay_url' => getLink('donatepay'),
        'is_localhost' => $is_localhost,
        'enable_donate_local' => $enableDonateLocal,
        'payment_base_url' => ravynPublicBaseUrl(),
    ]);
} elseif ($action === 'final') {
    $orderRef = $_GET['order'] ?? '';
    echo $twig->render('donate-final.html.twig', [
        'order_ref' => htmlspecialchars($orderRef, ENT_QUOTES, 'UTF-8'),
        'gateway' => htmlspecialchars($_GET['gateway'] ?? '', ENT_QUOTES, 'UTF-8'),
    ]);
}
