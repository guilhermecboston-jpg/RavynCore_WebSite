<?php
require __DIR__ . '/lib.php';

$topic = $_GET['topic'] ?? $_GET['type'] ?? '';
$id = $_GET['id'] ?? $_GET['data.id'] ?? '';

if ($id === '' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = checkout_read_json();
    $id = $payload['data']['id'] ?? '';
    $topic = $payload['type'] ?? $topic;
}

if ($id === '' || $topic !== 'payment') {
    http_response_code(200);
    exit;
}

$cfg = checkout_config();
$token = $cfg['mercadopago']['access_token'];
if ($token === '') {
    http_response_code(503);
    exit;
}

$ch = curl_init('https://api.mercadopago.com/v1/payments/' . urlencode((string) $id));
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $token],
]);
$response = curl_exec($ch);
curl_close($ch);

$payment = json_decode($response, true);
if (($payment['status'] ?? '') !== 'approved') {
    http_response_code(200);
    exit;
}

$externalId = $payment['external_reference'] ?? '';
if ($externalId === '') {
    http_response_code(200);
    exit;
}

try {
    $pdo = checkout_pdo();
    checkout_ensure_tables($pdo);
    $stmt = $pdo->prepare('SELECT id FROM ravyn_checkout_orders WHERE external_id = ? AND status = ?');
    $stmt->execute([$externalId, 'pending']);
    $row = $stmt->fetch();
    if ($row) {
        checkout_credit_coins($pdo, (int) $row['id']);
    }
} catch (Throwable $e) {
    http_response_code(500);
    exit;
}

http_response_code(200);
