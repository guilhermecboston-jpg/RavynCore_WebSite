<?php
global $config, $twig, $logged, $account_logged, $db;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

if (!$logged) {
    echo $twig->render('donate-pix.html.twig', [
        'error' => 'Você precisa estar logado para ver o pagamento PIX.',
        'donate_url' => getLink('donate'),
    ]);
    return;
}

if (!ravynDonatePixEnabled()) {
    echo $twig->render('donate-pix.html.twig', [
        'error' => 'Pagamento PIX não está habilitado.',
        'donate_url' => getLink('donate'),
    ]);
    return;
}

$orderRef = trim($_GET['order'] ?? '');
if ($orderRef === '') {
    echo $twig->render('donate-pix.html.twig', [
        'error' => 'Pedido não informado.',
        'donate_url' => getLink('donate'),
    ]);
    return;
}

$order = ravynDonateGetOrderByRef($db, $orderRef);
if (!$order || (int)$order['account_id'] !== (int)$account_logged->getId()) {
    echo $twig->render('donate-pix.html.twig', [
        'error' => 'Pedido inválido ou não pertence à sua conta.',
        'donate_url' => getLink('donate'),
    ]);
    return;
}

if (($order['gateway'] ?? '') !== 'pix') {
    echo $twig->render('donate-pix.html.twig', [
        'error' => 'Este pedido não é um pagamento PIX.',
        'donate_url' => getLink('donate'),
    ]);
    return;
}

$pix = ravynDonateResolvePixForOrder($order);
$isPaid = in_array(strtolower($pix['status']), ['approved', 'paid'], true) || ($order['status'] ?? '') === 'paid';

echo $twig->render('donate-pix.html.twig', [
    'error' => '',
    'order_ref' => $order['order_ref'],
    'coins' => (int)$order['coins'],
    'amount_brl' => (float)$order['amount_brl'],
    'account_name' => $order['account_name'],
    'pix_key' => $pix['pix_key'],
    'qr_code' => $pix['qr_code'],
    'qr_code_base64' => $pix['qr_code_base64'],
    'qr_image' => $pix['qr_image'],
    'payment_status' => $pix['status'],
    'is_paid' => $isPaid,
    'donate_url' => getLink('donate'),
    'final_url' => getLink('donate') . '&action=final&gateway=pix&order=' . urlencode($order['order_ref']),
]);
