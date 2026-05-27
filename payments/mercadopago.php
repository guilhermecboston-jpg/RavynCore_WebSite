<?php
/**
 * Automatic Mercado Pago payment notification endpoint.
 *
 * @name      myaac-mercadopago
 * @copyright 2026 MyAAC/RavynCore
 */

global $db, $config;
require_once '../common.php';
require_once SYSTEM . 'functions.php';
require_once SYSTEM . 'init.php';
require_once PLUGINS . 'mercadopago/config.php';

if (
	!isset($config['mercadoPago']) ||
	!($config['mercadoPago']['enabled'] ?? false) ||
	!count($config['mercadoPago']['donates'] ?? [])
) {
	http_response_code(200);
	exit;
}

$environment = $config['mercadoPago']['environment'] ?? 'production';
$accessToken = $config['mercadoPago']['accessToken'][$environment] ?? '';
if (empty($accessToken)) {
	http_response_code(200);
	exit;
}

$raw = file_get_contents('php://input');
$json = json_decode($raw, true);

$paymentId = null;
if (!empty($json['data']['id'])) {
	$paymentId = (string)$json['data']['id'];
} elseif (!empty($_GET['data.id'])) {
	$paymentId = (string)$_GET['data.id'];
} elseif (!empty($_GET['id'])) {
	$paymentId = (string)$_GET['id'];
}

if (empty($paymentId)) {
	log_append('mercadopago_webhook.log', date('Y-m-d H:i:s') . ' webhook ignored: no payment id. raw=' . substr((string)$raw, 0, 500));
	http_response_code(200);
	exit;
}

log_append('mercadopago_webhook.log', date('Y-m-d H:i:s') . ' webhook payment_id=' . $paymentId);

$paymentEndpoint = 'https://api.mercadopago.com/v1/payments/' . urlencode($paymentId);
$ch = curl_init($paymentEndpoint);
curl_setopt_array($ch, [
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => [
		'Authorization: Bearer ' . $accessToken,
		'Content-Type: application/json',
	],
	CURLOPT_TIMEOUT => 30,
]);

$paymentResponse = curl_exec($ch);
$paymentHttpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
$paymentCurlError = curl_error($ch);
curl_close($ch);

if ($paymentResponse === false || $paymentHttpCode !== 200) {
	log_append('mercadopago_donate_errors.log', date('Y-m-d H:i:s') . ': error fetching payment ' . $paymentId . ' - ' . $paymentCurlError . ' - ' . $paymentResponse);
	http_response_code(200);
	exit;
}

$payment = json_decode($paymentResponse, true);
if (!is_array($payment)) {
	http_response_code(200);
	exit;
}

$externalReference = (string)($payment['external_reference'] ?? '');
$paymentStatus = (string)($payment['status'] ?? '');

if (strpos($externalReference, 'RD-') === 0) {
	require_once SYSTEM . 'libs/ravyn_donate_checkout.php';
	$order = ravynDonateGetOrderByRef($db, $externalReference);
	if ($order) {
		ravynDonateDeliverOrder($db, $order, $paymentId, $paymentStatus, 'mercadopago');
	}
	http_response_code(200);
	echo 'OK';
	exit;
}

$accountId = (int)$externalReference;
if ($accountId <= 0) {
	http_response_code(200);
	exit;
}

$code = (string)($payment['metadata']['code'] ?? '');
if (empty($code) && !empty($payment['additional_info']['items'][0]['id'])) {
	$code = (string)$payment['additional_info']['items'][0]['id'];
}
if (empty($code) || !isset($config['mercadoPago']['donates'][$code])) {
	http_response_code(200);
	exit;
}

$donateSelected = $config['mercadoPago']['donates'][$code];
$bought = (int)$donateSelected['coins'];
$extra = (int)$donateSelected['extra'];
$isDouble = (bool)($config['mercadoPago']['doubleCoins'] ?? false) && $bought >= (int)($config['mercadoPago']['doubleCoinsStart'] ?? 0);
$coinsAmount = ($isDouble ? $bought * 2 : $bought) + $extra;
if (!is_numeric($coinsAmount) || $coinsAmount < 0) {
	$coinsAmount = 0;
}

$hasAmountBrlColumn = $db->hasColumn('mercadopago_transactions', 'amount_brl');
$currencyId = strtoupper((string)($payment['currency_id'] ?? 'BRL'));
$amountBrl = 0.0;
if (isset($payment['transaction_amount']) && is_numeric($payment['transaction_amount'])) {
	$amountBrl = (float)$payment['transaction_amount'];
}
if ($currencyId === 'BRL' && $amountBrl <= 0 && isset($donateSelected['value']) && is_numeric($donateSelected['value'])) {
	$amountBrl = (float)$donateSelected['value'];
}
if ($amountBrl < 0) {
	$amountBrl = 0.0;
}
$amountBrlSql = number_format($amountBrl, 2, '.', '');

