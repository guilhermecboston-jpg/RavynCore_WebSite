<?php
global $config, $twig, $logged, $account_logged, $db, $action;
defined('MYAAC') or die('Direct access not allowed!');

require_once SYSTEM . 'libs/ravyn_donate_checkout.php';

$hasMercadoPago = false;
$hasStripe = false;
$stripeReady = false;

if (file_exists(PLUGINS . 'mercadopago/config.php')) {
    require_once PLUGINS . 'mercadopago/config.php';
    $hasMercadoPago = (bool)($config['mercadoPago']['enabled'] ?? false) && ravynDonateMercadoPagoAccessToken() !== '';
}

$hasStripe = ravynDonateStripeVisible();
$stripeReady = ravynDonateStripeEnabled();

ravynDonateSyncGatewayPackages();

if (!$hasMercadoPago && !$hasStripe && !ravynDonatePixEnabled()) {
    echo 'Nenhum gateway de doação configurado.';
    return;
}

if (!extension_loaded('curl')) {
    echo 'Extensão PHP cURL é obrigatória para doações.';
    return;
}

$is_localhost = strpos(BASE_URL, 'localhost') !== false || strpos(BASE_URL, '127.0.0.1') !== false;
$enableDonateLocal = $config['enableDonateLocal'] ?? false;

if (empty($action)) {
    if (!$logged) {
        $was_before = $config['friendly_urls'];
        $config['friendly_urls'] = true;
        echo 'Para comprar coins você precisa estar logado. '
            . generateLink(getLink('?subtopic=accountmanagement') . '&redirect=' . urlencode(getLink('donate')), 'Faça login')
            . ' e volte para esta página.';
        $config['friendly_urls'] = $was_before;
        return;
    }

    echo $twig->render('donate-coins.html.twig', [
        'account_name' => $account_logged->getName(),
        'account_id' => $account_logged->getId(),
        'packages' => ravynDonatePackages(),
        'terms_bullets' => ravynDonateTermsBullets(),
        'terms_version' => ravynDonateTermsVersion(),
        'has_mercado_pago' => $hasMercadoPago,
        'has_stripe' => $hasStripe,
        'stripe_ready' => $stripeReady,
        'has_pix' => ravynDonatePixEnabled(),
        'pay_url' => getLink('donatepay'),
        'is_localhost' => $is_localhost,
        'enable_donate_local' => $enableDonateLocal,
        'payment_base_url' => ravynPublicBaseUrl(),
    ]);
} elseif ($action === 'final') {
    $orderRef = trim((string)($_GET['order'] ?? ''));
    $gateway = trim((string)($_GET['gateway'] ?? ''));
    $sessionId = trim((string)($_GET['session_id'] ?? ''));

    $order = null;
    $coins = 0;
    $loyaltyPoints = 0;
    $uiState = 'processing';

    if ($logged && $orderRef !== '' && strncmp($orderRef, 'RD-', 3) === 0 && isset($db)) {
        try {
            ravynDonateEnsureSchema($db);
            $order = ravynDonateGetOrderByRef($db, $orderRef);
            if ($order && (int)$order['account_id'] === (int)$account_logged->getId()) {
                if ($gateway === 'stripe' || ($order['gateway'] ?? '') === 'stripe') {
                    $sync = ravynDonateSyncStripeOrderStatus($db, $order, $sessionId);
                } elseif (($order['gateway'] ?? '') === 'pix') {
                    $sync = ravynDonateSyncPixOrderStatus($db, $order);
                } else {
                    $sync = [
                        'coins' => (int)$order['coins'],
                        'loyalty_points' => ravynDonateOrderLoyaltyPoints($order),
                        'ui_state' => (int)($order['delivered'] ?? 0) === 1 ? 'approved' : 'processing',
                    ];
                }
                $coins = (int)($sync['coins'] ?? 0);
                $loyaltyPoints = (int)($sync['loyalty_points'] ?? 0);
                $uiState = (string)($sync['ui_state'] ?? 'processing');
                $order = ravynDonateGetOrderByRef($db, $orderRef) ?: $order;
            }
        } catch (Throwable $e) {
            log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' donate final: ' . $e->getMessage());
            $uiState = 'processing';
        }
    }

    $statusUrl = '';
    if ($order && $gateway === 'stripe') {
        $statusUrl = BASE_URL . '?subtopic=donatestripstatus&order=' . urlencode($orderRef);
        if ($sessionId !== '') {
            $statusUrl .= '&session_id=' . urlencode($sessionId);
        }
    }

    try {
        echo $twig->render('donate-final.html.twig', [
            'order_ref' => $orderRef,
            'gateway' => $gateway,
            'session_id' => $sessionId,
            'status_url' => $statusUrl,
            'ui_state' => $uiState,
            'coins' => (int)$coins,
            'loyalty_points' => (int)$loyaltyPoints,
            'account_manage_url' => getLink('account/manage'),
            'donate_url' => getLink('donate'),
        ]);
    } catch (Throwable $e) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' donate final twig: ' . $e->getMessage());
        echo '<div style="max-width:640px;margin:24px auto;padding:20px;background:#1a2238;color:#dce8ff;border-radius:10px">'
            . '<h2 style="color:#3ecf7a">Pagamento recebido</h2>'
            . '<p>Seu pagamento foi processado. As coins serão creditadas em instantes.</p>'
            . '<p><a href="' . htmlspecialchars(getLink('account/manage'), ENT_QUOTES, 'UTF-8') . '">Minha conta</a></p></div>';
    }
}
