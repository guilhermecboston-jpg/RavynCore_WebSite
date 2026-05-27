<?php
require __DIR__ . '/lib.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    checkout_json_response(['ok' => true]);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    checkout_json_response(['error' => 'Method not allowed'], 405);
}

$body = checkout_read_json();
if (!$body) {
    checkout_json_response(['error' => 'JSON inválido'], 400);
}

$cfg = checkout_config();
$packageId = $body['packageId'] ?? '';
if (!isset($cfg['packages'][$packageId])) {
    checkout_json_response(['error' => 'Pacote inválido'], 400);
}

$pack = $cfg['packages'][$packageId];
$gateway = $body['gateway'] ?? '';
$paymentMethod = $body['paymentMethod'] ?? '';
$region = $body['region'] ?? 'BR';
$fullName = trim($body['fullName'] ?? '');
$birthDate = trim($body['birthDate'] ?? '');
$email = trim($body['email'] ?? '');

if ($fullName === '' || $birthDate === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    checkout_json_response(['error' => 'Dados pessoais incompletos'], 400);
}

$taxId = null;
if ($region === 'BR') {
    $cpf = preg_replace('/\D/', '', $body['cpf'] ?? '');
    if (!checkout_validate_cpf($cpf)) {
        checkout_json_response(['error' => 'CPF inválido'], 400);
    }
    $taxId = $cpf;
} else {
    $taxId = trim($body['document'] ?? '');
    if (strlen($taxId) < 4) {
        checkout_json_response(['error' => 'Documento inválido'], 400);
    }
}

if (!in_array($gateway, ['mercadopago', 'stripe'], true)) {
    checkout_json_response(['error' => 'Gateway inválido'], 400);
}

$db = checkout_db_or_fail();
$externalId = 'RC-' . bin2hex(random_bytes(8));
$characterName = trim($body['characterName'] ?? '');
$accountId = (int) ($body['accountId'] ?? 0);

$db->exec(
    'INSERT INTO `ravyn_checkout_orders`
    (`external_id`, `package_id`, `coins`, `amount_usd`, `gateway`, `payment_method`, `region`,
     `full_name`, `birth_date`, `tax_id`, `email`, `character_name`, `account_id`)
    VALUES ('
    . $db->quote($externalId) . ', '
    . $db->quote($packageId) . ', '
    . (int) $pack['coins'] . ', '
    . (float) $pack['amount_usd'] . ', '
    . $db->quote($gateway) . ', '
    . $db->quote($paymentMethod) . ', '
    . $db->quote($region) . ', '
    . $db->quote($fullName) . ', '
    . $db->quote($birthDate) . ', '
    . $db->quote($taxId) . ', '
    . $db->quote($email) . ', '
    . $db->quote($characterName) . ', '
    . $accountId
    . ')'
);
$orderId = (int) $db->lastInsertId();

$site = rtrim($cfg['site_url'], '/');
$successUrl = $site . '/checkout/success.php?order=' . urlencode($externalId);
$failureUrl = $site . '/checkout/failure.php?order=' . urlencode($externalId);
$pendingUrl = $site . '/checkout/pending.php?order=' . urlencode($externalId);

if ($gateway === 'mercadopago') {
    $token = $cfg['mercadopago']['access_token'];
    if ($token === '') {
        checkout_json_response(['error' => 'Mercado Pago não configurado no site'], 503);
    }

    $excluded = checkout_mp_excluded_types($paymentMethod);
    $preference = [
        'items' => [[
            'id' => $packageId,
            'title' => $pack['coins'] . ' RavynCore Coins',
            'quantity' => 1,
            'currency_id' => 'USD',
            'unit_price' => (float) $pack['amount_usd'],
        ]],
        'payer' => [
            'name' => $fullName,
            'email' => $email,
            'identification' => [
                'type' => $region === 'BR' ? 'CPF' : 'Otro',
                'number' => $taxId,
            ],
        ],
        'payment_methods' => [
            'excluded_payment_types' => $excluded,
        ],
        'external_reference' => $externalId,
        'back_urls' => [
            'success' => $successUrl,
            'failure' => $failureUrl,
            'pending' => $pendingUrl,
        ],
        'auto_return' => 'approved',
        'notification_url' => $site . '/api/checkout/webhook_mercadopago.php',
        'metadata' => [
            'order_id' => $orderId,
            'payment_method' => $paymentMethod,
        ],
    ];

    $ch = curl_init('https://api.mercadopago.com/checkout/preferences');
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS => json_encode($preference),
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);
    if ($httpCode < 200 || $httpCode >= 300 || empty($data['init_point'])) {
        $msg = $data['message'] ?? 'Falha ao criar preferência Mercado Pago';
        checkout_json_response(['error' => $msg], 502);
    }

    if (!empty($data['id'])) {
        $db->exec(
            'UPDATE `ravyn_checkout_orders` SET `gateway_ref` = ' . $db->quote($data['id'])
            . ' WHERE `id` = ' . $orderId
        );
    }

    checkout_json_response([
        'redirectUrl' => $data['init_point'],
        'init_point' => $data['init_point'],
        'orderId' => $externalId,
    ]);
}

$stripeKey = $cfg['stripe']['secret_key'];
if ($stripeKey === '') {
    checkout_json_response(['error' => 'Stripe não configurado no site'], 503);
}

$amountCents = (int) round($pack['amount_usd'] * 100);
$params = [
    'mode' => 'payment',
    'success_url' => $successUrl,
    'cancel_url' => $failureUrl,
    'client_reference_id' => $externalId,
    'customer_email' => $email,
    'metadata[order_id]' => (string) $orderId,
    'metadata[external_id]' => $externalId,
    'metadata[payment_method]' => $paymentMethod,
    'line_items[0][price_data][currency]' => 'usd',
    'line_items[0][price_data][unit_amount]' => $amountCents,
    'line_items[0][price_data][product_data][name]' => $pack['coins'] . ' RavynCore Coins',
    'line_items[0][quantity]' => 1,
];

$ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERPWD => $stripeKey . ':',
    CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded'],
    CURLOPT_POSTFIELDS => http_build_query($params),
]);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($response, true);
if ($httpCode < 200 || $httpCode >= 300 || empty($data['url'])) {
    checkout_json_response(['error' => 'Falha ao criar sessão Stripe'], 502);
}

$db->exec(
    'UPDATE `ravyn_checkout_orders` SET `gateway_ref` = ' . $db->quote($data['id'])
    . ' WHERE `id` = ' . $orderId
);

checkout_json_response([
    'redirectUrl' => $data['url'],
    'orderId' => $externalId,
]);
