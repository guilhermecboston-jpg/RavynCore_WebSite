#!/usr/bin/env php
<?php
/**
 * Grava whsec_ em config/ravyncore.stripe.php no VPS.
 * Uso: php deploy/set-stripe-webhook-secret.php whsec_xxxxxxxx
 */
$wh = trim($argv[1] ?? '');
if ($wh === '' || !str_starts_with($wh, 'whsec_') || strlen($wh) < 20) {
    fwrite(STDERR, "Uso: php deploy/set-stripe-webhook-secret.php whsec_...\n");
    fwrite(STDERR, "Copie o Signing secret em: Stripe Dashboard → Webhooks → Reveal secret\n");
    exit(1);
}

$file = dirname(__DIR__) . '/config/ravyncore.stripe.php';
if (!is_file($file)) {
    fwrite(STDERR, "Arquivo não encontrado: {$file}\nRode: bash deploy/server-git-pull.sh\n");
    exit(1);
}

$content = file_get_contents($file);
if ($content === false) {
    fwrite(STDERR, "Não foi possível ler {$file}\n");
    exit(1);
}

$replacement = "\$config['stripe']['webhookSecret']['production'] = " . var_export($wh, true) . ';';
$newContent = preg_replace(
    "/\\\$config\\['stripe'\\]\\['webhookSecret'\\]\\['production'\\]\\s*=\\s*'[^']*';/",
    $replacement,
    $content,
    1,
    $count
);

if ($count < 1) {
    fwrite(STDERR, "Linha webhookSecret['production'] não encontrada em {$file}\n");
    exit(1);
}

if (file_put_contents($file, $newContent) === false) {
    fwrite(STDERR, "Não foi possível gravar {$file}\n");
    exit(1);
}

echo "webhookSecret gravado em config/ravyncore.stripe.php\n";
passthru('php ' . escapeshellarg(dirname(__DIR__) . '/deploy/check-stripe.php'));
