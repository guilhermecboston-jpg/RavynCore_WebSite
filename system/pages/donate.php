<?php
global $config, $twig, $logged;
/**
 * Donate page — Mercado Pago e Stripe.
 */
defined('MYAAC') or die('Direct access not allowed!');

$hasMercadoPago = false;
$hasStripe = false;

$mercadoPagoConfigFile = PLUGINS . 'mercadopago/config.php';
if (file_exists($mercadoPagoConfigFile)) {
	require_once $mercadoPagoConfigFile;
	$hasMercadoPago = isset($config['mercadoPago']) && count($config['mercadoPago']['donates'] ?? []);
}

$stripeConfigFile = PLUGINS . 'stripe/config.php';
if (file_exists($stripeConfigFile)) {
	require_once $stripeConfigFile;
	$hasStripe = isset($config['stripe']) && count($config['stripe']['donates'] ?? []);
}

$twig->addGlobal('config', $config);

if (!$hasMercadoPago && !$hasStripe) {
	echo 'Nenhum gateway de doação configurado. Configure Mercado Pago ou Stripe em plugins/mercadopago/config.php e plugins/stripe/config.php (ou config.local.php).';
	return;
}

if (!extension_loaded('curl')) {
	error("cURL php extension is not loaded, please install it with following command (on linux):" . "<br/>" .
		"sudo apt-get install php5-curl" . "<br/>" .
		"sudo service apache2 restart" . "<br/><br/>" .
		"for XAMPP (Windows) you need to uncomment (Remove selicolon - ;) this line in your php.ini:" . "<br/>" .
		";extension=php_curl.dll");
	return;
}

$is_localhost = strpos(BASE_URL, 'localhost') !== false || strpos(BASE_URL, '127.0.0.1') !== false;
$enableDonateLocal = $config['enableDonateLocal'] ?? ($config['enablePagseguroLocal'] ?? false);
if ($is_localhost && !$enableDonateLocal) {
	warning("Payment gateways may not work on localhost (" . BASE_URL . "). Use a public domain for real donations.<br/>
	This site is visible, but you can't donate from localhost.");
}

if (empty($action)) {
	if (!$logged) {
		$was_before = $config['friendly_urls'];
		$config['friendly_urls'] = true;

		echo 'To buy coins you need to be logged. ' . generateLink(getLink('?subtopic=accountmanagement') . '&redirect=' . urlencode(BASE_URL . '?subtopic=donate'), 'Login') . ' first to make a donate.';

		$config['friendly_urls'] = $was_before;
	} else {
		echo $twig->render('donate.html.twig', [
			'is_localhost' => $is_localhost,
			'enable_donate_local' => $enableDonateLocal,
			'has_mercado_pago' => $hasMercadoPago,
			'mercado_pago_enabled' => (bool)($config['mercadoPago']['enabled'] ?? false),
			'mercado_pago_is_double' => $config['mercadoPago']['doubleCoins'] ?? false,
			'mercado_pago_double_start' => $config['mercadoPago']['doubleCoinsStart'] ?? 0,
			'has_stripe' => $hasStripe,
			'stripe_enabled' => (bool)($config['stripe']['enabled'] ?? false),
			'stripe_is_double' => $config['stripe']['doubleCoins'] ?? false,
			'stripe_double_start' => $config['stripe']['doubleCoinsStart'] ?? 0,
		]);
	}
} elseif ($action == 'final') {
	echo $twig->render('donate-final.html.twig');
}
