<?php
global $config, $logged, $account_logged;
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Donate with Stripe';

if (!$logged) {
	echo 'You need to be logged in.';
	return;
}

if (!$code = ($_POST['code'] ?? null)) {
	echo 'Please select item.';
	return;
}

$reference = (int)($_POST['reference'] ?? 0);
if ($reference <= 0) {
	echo 'Please enter reference.';
	return;
}
if ($reference !== (int)$account_logged->getId()) {
	echo 'Invalid reference.';
	return;
}

require_once PLUGINS . 'stripe/config.php';

if (
	!isset($config['stripe']) ||
	!($config['stripe']['enabled'] ?? false) ||
	!count($config['stripe']['donates'] ?? [])
) {
	echo 'Stripe is disabled. If you are an admin, configure it in plugins/stripe/config.php.';
	return;
}

$environment = $config['stripe']['environment'] ?? 'production';
$secretKey = $config['stripe']['secretKey'][$environment] ?? '';
if (empty($secretKey)) {
	echo 'Stripe secret key is not configured.';
	return;
}

if (!isset($config['stripe']['donates'][$code])) {
	echo 'Invalid donate option.';
	return;
}

$donateSelected = $config['stripe']['donates'][$code];
$bought = (int)$donateSelected['coins'];
$extra = (int)$donateSelected['extra'];
$isDouble = (bool)($config['stripe']['doubleCoins'] ?? false) && $bought >= (int)($config['stripe']['doubleCoinsStart'] ?? 0);
$coinsAmount = ($isDouble ? $bought * 2 : $bought) + $extra;
$desc = ($isDouble ? ($bought * 2) : $bought) . ' ' . ($config['stripe']['productName'] ?? 'Coins');
$valueBrl = (float)$donateSelected['value'];
$unitAmount = (int)round($valueBrl * 100);

if ($unitAmount <= 0) {
	echo 'Invalid donation value.';
	return;
}

$baseUrl = function_exists('ravynPublicBaseUrl') ? ravynPublicBaseUrl() : BASE_URL;
$redirectPath = $config['stripe']['urlRedirect'] ?? '?subtopic=donate&action=final';
$successUrl = $baseUrl . ltrim($redirectPath, '/') . (strpos($redirectPath, '?') !== false ? '&' : '?') . 'gateway=stripe';
$cancelUrl = $baseUrl . '?subtopic=donate';
$notificationUrl = rtrim($baseUrl, '/') . '/payments/stripe.php';

$payload = [
	'mode' => 'payment',
	'success_url' => $successUrl,
	'cancel_url' => $cancelUrl,
	'client_reference_id' => (string)$reference,
	'currency' => 'brl',
	'line_items' => [[
		'quantity' => 1,
		'price_data' => [
			'currency' => 'brl',
			'unit_amount' => $unitAmount,
			'product_data' => [
				'name' => $desc,
				'description' => 'Donate: ' . $desc,
			],
		],
	]],
	'metadata' => [
		'code' => (string)$donateSelected['id'],
		'account_id' => (string)$reference,
		'coins' => (string)$bought,
		'extra' => (string)$extra,
		'coins_amount' => (string)$coinsAmount,
		'in_double' => $isDouble ? '1' : '0',
	],
	'payment_intent_data' => [
		'metadata' => [
			'code' => (string)$donateSelected['id'],
			'account_id' => (string)$reference,
		],
	],
];

$ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_USERPWD => $secretKey . ':',
	CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
	CURLOPT_POSTFIELDS => json_encode($payload),
	CURLOPT_TIMEOUT => 30,
]);

$response = curl_exec($ch);
$httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false || !in_array($httpCode, [200, 201], true)) {
	log_append('stripe_donate_errors.log', date('Y-m-d H:i:s') . ': checkout create error - ' . $curlError . ' - ' . $response);
	echo 'Error creating Stripe checkout. Please try again in a few moments.';
	return;
}

$data = json_decode($response, true);
$checkoutUrl = $data['url'] ?? null;
if (empty($checkoutUrl)) {
	echo 'Stripe checkout URL not found.';
	return;
}

header('Location: ' . $checkoutUrl);
exit;
