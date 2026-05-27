<?php
/**
 * Stripe webhook — entrega coins + loyalty ao confirmar pagamento.
 *
 * Dashboard Stripe → Developers → Webhooks → endpoint:
 *   https://ravyncore.com/payments/stripe.php
 * Eventos: checkout.session.completed
 */

global $db, $config;
require_once '../common.php';
require_once SYSTEM . 'functions.php';
require_once SYSTEM . 'init.php';
require_once PLUGINS . 'stripe/config.php';

if (
	!isset($config['stripe']) ||
	!($config['stripe']['enabled'] ?? false) ||
	!count($config['stripe']['donates'] ?? [])
) {
	http_response_code(200);
	exit;
}

$environment = $config['stripe']['environment'] ?? 'production';
$webhookSecret = $config['stripe']['webhookSecret'][$environment] ?? '';
if (empty($webhookSecret)) {
	http_response_code(200);
	exit;
}

$payload = file_get_contents('php://input');
$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
if ($payload === false || $payload === '' || $sigHeader === '') {
	http_response_code(400);
	exit;
}

if (!stripeVerifyWebhookSignature($payload, $sigHeader, $webhookSecret)) {
	log_append('stripe_donate_errors.log', date('Y-m-d H:i:s') . ': invalid webhook signature');
	http_response_code(400);
	exit;
}

$event = json_decode($payload, true);
if (!is_array($event) || empty($event['type'])) {
	http_response_code(200);
	exit;
}

$type = (string)$event['type'];
if ($type !== 'checkout.session.completed') {
	http_response_code(200);
	echo 'OK';
	exit;
}

$session = $event['data']['object'] ?? null;
if (!is_array($session)) {
	http_response_code(200);
	exit;
}

$sessionId = (string)($session['id'] ?? '');
$paymentStatus = (string)($session['payment_status'] ?? '');
if ($sessionId === '' || $paymentStatus !== 'paid') {
	http_response_code(200);
	echo 'OK';
	exit;
}

$clientRef = (string)($session['client_reference_id'] ?? ($session['metadata']['order_ref'] ?? ''));
if (strpos($clientRef, 'RD-') === 0) {
	require_once SYSTEM . 'libs/ravyn_donate_checkout.php';
	$order = ravynDonateGetOrderByRef($db, $clientRef);
	if ($order) {
		ravynDonateDeliverOrder($db, $order, $sessionId, 'paid', 'stripe');
	}
	http_response_code(200);
	echo 'OK';
	exit;
}

$accountId = (int)$clientRef;
if ($accountId <= 0) {
	$accountId = (int)($session['metadata']['account_id'] ?? 0);
}
if ($accountId <= 0) {
	http_response_code(200);
	exit;
}

$code = (string)($session['metadata']['code'] ?? '');
if ($code === '' || !isset($config['stripe']['donates'][$code])) {
	http_response_code(200);
	exit;
}

$donateSelected = $config['stripe']['donates'][$code];
$bought = (int)$donateSelected['coins'];
$extra = (int)$donateSelected['extra'];
$isDouble = (bool)($config['stripe']['doubleCoins'] ?? false) && $bought >= (int)($config['stripe']['doubleCoinsStart'] ?? 0);
$coinsAmount = ($isDouble ? $bought * 2 : $bought) + $extra;
if ($coinsAmount < 0) {
	$coinsAmount = 0;
}

$amountBrl = 0.0;
if (isset($session['amount_total']) && is_numeric($session['amount_total'])) {
	$amountBrl = (float)$session['amount_total'] / 100.0;
}
if ($amountBrl <= 0 && isset($donateSelected['value']) && is_numeric($donateSelected['value'])) {
	$amountBrl = (float)$donateSelected['value'];
}
$amountBrlSql = number_format(max(0, $amountBrl), 2, '.', '');

$paymentIntentId = (string)($session['payment_intent'] ?? '');
$hasAmountBrlColumn = $db->hasColumn('stripe_transactions', 'amount_brl');
$createdAt = date('Y-m-d H:i:s');
$request = json_encode($event, JSON_UNESCAPED_UNICODE);

try {
	$db->beginTransaction();

	$query = "SELECT * FROM `stripe_transactions` WHERE `session_id` = " . $db->quote($sessionId) . " FOR UPDATE";
	$transactionDB = $db->query($query)->fetch();
	if (!$transactionDB) {
		$insertColumns = [
			'session_id', 'payment_intent_id', 'external_reference', 'account_id',
			'payment_status', 'code', 'coins_amount', 'bought', 'in_double', 'request', 'created_at',
		];
		$insertValues = [
			$db->quote($sessionId),
			$db->quote($paymentIntentId),
			$db->quote((string)$accountId),
			$accountId,
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
		$db->exec(
			"INSERT INTO `stripe_transactions` (`" . implode('`, `', $insertColumns) . "`) VALUES (" . implode(', ', $insertValues) . ")"
		);
		$transactionDB = $db->query("SELECT * FROM `stripe_transactions` WHERE `id` = " . $db->lastInsertId() . " FOR UPDATE")->fetch();
	}

	$id = (int)$transactionDB['id'];
	$requestLog = ($transactionDB['request'] ?? '') . PHP_EOL . $request;
	$updateAt = date('Y-m-d H:i:s');

	if ((int)$transactionDB['delivered'] === 0) {
		$field = strtolower($config['stripe']['donationType'] ?? 'coins_transferable');
		$db->exec("UPDATE `accounts` SET {$field} = {$field} + {$coinsAmount} WHERE `id` = {$accountId}");
		ravynGrantDonationLoyaltyPoints((int)$accountId, (float)$amountBrl);

		$updateApproved = "`delivered` = 1, `payment_status` = " . $db->quote($paymentStatus)
			. ", `payment_intent_id` = " . $db->quote($paymentIntentId)
			. ", `request` = " . $db->quote($requestLog)
			. ", `updated_at` = " . $db->quote($updateAt);
		if ($hasAmountBrlColumn) {
			$updateApproved .= ", `amount_brl` = {$amountBrlSql}";
		}
		$db->exec("UPDATE `stripe_transactions` SET {$updateApproved} WHERE `id` = {$id}");

		$values = "{$accountId}, 1, {$coinsAmount}, {$db->quote('Donate - Stripe')}, {$db->quote($updateAt)}, 3";
		$db->exec("INSERT INTO `coins_transactions` (`account_id`, `type`, `amount`, `description`, `timestamp`, `coin_type`) VALUES ({$values})");

		$timestamp = strtotime($updateAt);
		$values2 = "{$accountId}, 0, {$db->quote('Donate - Stripe')}, 3, {$coinsAmount}, {$timestamp}, 0, 0";
		$db->exec("INSERT INTO `store_history` (`account_id`, `mode`, `description`, `coin_type`, `coin_amount`, `time`, `timestamp`, `coins`) VALUES ({$values2})");
	} else {
		$updateDefault = "`payment_status` = " . $db->quote($paymentStatus)
			. ", `request` = " . $db->quote($requestLog)
			. ", `updated_at` = " . $db->quote($updateAt);
		if ($hasAmountBrlColumn && $amountBrl > 0) {
			$updateDefault .= ", `amount_brl` = {$amountBrlSql}";
		}
		$db->exec("UPDATE `stripe_transactions` SET {$updateDefault} WHERE `id` = {$id}");
	}

	$db->commit();
} catch (\Exception $e) {
	if ($db->inTransaction()) {
		$db->rollBack();
	}
	log_append('stripe_donate_errors.log', date('Y-m-d H:i:s') . ': ' . $e->getMessage());
}

http_response_code(200);
echo 'OK';
