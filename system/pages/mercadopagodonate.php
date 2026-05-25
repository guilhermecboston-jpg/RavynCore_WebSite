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

$baseUrl = function_exists('ravynPublicBaseUrl') ? ravynPublicBaseUrl() : BASE_URL;
$redirectPath = $config['mercadoPago']['urlRedirect'] ?? '?subtopic=donate&action=final';
$redirectUrl = $baseUrl . ltrim($redirectPath, '/');
$notificationUrl = rtrim($baseUrl, '/') . '/payments/mercadopago.php';
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
	'metadata' => [
		'code' => (string)$donateSelected['id'],
		'coins' => $bought,
		'extra' => $extra,
		'coins_amount' => $coinsAmount,
		'in_double' => $isDouble ? 1 : 0,
		'account_id' => $reference,
	],
];

// Mercado Pago exige HTTPS em back_urls e notification_url
foreach (['success', 'pending', 'failure'] as $backKey) {
	if (stripos($payload['back_urls'][$backKey], 'https://') !== 0) {
		log_append(
			'mercadopago_donate_errors.log',
			date('Y-m-d H:i:s') . ': back_urls.' . $backKey . ' must use HTTPS: ' . $payload['back_urls'][$backKey]
		);
		echo 'Payment URLs must use HTTPS. Set force_https_urls or public_url in config.local.php.';
		return;
	}
}
if (stripos($notificationUrl, 'https://') !== 0) {
	log_append('mercadopago_donate_errors.log', date('Y-m-d H:i:s') . ': notification_url must use HTTPS: ' . $notificationUrl);
	echo 'Payment URLs must use HTTPS. Set force_https_urls or public_url in config.local.php.';
	return;
}

$payload['auto_return'] = 'approved';

$pmConfig = $config['mercadoPago']['paymentMethods'] ?? [];
$maxInstallments = (int)($pmConfig['maxInstallments'] ?? 12);
if ($maxInstallments > 0) {
	$payload['payment_methods'] = [
		'installments' => min($maxInstallments, 24),
	];
	$excludedTypes = $pmConfig['excludedPaymentTypes'] ?? [];
	if (is_array($excludedTypes) && count($excludedTypes) > 0) {
		$payload['payment_methods']['excluded_payment_types'] = array_map(
			static fn($id) => ['id' => (string)$id],
			$excludedTypes
		);
	}
	$excludedMethods = $pmConfig['excludedPaymentMethods'] ?? [];
	if (is_array($excludedMethods) && count($excludedMethods) > 0) {
		$payload['payment_methods']['excluded_payment_methods'] = array_map(
			static fn($id) => ['id' => (string)$id],
			$excludedMethods
		);
	}
}

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
	$apiMessage = '';
	$decoded = is_string($response) ? json_decode($response, true) : null;
	if (is_array($decoded)) {
		$apiMessage = $decoded['message'] ?? ($decoded['error'] ?? '');
		if (!empty($decoded['cause']) && is_array($decoded['cause'])) {
			$parts = [];
			foreach ($decoded['cause'] as $cause) {
				if (is_array($cause)) {
					$parts[] = ($cause['code'] ?? '') . ' ' . ($cause['description'] ?? '');
				}
			}
			if ($parts) {
				$apiMessage .= ' | ' . implode('; ', $parts);
			}
		}
	}
	log_append(
		'mercadopago_donate_errors.log',
		sprintf(
			'%s: HTTP %d curl=%s api=%s urls=%s notify=%s body=%s',
			date('Y-m-d H:i:s'),
			$httpCode,
			$curlError,
			$apiMessage,
			$redirectUrl,
			$notificationUrl,
			is_string($response) ? $response : ''
		)
	);
	echo 'Error creating Mercado Pago checkout. Please try again in a few moments.';
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
