<?php
require __DIR__ . '/lib.php';

$payload = file_get_contents('php://input');
// Em produção valide HTTP_STRIPE_SIGNATURE com STRIPE_WEBHOOK_SECRET (SDK Stripe).
$event = json_decode($payload, true);
if (($event['type'] ?? '') !== 'checkout.session.completed') {
    http_response_code(200);
    exit;
}

$session = $event['data']['object'] ?? [];
$externalId = $session['client_reference_id'] ?? '';

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
