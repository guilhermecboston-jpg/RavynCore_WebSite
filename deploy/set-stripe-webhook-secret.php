#!/usr/bin/env php
<?php
/**
 * Grava whsec_ em config/ravyncore.stripe.local.php (persiste após git pull).
 * Uso: php deploy/set-stripe-webhook-secret.php whsec_xxxxxxxx
 */
$wh = trim($argv[1] ?? '');
if ($wh === '' || !str_starts_with($wh, 'whsec_') || strlen($wh) < 32) {
    fwrite(STDERR, "Uso: php deploy/set-stripe-webhook-secret.php whsec_...\n");
    fwrite(STDERR, "O secret tem ~32+ caracteres. Copie em Stripe → Webhooks → Reveal secret.\n");
    exit(1);
}

if (preg_match('/(COLE|AQUI|VALOR_REAL|EXEMPLO|\.\.\.)/i', $wh)) {
    fwrite(STDERR, "Erro: isso é texto de exemplo, não o whsec_ real do Stripe Dashboard.\n");
    exit(1);
}

$dir = dirname(__DIR__) . '/config';
$file = $dir . '/ravyncore.stripe.local.php';
$content = "<?php\n"
    . "defined('MYAAC') or die('Direct access not allowed!');\n\n"
    . "\$config['stripe']['webhookSecret']['production'] = " . var_export($wh, true) . ";\n"
    . "\$config['stripe']['webhookSecret']['sandbox'] = '';\n";

if (file_put_contents($file, $content) === false) {
    fwrite(STDERR, "Não foi possível gravar {$file}\n");
    exit(1);
}

@chmod($file, 0640);
echo "webhookSecret gravado em config/ravyncore.stripe.local.php (não é apagado no git pull)\n";
passthru('php ' . escapeshellarg(dirname(__DIR__) . '/deploy/check-stripe.php'));
