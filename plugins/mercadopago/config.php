<?php
/**
 * Mercado Pago payment system gateway.
 *
 * Credenciais em config.local.php (não sobrescrever):
 *   $config['mercadoPago']['accessToken']['production'] = 'APP_USR-...';
 *   $config['mercadoPago']['accessToken']['sandbox'] = 'TEST-...';
 *
 * URLs de retorno precisam ser HTTPS (obrigatório no MP):
 *   $config['force_https_urls'] = true;
 *   $config['public_url'] = 'https://ravyncore.com/';
 *
 * @name      myaac-mercadopago
 * @copyright 2026 MyAAC/RavynCore
 */

$mercadoPagoDefaults = [
	'enabled' => true,
	'environment' => 'production', // production, sandbox
	'accessToken' => [
		'production' => '',
		'sandbox' => '',
	],
	'urlRedirect' => '?subtopic=donate&action=final',
	// pro = Checkout Pro (redirect mercadopago.com.br). pix_api = gera PIX na API e mostra QR no site.
	'checkoutMode' => 'pro',
	'productName' => 'My Coins',
	'doubleCoins' => false,
	'doubleCoinsStart' => 300,
	'donationType' => 'coins_transferable', // coins / coins_transferable
	// Checkout Pro: métodos exibidos dependem da conta MP (Pix exige chave Pix cadastrada).
	'paymentMethods' => [
		'maxInstallments' => 12, // habilita parcelas e opção "2 cartões" quando o MP permitir
		'excludedPaymentTypes' => [], // ex.: ['ticket'] oculta boleto
		'excludedPaymentMethods' => [], // ex.: ['bolbradesco'] oculta boleto específico
	],
	'donates' => [
		'pack_100' => ['id' => 'pack_100', 'value' => 10, 'coins' => 100, 'extra' => 0],
		'pack_1000' => ['id' => 'pack_1000', 'value' => 100, 'coins' => 1000, 'extra' => 0],
		'pack_3150' => ['id' => 'pack_3150', 'value' => 300, 'coins' => 3150, 'extra' => 0],
		'pack_10500' => ['id' => 'pack_10500', 'value' => 1000, 'coins' => 10500, 'extra' => 0],
		'pack_73500' => ['id' => 'pack_73500', 'value' => 7000, 'coins' => 73500, 'extra' => 0],
		'pack_135000' => ['id' => 'pack_135000', 'value' => 10000, 'coins' => 135000, 'extra' => 0],
	],
];

$config['mercadoPago'] = array_replace_recursive(
	$mercadoPagoDefaults,
	isset($config['mercadoPago']) && is_array($config['mercadoPago']) ? $config['mercadoPago'] : []
);
