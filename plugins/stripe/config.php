<?php
/**
 * Stripe payment gateway (Checkout Session + webhook).
 *
 * @copyright 2026 MyAAC/RavynCore
 */

$config['stripe'] = [
	'enabled' => false,
	'environment' => 'production', // production, sandbox
	'secretKey' => [
		'production' => '',
		'sandbox' => '',
	],
	'publishableKey' => [
		'production' => '',
		'sandbox' => '',
	],
	'webhookSecret' => [
		'production' => '',
		'sandbox' => '',
	],
	'urlRedirect' => '?subtopic=donate&action=final',
	'productName' => 'Coins',
	'doubleCoins' => false,
	'doubleCoinsStart' => 300,
	'donationType' => 'coins_transferable', // coins / coins_transferable
	'donates' => [
		'10' => ['id' => '10', 'value' => 10, 'coins' => 100, 'extra' => 0],
		'20' => ['id' => '20', 'value' => 20, 'coins' => 200, 'extra' => 0],
		'30' => ['id' => '30', 'value' => 30, 'coins' => 300, 'extra' => 30],
		'40' => ['id' => '40', 'value' => 40, 'coins' => 400, 'extra' => 40],
		'50' => ['id' => '50', 'value' => 50, 'coins' => 500, 'extra' => 50],
	],
];
