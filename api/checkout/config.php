<?php
/**
 * API checkout OTC (RavynCore client) — pacotes USD + MP/Stripe.
 * Credenciais MP/Stripe vêm do MyAAC (plugins) quando common.php está disponível.
 */
$siteRoot = dirname(__DIR__, 2);

$cfg = [
    'site_url' => getenv('RAVYN_SITE_URL') ?: 'http://177.55.153.178',
    'packages' => [
        'pack_100' => ['coins' => 100, 'amount_usd' => 10.00],
        'pack_1000' => ['coins' => 1000, 'amount_usd' => 100.00],
        'pack_3150' => ['coins' => 3150, 'amount_usd' => 300.00],
        'pack_10500' => ['coins' => 10500, 'amount_usd' => 1000.00],
        'pack_73500' => ['coins' => 73500, 'amount_usd' => 7000.00],
        'pack_135000' => ['coins' => 135000, 'amount_usd' => 10000.00],
    ],
    'mp_methods' => [
        'credit_card' => ['label' => 'Novo Cartão'],
        'two_cards' => ['label' => '2 cartões'],
        'debit_card' => ['label' => 'Débito CAIXA'],
        'pix' => ['label' => 'PIX'],
    ],
    'mercadopago' => ['access_token' => getenv('MP_ACCESS_TOKEN') ?: ''],
    'stripe' => ['secret_key' => getenv('STRIPE_SECRET_KEY') ?: ''],
    'donation_field' => 'coins_transferable',
];

$forcedSiteUrl = getenv('RAVYN_SITE_URL');

if (is_file($siteRoot . '/config.local.php')) {
    require_once $siteRoot . '/common.php';
    require_once SYSTEM . 'init.php';
    require_once PLUGINS . 'mercadopago/config.php';

    global $config;

    if (empty($forcedSiteUrl) && !empty($config['public_url'])) {
        $cfg['site_url'] = rtrim($config['public_url'], '/');
    }

    $env = $config['mercadoPago']['environment'] ?? 'production';
    $token = $config['mercadoPago']['accessToken'][$env] ?? '';
    if ($token !== '') {
        $cfg['mercadopago']['access_token'] = $token;
    }

    if (is_file(PLUGINS . 'stripe/config.php')) {
        require_once PLUGINS . 'stripe/config.php';
        $stripeKey = $config['stripe']['secretKey'][$config['stripe']['environment'] ?? 'production'] ?? '';
        if ($stripeKey !== '') {
            $cfg['stripe']['secret_key'] = $stripeKey;
        }
    }

    $cfg['donation_field'] = strtolower($config['mercadoPago']['donationType'] ?? 'coins_transferable');
}

if (strpos($cfg['site_url'], 'ravyncore.com') !== false) {
    $cfg['site_url'] = 'http://177.55.153.178';
}

return $cfg;
