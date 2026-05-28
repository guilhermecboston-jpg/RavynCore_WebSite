#!/usr/bin/php8.2
<?php
/**
 * Testa criação de Checkout Session no servidor (sem MySQL).
 * Uso: php deploy/test-stripe-checkout.php
 *
 * Nota: o PHP CLI precisa da extensão curl (php8.2-curl).
 * O donate no site usa php-fpm, que pode ter curl mesmo se o CLI não tiver.
 */
chdir(dirname(__DIR__));
require 'common.php';
require_once SYSTEM . 'functions.php';
require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

if (!extension_loaded('curl')) {
    fwrite(STDERR, "Este PHP CLI não tem extensão 'curl'.\n");
    fwrite(STDERR, "Instale: sudo apt install -y php8.2-curl && sudo systemctl restart php8.2-fpm\n");
    fwrite(STDERR, "Ou teste direto no site: Donate → Stripe (php-fpm costuma ter curl).\n");
    fwrite(STDERR, "Verifique FPM: php-fpm8.2 -m 2>/dev/null | grep -i curl || php -m | grep curl\n");
    exit(2);
}

if (!defined('BASE_URL')) {
    $base = (string)($config['payment_public_url'] ?? $config['public_url'] ?? 'https://ravyncore.com/');
    define('BASE_URL', rtrim($base, '/') . '/');
}

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
