<?php
/**
 * Stripe payment gateway (Checkout Session + webhook).
 *
 * Credenciais em config.local.php (não sobrescrever).
 *
 * @copyright 2026 MyAAC/RavynCore
 */

$stripeDefaults = [
	'enabled' => true,
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
	'donationType' => 'coins_transferable',
	'donates' => [
		'pack_100' => ['id' => 'pack_100', 'value' => 10, 'coins' => 100, 'extra' => 0],
		'pack_1000' => ['id' => 'pack_1000', 'value' => 100, 'coins' => 1000, 'extra' => 0],
		'pack_3150' => ['id' => 'pack_3150', 'value' => 300, 'coins' => 3150, 'extra' => 0],
		'pack_10500' => ['id' => 'pack_10500', 'value' => 1000, 'coins' => 10500, 'extra' => 0],
		'pack_73500' => ['id' => 'pack_73500', 'value' => 7000, 'coins' => 73500, 'extra' => 0],
		'pack_135000' => ['id' => 'pack_135000', 'value' => 10000, 'coins' => 135000, 'extra' => 0],
	],
];

$config['stripe'] = array_replace_recursive(
	$stripeDefaults,
	isset($config['stripe']) && is_array($config['stripe']) ? $config['stripe'] : []
);
