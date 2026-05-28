<?php
/**
 * Verifica se a conta vendedora aceita PIX via API (indício de chave Pix ativa).
 * Uso na VPS: /usr/bin/php8.2 deploy/check-mp-pix.php
 */
declare(strict_types=1);

$root = dirname(__DIR__);
require $root . '/common.php';
require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

$token = ravynDonateMercadoPagoAccessToken();
if ($token === '') {
    fwrite(STDERR, "ERRO: accessToken vazio.\n");
    exit(1);
}

$ch = curl_init('https://api.mercadopago.com/v1/payment_methods');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json',
    ],
    CURLOPT_TIMEOUT => 25,
]);
$response = curl_exec($ch);
$httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    fwrite(STDERR, "ERRO HTTP {$httpCode}: {$response}\n");
    exit(1);
}

$list = json_decode((string)$response, true);
if (!is_array($list)) {
    fwrite(STDERR, "ERRO: resposta inválida.\n");
    exit(1);
}

$pix = null;
foreach ($list as $method) {
    if (!is_array($method)) {
        continue;
    }
    if (($method['id'] ?? '') === 'pix') {
        $pix = $method;
        break;
    }
}

echo "Conta Mercado Pago (token de produção)\n";
if ($pix === null) {
    echo "PIX: NÃO listado nos payment_methods — cadastre chave Pix no app MP.\n";
    exit(2);
}

$status = (string)($pix['status'] ?? 'unknown');
echo 'PIX id=pix status=' . $status . "\n";
echo 'min=' . ($pix['min_allowed_amount'] ?? '?') . ' max=' . ($pix['max_allowed_amount'] ?? '?') . "\n";

if ($status !== 'active') {
    echo "AVISO: Pix não está active. Checkout Pro pode mostrar 'Criar Pix' cinza.\n";
    exit(2);
}

echo "OK: Pix ativo na conta vendedora.\n";
exit(0);
