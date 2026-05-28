#!/usr/bin/env php
<?php
/**
 * Diagnóstico Stripe no VPS (não expõe a chave inteira):
 *   php deploy/check-stripe.php
 */
chdir(dirname(__DIR__));
require 'common.php';
require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

$stripe = $config['stripe'] ?? [];
$env = $stripe['environment'] ?? '(não definido)';
$prod = trim((string)($stripe['secretKey']['production'] ?? ''));
$sandbox = trim((string)($stripe['secretKey']['sandbox'] ?? ''));
$active = ravynDonateStripeSecretKey();
$problem = ravynDonateStripeSecretKeyProblem($active);
$prefix = $active !== '' ? substr($active, 0, 8) : '(vazio)';

function mask_key(string $key): string
{
    if ($key === '') {
        return '(vazio)';
    }
    if (strlen($key) < 12) {
        return '(curto demais: ' . strlen($key) . ' chars)';
    }

    return substr($key, 0, 7) . '…' . substr($key, -4) . ' [' . strlen($key) . ' chars]';
}

echo "environment: {$env}\n";
echo "secretKey[production]: " . mask_key($prod) . "\n";
echo "secretKey[sandbox]:    " . mask_key($sandbox) . "\n";
echo "chave usada pelo donate: " . mask_key($active) . " prefixo={$prefix}\n";
echo "ok: " . ($problem === '' ? 'SIM' : 'NÃO — ' . $problem) . "\n";

$wh = trim((string)($stripe['webhookSecret']['production'] ?? ''));
if ($wh === '') {
    echo "webhookSecret[production]: (vazio)\n";
    echo "  → php deploy/set-stripe-webhook-secret.php whsec_...  (Stripe → Webhooks → Reveal secret)\n";
} elseif (!str_starts_with($wh, 'whsec_')) {
    echo "webhookSecret[production]: inválido (deve começar com whsec_, não sk_)\n";
} else {
    echo "webhookSecret[production]: " . mask_key($wh) . " ok\n";
}

$envVar = getenv('STRIPE_SECRET_KEY');
if ($envVar !== false && $envVar !== '') {
    echo "AVISO: variável STRIPE_SECRET_KEY no PHP está definida (" . mask_key((string)$envVar) . ") — remova do php-fpm se não usar.\n";
}
