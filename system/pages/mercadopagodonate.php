<?php
global $config, $logged, $account_logged;
defined('MYAAC') or die('Direct access not allowed!');
$title = 'Donate with Mercado Pago';

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

require_once(PLUGINS . 'mercadopago/config.php');

if (
	!isset($config['mercadoPago']) ||
	!($config['mercadoPago']['enabled'] ?? false) ||
	!count($config['mercadoPago']['donates'] ?? [])
) {
	echo 'Mercado Pago is disabled. If you are an admin, configure it in plugins/mercadopago/config.php.';
	return;
}

$environment = $config['mercadoPago']['environment'] ?? 'production';
$accessToken = $config['mercadoPago']['accessToken'][$environment] ?? '';
if (empty($accessToken)) {
	echo 'Mercado Pago access token is not configured.';
	return;
}

if (!isset($config['mercadoPago']['donates'][$code])) {
	echo 'Invalid donate option.';
	return;
}

$donateSelected = $config['mercadoPago']['donates'][$code];
$bought = (int)$donateSelected['coins'];
$extra = (int)$donateSelected['extra'];
$isDouble = (bool)($config['mercadoPago']['doubleCoins'] ?? false) && $bought >= (int)($config['mercadoPago']['doubleCoinsStart'] ?? 0);
$coinsAmount = ($isDouble ? $bought * 2 : $bought) + $extra;
$desc = ($isDouble ? ($bought * 2) : $bought) . ' ' . ($config['mercadoPago']['productName'] ?? 'Coins');

$redirectUrl = BASE_URL . ($config['mercadoPago']['urlRedirect'] ?? '?subtopic=donate&action=final');
$notificationUrl = rtrim(BASE_URL, '/') . '/payments/mercadopago.php';
$endpoint = 'https://api.mercadopago.com/checkout/preferences';

$payload = [
	'items' => [[
		'id' => (string)$donateSelected['id'],
		'title' => $desc,
		'description' => 'Donate: ' . $desc,
		'quantity' => 1,
		'currency_id' => 'BRL',
		'unit_price' => (float)$donateSelected['value'],
	]],
	'external_reference' => (string)$reference,
	'notification_url' => $notificationUrl,
	'back_urls' => [
		'success' => $redirectUrl,
		'pending' => $redirectUrl,
		'failure' => $redirectUrl,
	],
	'auto_return' => 'approved',
	'metadata' => [
		'code' => (string)$donateSelected['id'],
		'coins' => $bought,
		'extra' => $extra,
		'coins_amount' => $coinsAmount,
		'in_double' => $isDouble ? 1 : 0,
		'account_id' => $reference,
	],
];

$ch = curl_init($endpoint);
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_POST => true,
	CURLOPT_HTTPHEADER => [
		'Authorization: Bearer ' . $accessToken,
		'Content-Type: application/json',
	],
	CURLOPT_POSTFIELDS => json_encode($payload),
	CURLOPT_TIMEOUT => 30,
]);

$response = curl_exec($ch);
$httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false || !in_array($httpCode, [200, 201], true)) {
	echo 'Error creating Mercado Pago checkout.';
	if (!empty($curlError)) {
		echo '<br/>' . htmlspecialchars($curlError);
	}
	if (!empty($response)) {
		echo '<br/>' . htmlspecialchars($response);
	}
	return;
}

$data = json_decode($response, true);
$checkoutUrl = $data['init_point'] ?? ($data['sandbox_init_point'] ?? null);
if (empty($checkoutUrl)) {
	echo 'Mercado Pago checkout URL not found.';
	return;
}

header('Location: ' . $checkoutUrl);
exit;
