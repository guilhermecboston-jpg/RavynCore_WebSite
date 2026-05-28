#!/usr/bin/env php
<?php
/**
 * Testa criação de Checkout Session no servidor.
 * Uso: php deploy/test-stripe-checkout.php
 */
chdir(dirname(__DIR__));
require 'common.php';
require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

$order = [
    'order_ref' => 'RD-TEST-' . time(),
    'package_id' => 'pack_100',
    'account_id' => 1,
    'email' => 'test@ravyncore.com',
    'coins' => 100,
    'amount_brl' => 10.0,
];

$error = '';
$sessionId = '';
$url = ravynDonateCreateStripeCheckout($order, $error, $sessionId);

if ($url) {
    echo "OK\n";
    echo "session: {$sessionId}\n";
    echo "url: {$url}\n";
    exit(0);
}

echo "FALHA: {$error}\n";
exit(1);