$paymentMethod = (string)($payment['payment_method_id'] ?? ($payment['payment_type_id'] ?? 'unknown'));
$paymentStatus = (string)($payment['status'] ?? 'unknown');
$createdAt = date('Y-m-d H:i:s');
$request = json_encode([
	'webhook' => $json,
	'payment' => $payment,
], JSON_UNESCAPED_UNICODE);

try {
	$db->beginTransaction();

	$query = "SELECT * FROM `mercadopago_transactions` WHERE `payment_id` = " . $db->quote($paymentId) . " FOR UPDATE";
	$transactionDB = $db->query($query)->fetch();
	if (!$transactionDB) {
		$insertColumns = ['payment_id', 'external_reference', 'account_id', 'payment_method', 'payment_status', 'code', 'coins_amount', 'bought', 'in_double', 'request', 'created_at'];
		$insertValues = [
			$db->quote($paymentId),
			$db->quote($externalReference),
			$accountId,
			$db->quote($paymentMethod),
			$db->quote($paymentStatus),
			$db->quote($code),
			$coinsAmount,
			$bought,
			($isDouble ? 1 : 0),
			$db->quote($request),
			$db->quote($createdAt),
		];
		if ($hasAmountBrlColumn) {
			$insertColumns[] = 'amount_brl';
			$insertValues[] = $amountBrlSql;
		}
		$db->exec("INSERT INTO `mercadopago_transactions` (`" . implode('`, `', $insertColumns) . "`) VALUES (" . implode(', ', $insertValues) . ")");
		$transactionDB = $db->query("SELECT * FROM `mercadopago_transactions` WHERE `id` = " . $db->lastInsertId() . " FOR UPDATE")->fetch();
	}

	$id = (int)$transactionDB['id'];
	$requestLog = ($transactionDB['request'] ?? '') . PHP_EOL . $request;
	$updateAt = date('Y-m-d H:i:s');

	if ((int)$transactionDB['delivered'] === 0 && $paymentStatus === 'approved') {
		$field = strtolower($config['mercadoPago']['donationType'] ?? 'coins_transferable');
		$db->exec("UPDATE `accounts` SET {$field} = {$field} + {$coinsAmount} WHERE `id` = {$accountId}");
		$loyaltyAdded = ravynGrantDonationLoyaltyPoints((int)$accountId, (float)$amountBrl);
		log_append(
			'mercadopago_webhook.log',
			sprintf(
				'%s DELIVERED account=%d payment=%s coins=%d loyalty=+%d brl=%s method=%s',
				date('Y-m-d H:i:s'),
				$accountId,
				$paymentId,
				$coinsAmount,
				$loyaltyAdded,
				number_format($amountBrl, 2, '.', ''),
				$paymentMethod
			)
		);
		$updateApproved = "`delivered` = 1, `payment_status` = " . $db->quote($paymentStatus) . ", `request` = " . $db->quote($requestLog) . ", `updated_at` = " . $db->quote($updateAt);
		if ($hasAmountBrlColumn) {
			$updateApproved .= ", `amount_brl` = {$amountBrlSql}";
		}
		$db->exec("UPDATE `mercadopago_transactions` SET {$updateApproved} WHERE `id` = {$id}");

		$values = "{$accountId}, 1, {$coinsAmount}, {$db->quote('Donate - Mercado Pago')}, {$db->quote($updateAt)}, 3";
		$db->exec("INSERT INTO `coins_transactions` (`account_id`, `type`, `amount`, `description`, `timestamp`, `coin_type`) VALUES ({$values})");

		$timestamp = strtotime($updateAt);
		$values2 = "{$accountId}, 0, {$db->quote('Donate - Mercado Pago')}, 3, {$coinsAmount}, {$timestamp}, 0, 0";
		$db->exec("INSERT INTO `store_history` (`account_id`, `mode`, `description`, `coin_type`, `coin_amount`, `time`, `timestamp`, `coins`) VALUES ({$values2})");
	} else {
		log_append(
			'mercadopago_webhook.log',
			date('Y-m-d H:i:s') . " status={$paymentStatus} delivered=" . (int)$transactionDB['delivered'] . " account={$accountId} payment={$paymentId}"
		);
		$updateDefault = "`payment_status` = " . $db->quote($paymentStatus) . ", `request` = " . $db->quote($requestLog) . ", `updated_at` = " . $db->quote($updateAt);
		if ($hasAmountBrlColumn && $amountBrl > 0) {
			$updateDefault .= ", `amount_brl` = {$amountBrlSql}";
		}
		$db->exec("UPDATE `mercadopago_transactions` SET {$updateDefault} WHERE `id` = {$id}");
	}

	$db->commit();
} catch (\Exception $e) {
	if ($db->inTransaction()) {
		$db->rollBack();
	}
	log_append('mercadopago_donate_errors.log', date('Y-m-d H:i:s') . ': ' . $e->getMessage());
}

http_response_code(200);
echo 'OK';
