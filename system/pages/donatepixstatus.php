<?php
global $logged, $account_logged, $db;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

if (!$logged) {
    ravynDonateJsonResponse(['ok' => false, 'error' => 'Login necessário.'], 401);
}

$orderRef = trim((string)($_GET['order'] ?? ''));
if ($orderRef === '') {
    ravynDonateJsonResponse(['ok' => false, 'error' => 'Pedido não informado.'], 400);
}

$order = ravynDonateGetOrderByRef($db, $orderRef);
if (!$order || (int)$order['account_id'] !== (int)$account_logged->getId()) {
    ravynDonateJsonResponse(['ok' => false, 'error' => 'Pedido inválido.'], 404);
}

if (($order['gateway'] ?? '') !== 'pix') {
    ravynDonateJsonResponse(['ok' => false, 'error' => 'Pedido não é PIX.'], 400);
}

$sync = ravynDonateSyncPixOrderStatus($db, $order);

ravynDonateJsonResponse([
    'ok' => true,
    'order_ref' => $order['order_ref'],
    'order_status' => $sync['order_status'],
    'payment_status' => $sync['payment_status'],
    'ui_state' => $sync['ui_state'],
    'remaining_seconds' => $sync['remaining_seconds'],
    'redirect_delay_seconds' => $sync['redirect_delay_seconds'],
    'account_manage_url' => getLink('account/manage'),
    'donate_url' => getLink('donate'),
]);
