<?php
/**
 * Testa criação de preferência Mercado Pago (Checkout Pro).
 * Uso na VPS: /usr/bin/php8.2 deploy/test-mp-preference.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
require $root . '/common.php';
require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

$token = ravynDonateMercadoPagoAccessToken();
if ($token === '') {
    fwrite(STDERR, "ERRO: accessToken Mercado Pago vazio (config.local.php).\n");
    exit(1);
}

$order = [
    'order_ref' => 'TEST-' . date('YmdHis'),
    'package_id' => 'test',
    'account_id' => 1,
    'coins' => 1000,
    'amount_brl' => 1.0,
    'full_name' => 'Teste RavynCore',
    'email' => 'teste@example.com',
    'tax_id' => '52998224725',
    'region' => 'BR',
];

$error = '';
$url = ravynDonateCreateMercadoPagoCheckout($order, $error);
if ($url === null) {
    fwrite(STDERR, "ERRO: {$error}\n");
    exit(1);
}

echo "OK\n";
echo "init_point: {$url}\n";
