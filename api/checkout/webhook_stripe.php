<?php
require __DIR__ . '/lib.php';

$payload = file_get_contents('php://input');
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

$db = checkout_myaac_db();
if (!$db) {
    http_response_code(500);
    exit;
}
checkout_ensure_tables($db);

$row = $db->query(
    "SELECT `id` FROM `ravyn_checkout_orders` WHERE `external_id` = " . $db->quote($externalId)
    . " AND `status` = 'pending' LIMIT 1"
)->fetch();

if ($row) {
    checkout_credit_coins($db, (int) $row['id']);
}

http_response_code(200);
echo 'OK';
