<?php
defined('MYAAC') or die('Direct access not allowed!');

function ravynDonateSyncGatewayPackages(): void
{
    global $config;
    if (!isset($config['ravynDonate']['packages'])) {
        return;
    }
    $donates = [];
    foreach ($config['ravynDonate']['packages'] as $id => $pack) {
        $donates[$id] = [
            'id' => $id,
            'value' => (float)$pack['brl'],
            'coins' => (int)$pack['coins'],
            'extra' => 0,
        ];
    }
    if (isset($config['mercadoPago'])) {
        $config['mercadoPago']['donates'] = $donates;
    }
    if (isset($config['stripe'])) {
        $config['stripe']['donates'] = $donates;
    }
}

function ravynDonateEnsureSchema($db): void
{
    $db->exec("CREATE TABLE IF NOT EXISTS `ravyn_donate_orders` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `order_ref` VARCHAR(32) NOT NULL,
        `account_id` INT UNSIGNED NOT NULL,
        `account_name` VARCHAR(64) NOT NULL,
        `package_id` VARCHAR(32) NOT NULL,
        `gateway` VARCHAR(16) NOT NULL,
        `coins` INT UNSIGNED NOT NULL,
        `amount_brl` DECIMAL(12,2) NOT NULL,
        `full_name` VARCHAR(128) NOT NULL,
        `birth_date` VARCHAR(16) NOT NULL,
        `region` VARCHAR(8) NOT NULL,
        `tax_id` VARCHAR(32) DEFAULT NULL,
        `email` VARCHAR(128) NOT NULL,
        `terms_version` VARCHAR(32) NOT NULL,
        `terms_accepted_at` DATETIME NOT NULL,
        `terms_ip` VARCHAR(45) DEFAULT NULL,
        `terms_user_agent` VARCHAR(255) DEFAULT NULL,
        `status` ENUM('pending','redirected','paid','failed','cancelled') NOT NULL DEFAULT 'pending',
        `gateway_ref` TEXT DEFAULT NULL,
        `payment_id` VARCHAR(64) DEFAULT NULL,
        `payment_status` VARCHAR(32) DEFAULT NULL,
        `delivered` TINYINT(1) NOT NULL DEFAULT 0,
        `request_log` MEDIUMTEXT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `paid_at` DATETIME NULL DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `order_ref` (`order_ref`),
        KEY `account_id` (`account_id`),
        KEY `payment_id` (`payment_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    ravynDonateMigrateSchema($db);
}

function ravynDonateMigrateSchema($db): void
{
    if (!$db->hasTable('ravyn_donate_orders')) {
        return;
    }
    try {
        if ($db->hasColumn('ravyn_donate_orders', 'gateway_ref')) {
            $db->exec('ALTER TABLE `ravyn_donate_orders` MODIFY `gateway_ref` TEXT NULL');
        }
        if (!$db->hasColumn('ravyn_donate_orders', 'payment_status')) {
            $db->exec('ALTER TABLE `ravyn_donate_orders` ADD `payment_status` VARCHAR(32) NULL DEFAULT NULL AFTER `payment_id`');
        }
    } catch (Throwable $e) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' migrate: ' . $e->getMessage());
    }
}

function ravynDonateWantsJson(): bool
{
    if (isset($_POST['response_format']) && $_POST['response_format'] === 'json') {
        return true;
    }
    $xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';
    return strtolower($xhr) === 'xmlhttprequest';
}

function ravynDonateJsonResponse(array $data, int $code = 200): void
{
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function ravynDonatePackages(): array
{
    global $config;
    require_once PLUGINS . 'ravyn_donate/config.php';
    return $config['ravynDonate']['packages'] ?? [];
}

function ravynDonateTermsVersion(): string
{
    global $config;
    require_once PLUGINS . 'ravyn_donate/config.php';
    return (string)($config['ravynDonate']['terms_version'] ?? '1');
}

function ravynDonateGatewayLabel(string $gateway): string
{
    return $gateway === 'stripe' ? 'Stripe' : 'Mercado Pago';
}

/**
 * Resolve Access Token do Mercado Pago (config.local.php ou variável de ambiente).
 */
function ravynDonateMercadoPagoAccessToken(): string
{
    global $config;
    if (!isset($config['mercadoPago']) || !is_array($config['mercadoPago'])) {
        return '';
    }

    $mp = $config['mercadoPago'];
    $env = $mp['environment'] ?? 'production';
    $candidates = [];

    if (isset($mp['accessToken']) && is_array($mp['accessToken'])) {
        $candidates[] = $mp['accessToken'][$env] ?? '';
        $candidates[] = $mp['accessToken']['production'] ?? '';
        $candidates[] = $mp['accessToken']['sandbox'] ?? '';
    } elseif (isset($mp['accessToken']) && is_string($mp['accessToken'])) {
        $candidates[] = $mp['accessToken'];
    }

    foreach (['access_token', 'token', 'production_access_token'] as $legacyKey) {
        if (!empty($mp[$legacyKey])) {
            $candidates[] = $mp[$legacyKey];
        }
    }

    foreach ([getenv('MP_ACCESS_TOKEN'), getenv('MERCADOPAGO_ACCESS_TOKEN')] as $envToken) {
        if (is_string($envToken) && $envToken !== '') {
            $candidates[] = $envToken;
        }
    }

    foreach ($candidates as $token) {
        $token = trim((string)$token);
        if ($token !== '') {
            return $token;
        }
    }

    return '';
}

function ravynDonateStripeSecretKey(): string
{
    global $config;
    if (!isset($config['stripe']) || !is_array($config['stripe'])) {
        return '';
    }

    $stripe = $config['stripe'];
    if (!($stripe['enabled'] ?? false)) {
        return '';
    }

    $env = (string)($stripe['environment'] ?? 'production');
    if (!in_array($env, ['production', 'sandbox'], true)) {
        $env = 'production';
    }

    $key = trim((string)($stripe['secretKey'][$env] ?? ''));
    // Só usa production como fallback quando o ambiente ativo é sandbox e está vazio
    if ($key === '' && $env === 'sandbox') {
        $key = trim((string)($stripe['secretKey']['production'] ?? ''));
    }

    return $key;
}

function ravynDonateStripeEnabled(): bool
{
    return ravynDonateStripeSecretKey() !== '';
}

function ravynDonateStripeSecretKeyProblem(?string $key = null): string
{
    $key = trim($key ?? ravynDonateStripeSecretKey());
    if ($key === '') {
        return 'Defina secretKey em config.local.php (Secret key sk_live_... no painel Stripe).';
    }
    if (str_starts_with($key, 'pk_')) {
        return 'Você colocou a Publishable key (pk_...) em secretKey. Use a Secret key (sk_live_...).';
    }
    if (preg_match('/(AQUI|COLE_|SUA_CHAVE|\.\.\.)/i', $key)) {
        return 'secretKey ainda é texto de exemplo. Cole a Secret key real do Stripe Dashboard.';
    }
    if (!preg_match('/^sk_(live|test)_[A-Za-z0-9]+$/', $key)) {
        return 'secretKey inválida: deve começar com sk_live_ ou sk_test_ (sem espaços).';
    }

    return '';
}

/**
 * Exibir card Stripe na página donate (independente de secretKey configurada).
 */
function ravynDonateStripeVisible(): bool
{
    global $config;

    require_once PLUGINS . 'ravyn_donate/config.php';
    if (!($config['ravynDonate']['stripe_visible'] ?? true)) {
        return false;
    }

    if (!file_exists(PLUGINS . 'stripe/config.php')) {
        return false;
    }

    require_once PLUGINS . 'stripe/config.php';

    if (array_key_exists('enabled', $config['stripe'] ?? []) && !($config['stripe']['enabled'])) {
        return false;
    }

    return true;
}

function ravynDonatePixConfig(): array
{
    global $config;
    require_once PLUGINS . 'ravyn_donate/config.php';
    return is_array($config['ravynDonate']['pix'] ?? null) ? $config['ravynDonate']['pix'] : [];
}

function ravynDonatePixEnabled(): bool
{
    $pix = ravynDonatePixConfig();
    return !empty($pix['enabled']);
}

function ravynDonatePixStaticFallback(array $order): array
{
    $pix = ravynDonatePixConfig();
    return [
        'payment_id' => '',
        'qr_code' => (string)($pix['static_copy_paste'] ?? ''),
        'qr_code_base64' => '',
        'ticket_url' => '',
        'pix_key' => (string)($pix['mercadopago_key'] ?? ''),
        'qr_image' => (string)($pix['qr_image'] ?? 'images/payments/pix-qrcode-mercadopago.png'),
        'source' => 'static',
    ];
}

function ravynDonateCreateMercadoPagoPix(array $order, ?string &$error = null): ?array
{
    $accessToken = ravynDonateMercadoPagoAccessToken();
    if ($accessToken === '') {
        $error = 'Token do Mercado Pago não configurado para gerar PIX.';
        return null;
    }

    $baseUrl = ravynPublicBaseUrl();
    $notificationUrl = rtrim($baseUrl, '/') . '/payments/mercadopago.php';
    $nameParts = preg_split('/\s+/', trim((string)$order['full_name']), 2);
    $firstName = $nameParts[0] ?? 'Cliente';
    $lastName = $nameParts[1] ?? 'RavynCore';

    $amount = round((float)$order['amount_brl'], 2);
    if ($amount < 0.5) {
        $error = 'Valor mínimo do PIX no Mercado Pago é R$ 0,50. Ajuste o pacote de teste para R$ 0,50 ou mais.';
        return null;
    }

    $payload = [
        'transaction_amount' => $amount,
        'description' => $order['coins'] . ' RavynCore Coins',
        'payment_method_id' => 'pix',
        'external_reference' => $order['order_ref'],
        'payer' => [
            'email' => $order['email'],
            'first_name' => $firstName,
            'last_name' => $lastName,
        ],
    ];

    if (stripos($notificationUrl, 'https://') === 0) {
        $payload['notification_url'] = $notificationUrl;
    }

    if (!empty($order['tax_id'])) {
        $payload['payer']['identification'] = [
            'type' => ($order['region'] ?? 'BR') === 'BR' ? 'CPF' : 'Otro',
            'number' => preg_replace('/\D/', '', (string)$order['tax_id']),
        ];
    }

    $ch = curl_init('https://api.mercadopago.com/v1/payments');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            'X-Idempotency-Key: ' . $order['order_ref'],
        ],
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_TIMEOUT => 30,
    ]);
    $response = curl_exec($ch);
    $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode((string)$response, true);
    if ($response === false || !in_array($httpCode, [200, 201], true) || !is_array($data)) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' PIX HTTP ' . $httpCode . ': ' . (string)$response);
        $apiMessage = '';
        if (is_array($data)) {
            $apiMessage = trim((string)($data['message'] ?? ($data['error'] ?? '')));
            if (!empty($data['cause']) && is_array($data['cause'])) {
                $parts = [];
                foreach ($data['cause'] as $cause) {
                    if (is_array($cause)) {
                        $parts[] = trim((string)(($cause['code'] ?? '') . ' ' . ($cause['description'] ?? '')));
                    }
                }
                if (!empty($parts)) {
                    $apiMessage .= ($apiMessage !== '' ? ' | ' : '') . implode('; ', $parts);
                }
            }
        }
        $error = 'Não foi possível gerar o PIX no Mercado Pago.' . ($apiMessage !== '' ? ' ' . $apiMessage : '');
        return null;
    }

    $tx = $data['point_of_interaction']['transaction_data'] ?? [];
    $qrCode = (string)($tx['qr_code'] ?? '');
    if ($qrCode === '') {
        $error = 'Mercado Pago não retornou o código PIX.';
        return null;
    }

    $pixCfg = ravynDonatePixConfig();
    return [
        'payment_id' => (string)($data['id'] ?? ''),
        'qr_code' => $qrCode,
        'qr_code_base64' => (string)($tx['qr_code_base64'] ?? ''),
        'ticket_url' => (string)($tx['ticket_url'] ?? ''),
        'pix_key' => (string)($pixCfg['mercadopago_key'] ?? ''),
        'qr_image' => (string)($pixCfg['qr_image'] ?? ''),
        'source' => 'mercadopago_api',
        'status' => (string)($data['status'] ?? 'pending'),
    ];
}

function ravynDonateResolvePixForOrder(array $order): array
{
    $pixCfg = ravynDonatePixConfig();
    $qrCode = (string)($order['gateway_ref'] ?? '');
    $base64 = '';
    $paymentId = (string)($order['payment_id'] ?? '');
    $status = (string)($order['payment_status'] ?? $order['status'] ?? 'pending');

    if ($paymentId !== '' && ravynDonateMercadoPagoAccessToken() !== '') {
        $ch = curl_init('https://api.mercadopago.com/v1/payments/' . urlencode($paymentId));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . ravynDonateMercadoPagoAccessToken(),
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT => 20,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode((string)$response, true);
        if (is_array($data)) {
            $status = (string)($data['status'] ?? $status);
            $tx = $data['point_of_interaction']['transaction_data'] ?? [];
            if (!empty($tx['qr_code'])) {
                $qrCode = (string)$tx['qr_code'];
            }
            if (!empty($tx['qr_code_base64'])) {
                $base64 = (string)$tx['qr_code_base64'];
            }
        }
    }

    return [
        'payment_id' => $paymentId,
        'qr_code' => $qrCode,
        'qr_code_base64' => $base64,
        'pix_key' => (string)($pixCfg['mercadopago_key'] ?? ''),
        'qr_image' => (string)($pixCfg['qr_image'] ?? 'images/payments/pix-qrcode-mercadopago.png'),
        'status' => $status,
    ];
}

function ravynDonateMapPixStatusToOrderStatus(string $paymentStatus): string
{
    $s = strtolower(trim($paymentStatus));
    if (in_array($s, ['approved', 'paid', 'authorized', 'completed'], true)) {
        return 'paid';
    }
    if (in_array($s, ['rejected', 'cancelled', 'refunded', 'charged_back'], true)) {
        return 'failed';
    }
    return 'pending';
}

function ravynDonatePixUiState(string $paymentStatus, string $orderStatus): string
{
    $ps = strtolower(trim($paymentStatus));
    $os = strtolower(trim($orderStatus));
    if ($os === 'cancelled') {
        return 'cancelled';
    }
    if ($os === 'failed' || in_array($ps, ['rejected', 'cancelled', 'refunded', 'charged_back'], true)) {
        return 'rejected';
    }
    if ($os === 'paid' || in_array($ps, ['approved', 'paid', 'authorized', 'completed'], true)) {
        return 'approved';
    }
    if (in_array($ps, ['in_process', 'processing', 'pending_waiting_transfer'], true)) {
        return 'processing';
    }
    return 'pending';
}

function ravynDonateOrderLoyaltyPoints(array $order): int
{
    global $config;

    $amountBrl = (float)($order['amount_brl'] ?? 0);
    if ($amountBrl <= 0) {
        return 0;
    }

    if (isset($config['ravyn_loyalty_donation_enabled']) && $config['ravyn_loyalty_donation_enabled'] === false) {
        return 0;
    }

    $perReal = 1;
    if (isset($config['ravyn_loyalty_points_per_real']) && (int)$config['ravyn_loyalty_points_per_real'] > 0) {
        $perReal = (int)$config['ravyn_loyalty_points_per_real'];
    }

    return (int)floor($amountBrl * $perReal);
}

function ravynDonateSyncPixOrderStatus($db, array $order): array
{
    $pixCfg = ravynDonatePixConfig();
    $timeoutSeconds = max(60, (int)($pixCfg['timeout_seconds'] ?? 600));

    $paymentStatus = (string)($order['payment_status'] ?? 'pending');
    $orderStatus = (string)($order['status'] ?? 'pending');
    $paymentId = trim((string)($order['payment_id'] ?? ''));

    if ($paymentId === '' && ravynDonateMercadoPagoAccessToken() !== '' && in_array(strtolower($orderStatus), ['pending', 'redirected'], true)) {
        $matched = ravynDonateFindUnlinkedApprovedPixPaymentForOrder($db, $order);
        if (is_array($matched)) {
            $paymentId = (string)($matched['payment_id'] ?? '');
            $paymentStatus = (string)($matched['payment_status'] ?? 'approved');
            if ($paymentId !== '') {
                $db->exec(
                    'UPDATE `ravyn_donate_orders` SET `payment_id` = ' . $db->quote($paymentId)
                    . ', `payment_status` = ' . $db->quote($paymentStatus)
                    . ' WHERE `id` = ' . (int)$order['id']
                );
                $order['payment_id'] = $paymentId;
                $order['payment_status'] = $paymentStatus;
                ravynDonateDeliverOrder($db, $order, $paymentId, $paymentStatus, 'mercadopago');
                $orderStatus = 'paid';
            }
        }
    }

    if ($paymentId !== '' && ravynDonateMercadoPagoAccessToken() !== '') {
        $ch = curl_init('https://api.mercadopago.com/v1/payments/' . urlencode($paymentId));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . ravynDonateMercadoPagoAccessToken(),
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT => 20,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode((string)$response, true);
        if (is_array($data)) {
            $paymentStatus = (string)($data['status'] ?? $paymentStatus);
            $nextOrderStatus = ravynDonateMapPixStatusToOrderStatus($paymentStatus);
            if ($nextOrderStatus !== strtolower($orderStatus)) {
                $orderStatus = $nextOrderStatus;
            }
            if ($orderStatus === 'paid' && (int)($order['delivered'] ?? 0) !== 1) {
                ravynDonateDeliverOrder($db, $order, $paymentId, $paymentStatus, 'mercadopago');
                $orderStatus = 'paid';
            } else {
                $db->exec(
                    'UPDATE `ravyn_donate_orders` SET `payment_status` = ' . $db->quote($paymentStatus)
                    . ', `status` = ' . $db->quote($orderStatus)
                    . ' WHERE `id` = ' . (int)$order['id']
                );
            }
        }
    }

    $createdAt = strtotime((string)($order['created_at'] ?? 'now'));
    $expiresAt = $createdAt + $timeoutSeconds;
    $remaining = max(0, $expiresAt - time());

    $deliveredFlag = (int)($order['delivered'] ?? 0);
    if ($remaining <= 0 && $deliveredFlag !== 1 && in_array(strtolower($orderStatus), ['pending', 'redirected'], true)) {
        $orderStatus = 'cancelled';
        $paymentStatus = $paymentStatus !== '' ? $paymentStatus : 'cancelled';
        $db->exec(
            'UPDATE `ravyn_donate_orders` SET `status` = \'cancelled\', `payment_status` = '
            . $db->quote($paymentStatus) . ' WHERE `id` = ' . (int)$order['id']
        );
    }

    $fresh = ravynDonateGetOrderByRef($db, (string)$order['order_ref']);
    if (is_array($fresh)) {
        $order = $fresh;
        $orderStatus = strtolower((string)($order['status'] ?? $orderStatus));
        $paymentStatus = strtolower((string)($order['payment_status'] ?? $paymentStatus));
        $deliveredFlag = (int)($order['delivered'] ?? 0);
    }

    if ($deliveredFlag === 1) {
        $orderStatus = 'paid';
        if ($paymentStatus === '' || $paymentStatus === 'pending') {
            $paymentStatus = 'approved';
        }
    }

    $uiState = ravynDonatePixUiState((string)$paymentStatus, (string)$orderStatus);
    if ($deliveredFlag === 1) {
        $uiState = 'approved';
    }

    return [
        'order_status' => strtolower($orderStatus),
        'payment_status' => strtolower((string)$paymentStatus),
        'remaining_seconds' => $remaining,
        'ui_state' => $uiState,
        'delivered' => $deliveredFlag,
        'coins' => (int)($order['coins'] ?? 0),
        'loyalty_points' => ravynDonateOrderLoyaltyPoints($order),
        'amount_brl' => (float)($order['amount_brl'] ?? 0),
        'redirect_delay_seconds' => max(8, (int)($pixCfg['final_delay_seconds'] ?? 15)),
        'success_display_seconds' => max(8, (int)($pixCfg['success_display_seconds'] ?? 12)),
    ];
}

function ravynDonateFindUnlinkedApprovedPixPaymentForOrder($db, array $order): ?array
{
    $accessToken = ravynDonateMercadoPagoAccessToken();
    if ($accessToken === '') {
        return null;
    }

    $createdAt = strtotime((string)($order['created_at'] ?? 'now'));
    if ($createdAt <= 0) {
        $createdAt = time() - 3600;
    }

    $begin = gmdate('Y-m-d\\TH:i:s\\Z', max(0, $createdAt - 300));
    $end = gmdate('Y-m-d\\TH:i:s\\Z', time() + 60);
    $amount = (float)($order['amount_brl'] ?? 0);
    if ($amount <= 0) {
        return null;
    }

    $endpoint = 'https://api.mercadopago.com/v1/payments/search'
        . '?sort=date_created&criteria=desc&status=approved&limit=50'
        . '&begin_date=' . rawurlencode($begin)
        . '&end_date=' . rawurlencode($end);

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ],
        CURLOPT_TIMEOUT => 20,
    ]);
    $response = curl_exec($ch);
    $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($response === false || $httpCode < 200 || $httpCode >= 300) {
        return null;
    }

    $data = json_decode((string)$response, true);
    if (!is_array($data) || !is_array($data['results'] ?? null)) {
        return null;
    }

    foreach ($data['results'] as $payment) {
        if (!is_array($payment)) {
            continue;
        }
        $pid = (string)($payment['id'] ?? '');
        if ($pid === '') {
            continue;
        }
        $method = strtolower((string)($payment['payment_method_id'] ?? ''));
        if ($method !== 'pix') {
            continue;
        }
        $status = strtolower((string)($payment['status'] ?? ''));
        if ($status !== 'approved') {
            continue;
        }
        $pAmount = (float)($payment['transaction_amount'] ?? 0);
        if (abs($pAmount - $amount) > 0.00001) {
            continue;
        }

        $exists = $db->query(
            'SELECT `id` FROM `ravyn_donate_orders` WHERE `payment_id` = ' . $db->quote($pid)
            . ' AND `id` != ' . (int)$order['id'] . ' LIMIT 1'
        )->fetch();
        if ($exists) {
            continue;
        }

        return [
            'payment_id' => $pid,
            'payment_status' => $status,
        ];
    }

    return null;
}

function ravynDonateTermsBullets(): array
{
    return [
        'If you are under 18 years old, you must have permission from a parent or legal guardian before making any donation/payment.',
        'You may only make donations/payments using funds that legally belong to you or that you are authorized to use.',
        'All payments are voluntary donations/payments made to support the server. No physical goods are shipped, and no ownership rights are transferred.',
        'Any perks, rewards, ranks, or virtual items provided are considered bonus incentives and not guaranteed products or services.',
        'All donation/payment rewards are delivered automatically and, in most cases, instantly upon successful payment confirmation.',
        'By completing a payment, you acknowledge that you will receive your rewards immediately and waive the right to claim that the product/service was not delivered.',
        'Donation/payment rewards may be modified, replaced, delayed, or removed at any time without prior notice.',
        'The server may be reset, wiped, or modified at any time for maintenance or operational reasons. In such cases, donation/payment rewards may be reissued at our discretion, but are not guaranteed.',
        'You acknowledge that digital items, ranks, or perks may change, lose value, or become unavailable over time.',
        'If rewards are lost due to gameplay, bugs, updates, or server resets, restoration is not guaranteed.',
        'We reserve the right to suspend or terminate accounts that violate server rules without refund.',
        'All donations/payments are final and non-refundable. By completing a payment, you waive your right to request a chargeback or dispute, except where required by law.',
        'Attempting to open a chargeback or dispute after receiving rewards may result in permanent suspension from the server and revocation of all associated benefits.',
        'We reserve the right to update or modify these Terms and Conditions at any time without prior notice.',
    ];
}

function ravynDonateValidateCpf(string $cpf): bool
{
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $sum = 0;
        for ($i = 0; $i < $t; $i++) {
            $sum += (int)$cpf[$i] * (($t + 1) - $i);
        }
        $d = ((10 * $sum) % 11) % 10;
        if ((int)$cpf[$t] !== $d) {
            return false;
        }
    }
    return true;
}

/**
 * Hook para validação externa de CPF+nome+nascimento.
 * Para ativar, configure em config.local.php:
 * $config['cpf_validation_api']['enabled'] = true;
 * $config['cpf_validation_api']['endpoint'] = 'https://api.exemplo.com/verify';
 * $config['cpf_validation_api']['token'] = '...';
 */
function ravynDonateVerifyCpfIdentity(string $cpf, string $fullName, string $birthDate): bool
{
    global $config;
    $apiCfg = $config['cpf_validation_api'] ?? [];
    if (empty($apiCfg['enabled'])) {
        return true;
    }
    $endpoint = trim((string)($apiCfg['endpoint'] ?? ''));
    if ($endpoint === '') {
        return false;
    }
    $payload = [
        'cpf' => preg_replace('/\D/', '', $cpf),
        'full_name' => $fullName,
        'birth_date' => $birthDate,
    ];
    $headers = ['Content-Type: application/json'];
    if (!empty($apiCfg['token'])) {
        $headers[] = 'Authorization: Bearer ' . $apiCfg['token'];
    }
    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_TIMEOUT => 12,
    ]);
    $response = curl_exec($ch);
    $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($httpCode < 200 || $httpCode >= 300 || !is_string($response) || $response === '') {
        return false;
    }
    $data = json_decode($response, true);
    return is_array($data) && !empty($data['valid']);
}

function ravynDonateNormalizeBirthDate(string $s): string
{
    $s = trim($s);
    if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $s)) {
        return $s;
    }
    $digits = preg_replace('/\D/', '', $s);
    if (strlen($digits) === 8) {
        return substr($digits, 0, 2) . '/' . substr($digits, 2, 2) . '/' . substr($digits, 4, 4);
    }
    return $s;
}

function ravynDonateValidateBirthDate(string $s): bool
{
    $s = ravynDonateNormalizeBirthDate($s);
    if (!preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $s, $m)) {
        return false;
    }
    $d = (int)$m[1];
    $mo = (int)$m[2];
    $y = (int)$m[3];
    return checkdate($mo, $d, $y);
}

function ravynDonateRedirectTo(string $url): void
{
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    if (!headers_sent()) {
        header('Location: ' . $url, true, 302);
        exit;
    }
    $safe = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><meta http-equiv="refresh" content="0;url='
        . $safe . '"></head><body><p>Redirecionando...</p><script>window.location.replace('
        . json_encode($url) . ');</script></body></html>';
    exit;
}

function ravynDonateNewOrderRef(): string
{
    return 'RD-' . strtoupper(bin2hex(random_bytes(6)));
}

function ravynDonateCreateOrder($db, array $data): ?array
{
    ravynDonateEnsureSchema($db);
    $orderRef = ravynDonateNewOrderRef();
    $now = date('Y-m-d H:i:s');
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

    $db->exec(
        'INSERT INTO `ravyn_donate_orders`
        (`order_ref`, `account_id`, `account_name`, `package_id`, `gateway`, `coins`, `amount_brl`,
         `full_name`, `birth_date`, `region`, `tax_id`, `email`, `terms_version`, `terms_accepted_at`,
         `terms_ip`, `terms_user_agent`, `status`)
        VALUES ('
        . $db->quote($orderRef) . ', '
        . (int)$data['account_id'] . ', '
        . $db->quote($data['account_name']) . ', '
        . $db->quote($data['package_id']) . ', '
        . $db->quote($data['gateway']) . ', '
        . (int)$data['coins'] . ', '
        . (float)$data['amount_brl'] . ', '
        . $db->quote($data['full_name']) . ', '
        . $db->quote($data['birth_date']) . ', '
        . $db->quote($data['region']) . ', '
        . $db->quote($data['tax_id']) . ', '
        . $db->quote($data['email']) . ', '
        . $db->quote($data['terms_version']) . ', '
        . $db->quote($now) . ', '
        . $db->quote($ip) . ', '
        . $db->quote($ua) . ", 'pending')"
    );

    $id = (int)$db->lastInsertId();
    return $db->query('SELECT * FROM `ravyn_donate_orders` WHERE `id` = ' . $id)->fetch();
}

function ravynDonateGetOrderByRef($db, string $orderRef): ?array
{
    ravynDonateEnsureSchema($db);
    $row = $db->query(
        'SELECT * FROM `ravyn_donate_orders` WHERE `order_ref` = ' . $db->quote($orderRef) . ' LIMIT 1'
    )->fetch();
    return $row ?: null;
}

function ravynDonateDeliverOrder($db, array $order, string $paymentId, string $paymentStatus, string $gateway): bool
{
    if ((int)$order['delivered'] === 1) {
        return true;
    }
    if (!in_array(strtolower($paymentStatus), ['approved', 'paid', 'confirmed', 'completed'], true)) {
        return false;
    }

    global $config;
    $accountId = (int)$order['account_id'];
    $coins = (int)$order['coins'];
    $field = strtolower($config['mercadoPago']['donationType'] ?? 'coins_transferable');
    $field = preg_replace('/[^a-z_]/', '', $field);
    if ($field === '' || !$db->hasColumn('accounts', $field)) {
        $field = 'coins_transferable';
    }

    $db->beginTransaction();
    try {
        $db->exec("UPDATE `accounts` SET `{$field}` = `{$field}` + {$coins} WHERE `id` = {$accountId}");
        if (function_exists('ravynGrantDonationLoyaltyPoints')) {
            ravynGrantDonationLoyaltyPoints($accountId, (float)$order['amount_brl']);
        }
        $desc = $db->quote('Donate - ' . ravynDonateGatewayLabel($gateway) . ' (' . $order['order_ref'] . ')');
        $now = date('Y-m-d H:i:s');
        if ($db->hasTable('coins_transactions')) {
            $db->exec("INSERT INTO `coins_transactions` (`account_id`, `type`, `amount`, `description`, `timestamp`, `coin_type`)
                VALUES ({$accountId}, 1, {$coins}, {$desc}, {$db->quote($now)}, 3)");
        }
        if ($db->hasTable('store_history')) {
            $ts = strtotime($now);
            $db->exec("INSERT INTO `store_history` (`account_id`, `mode`, `description`, `coin_type`, `coin_amount`, `time`, `timestamp`, `coins`)
                VALUES ({$accountId}, 0, {$desc}, 3, {$coins}, {$ts}, 0, 0)");
        }
        $db->exec(
            'UPDATE `ravyn_donate_orders` SET `status` = \'paid\', `delivered` = 1, `payment_id` = '
            . $db->quote($paymentId) . ', `payment_status` = ' . $db->quote($paymentStatus)
            . ', `paid_at` = NOW() WHERE `id` = ' . (int)$order['id']
        );
        $db->commit();
        log_append('ravyn_donate.log', date('Y-m-d H:i:s') . " DELIVERED {$order['order_ref']} account={$accountId} coins={$coins} pay={$paymentId}");
        return true;
    } catch (Throwable $e) {
        if ($db->inTransaction()) {
            $db->rollBack();
        }
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' deliver: ' . $e->getMessage());
        return false;
    }
}

function ravynDonateMercadoPagoCheckoutError(string $response, int $httpCode, string $curlError = ''): string
{
    $msg = 'Não foi possível abrir o Mercado Pago.';
    $decoded = is_string($response) ? json_decode($response, true) : null;
    if (is_array($decoded)) {
        $api = trim((string)($decoded['message'] ?? ($decoded['error'] ?? '')));
        if ($api !== '') {
            $msg .= ' ' . $api;
        }
    }
    if (stripos($msg, 'https') === false && $httpCode > 0) {
        $msg .= ' Verifique payment_public_url com HTTPS no config.local.php.';
    }
    if ($curlError !== '') {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' MP curl: ' . $curlError);
    }
    return $msg;
}

function ravynDonateCreateMercadoPagoCheckout(array $order, ?string &$error = null): ?string
{
    global $config;
    require_once PLUGINS . 'mercadopago/config.php';
    ravynDonateSyncGatewayPackages();

    $environment = $config['mercadoPago']['environment'] ?? 'production';
    $accessToken = ravynDonateMercadoPagoAccessToken();
    if ($accessToken === '') {
        $error = 'Token do Mercado Pago não configurado. No servidor, edite config.local.php e defina '
            . '$config[\'mercadoPago\'][\'accessToken\'][\'production\'] = \'APP_USR-...\'; '
            . '(credenciais em https://www.mercadopago.com.br/developers/panel/credentials).';
        return null;
    }

    $baseUrl = ravynPublicBaseUrl();
    $redirectPath = $config['mercadoPago']['urlRedirect'] ?? '?subtopic=donate&action=final';
    $successUrl = $baseUrl . ltrim($redirectPath, '/') . '&gateway=mercadopago&order=' . urlencode($order['order_ref']);
    $failureUrl = $baseUrl . '?subtopic=donate&order=' . urlencode($order['order_ref']);
    $notificationUrl = rtrim($baseUrl, '/') . '/payments/mercadopago.php';

    $desc = $order['coins'] . ' RavynCore Coins';
    $payload = [
        'items' => [[
            'id' => (string)$order['package_id'],
            'title' => $desc,
            'description' => 'Donate: ' . $desc,
            'quantity' => 1,
            'currency_id' => 'BRL',
            'unit_price' => (float)$order['amount_brl'],
        ]],
        'external_reference' => $order['order_ref'],
        'back_urls' => [
            'success' => $successUrl,
            'pending' => $successUrl,
            'failure' => $failureUrl,
        ],
        'metadata' => [
            'order_ref' => $order['order_ref'],
            'code' => $order['package_id'],
            'account_id' => (string)$order['account_id'],
        ],
    ];

    $payer = ['email' => $order['email']];
    if (!empty($order['full_name'])) {
        $payer['name'] = $order['full_name'];
    }
    if (!empty($order['tax_id'])) {
        $payer['identification'] = [
            'type' => ($order['region'] ?? 'BR') === 'BR' ? 'CPF' : 'Otro',
            'number' => preg_replace('/\D/', '', (string)$order['tax_id']),
        ];
    }
    $payload['payer'] = $payer;

    $httpsOk = stripos($successUrl, 'https://') === 0 && stripos($notificationUrl, 'https://') === 0;
    if ($httpsOk) {
        $payload['notification_url'] = $notificationUrl;
        $payload['auto_return'] = 'approved';
    } else {
        log_append(
            'ravyn_donate_errors.log',
            date('Y-m-d H:i:s') . ' MP: URLs sem HTTPS success=' . $successUrl . ' notify=' . $notificationUrl
        );
        $error = 'Mercado Pago exige HTTPS. Configure payment_public_url com https:// no config.local.php.';
        return null;
    }

    $pmConfig = $config['mercadoPago']['paymentMethods'] ?? [];
    $maxInstallments = (int)($pmConfig['maxInstallments'] ?? 12);
    if ($maxInstallments > 0) {
        $payload['payment_methods'] = ['installments' => min($maxInstallments, 24)];
    }

    $ch = curl_init('https://api.mercadopago.com/checkout/preferences');
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

    $data = json_decode((string)$response, true);
    $checkoutUrl = null;
    if ($environment === 'sandbox' && !empty($data['sandbox_init_point'])) {
        $checkoutUrl = $data['sandbox_init_point'];
    } elseif (!empty($data['init_point'])) {
        $checkoutUrl = $data['init_point'];
    }

    if ($response === false || !in_array($httpCode, [200, 201], true) || empty($checkoutUrl)) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' MP HTTP ' . $httpCode . ': ' . (string)$response);
        $error = ravynDonateMercadoPagoCheckoutError((string)$response, $httpCode, $curlError);
        return null;
    }
    return $checkoutUrl;
}

function ravynDonateSyncStripeOrderStatus($db, array $order, string $sessionId = ''): array
{
    $sessionId = trim($sessionId);
    if ($sessionId === '') {
        $sessionId = trim((string)($order['payment_id'] ?? ''));
    }

    $orderStatus = strtolower((string)($order['status'] ?? 'pending'));
    $paymentStatus = strtolower((string)($order['payment_status'] ?? 'pending'));
    $deliveredFlag = (int)($order['delivered'] ?? 0);

    $secretKey = ravynDonateStripeSecretKey();
    if ($sessionId !== '' && $secretKey !== '' && str_starts_with($sessionId, 'cs_')) {
        $ch = curl_init('https://api.stripe.com/v1/checkout/sessions/' . urlencode($sessionId));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $secretKey,
            ],
            CURLOPT_TIMEOUT => 25,
        ]);
        $response = curl_exec($ch);
        $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode((string)$response, true);
        if (is_array($data) && in_array($httpCode, [200, 201], true)) {
            $paymentStatus = strtolower((string)($data['payment_status'] ?? $paymentStatus));
            if ($paymentStatus === 'paid' || $paymentStatus === 'no_payment_required') {
                $orderStatus = 'paid';
                if ($deliveredFlag !== 1) {
                    ravynDonateDeliverOrder($db, $order, $sessionId, 'paid', 'stripe');
                } else {
                    $db->exec(
                        'UPDATE `ravyn_donate_orders` SET `status` = \'paid\', `payment_status` = '
                        . $db->quote($paymentStatus) . ', `payment_id` = ' . $db->quote($sessionId)
                        . ' WHERE `id` = ' . (int)$order['id']
                    );
                }
            } elseif (in_array($paymentStatus, ['unpaid', 'open'], true)) {
                $orderStatus = in_array($orderStatus, ['paid'], true) ? $orderStatus : 'redirected';
            } else {
                $db->exec(
                    'UPDATE `ravyn_donate_orders` SET `payment_status` = ' . $db->quote($paymentStatus)
                    . ', `payment_id` = ' . $db->quote($sessionId)
                    . ' WHERE `id` = ' . (int)$order['id']
                );
            }
        }
    }

    $fresh = ravynDonateGetOrderByRef($db, (string)$order['order_ref']);
    if (is_array($fresh)) {
        $order = $fresh;
        $orderStatus = strtolower((string)($order['status'] ?? $orderStatus));
        $paymentStatus = strtolower((string)($order['payment_status'] ?? $paymentStatus));
        $deliveredFlag = (int)($order['delivered'] ?? 0);
    }

    if ($deliveredFlag === 1) {
        $orderStatus = 'paid';
        if ($paymentStatus === '' || $paymentStatus === 'pending') {
            $paymentStatus = 'paid';
        }
    }

    $uiState = ravynDonatePixUiState($paymentStatus, $orderStatus);
    if ($deliveredFlag === 1) {
        $uiState = 'approved';
    }

    return [
        'order_status' => $orderStatus,
        'payment_status' => $paymentStatus,
        'ui_state' => $uiState,
        'delivered' => $deliveredFlag,
        'coins' => (int)($order['coins'] ?? 0),
        'loyalty_points' => ravynDonateOrderLoyaltyPoints($order),
        'amount_brl' => (float)($order['amount_brl'] ?? 0),
        'session_id' => $sessionId,
    ];
}

function ravynDonateCreateStripeCheckout(array $order, ?string &$error = null, ?string &$sessionId = null): ?string
{
    $secretKey = ravynDonateStripeSecretKey();
    $keyProblem = ravynDonateStripeSecretKeyProblem($secretKey);
    if ($keyProblem !== '') {
        $error = 'Stripe: ' . $keyProblem;
        return null;
    }

    $baseUrl = ravynPublicBaseUrl();
    $successUrl = $baseUrl . '?subtopic=donate&action=final&gateway=stripe&order='
        . urlencode((string)$order['order_ref']) . '&session_id={CHECKOUT_SESSION_ID}';
    $cancelUrl = $baseUrl . '?subtopic=donate';

    $unitAmount = (int)round((float)$order['amount_brl'] * 100);
    if ($unitAmount < 50) {
        $error = 'Valor mínimo para Stripe é R$ 0,50.';
        return null;
    }

    $payload = [
        'mode' => 'payment',
        'success_url' => $successUrl,
        'cancel_url' => $cancelUrl,
        'client_reference_id' => (string)$order['order_ref'],
        'customer_email' => (string)$order['email'],
        'locale' => 'pt-BR',
        'payment_method_types' => ['card'],
        'metadata' => [
            'order_ref' => (string)$order['order_ref'],
            'code' => (string)$order['package_id'],
            'account_id' => (string)$order['account_id'],
        ],
        'line_items' => [[
            'quantity' => 1,
            'price_data' => [
                'currency' => 'brl',
                'unit_amount' => $unitAmount,
                'product_data' => [
                    'name' => (int)$order['coins'] . ' RavynCore Coins',
                    'description' => 'Doação RavynCore — pedido ' . (string)$order['order_ref'],
                ],
            ],
        ]],
    ];

    $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $secretKey,
            'Content-Type: application/json',
        ],
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_TIMEOUT => 30,
    ]);
    $response = curl_exec($ch);
    $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode((string)$response, true);
    if ($response === false || !in_array($httpCode, [200, 201], true) || empty($data['url'])) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' Stripe HTTP ' . $httpCode . ': ' . (string)$response);
        $api = is_array($data) ? trim((string)($data['error']['message'] ?? '')) : '';
        $keyHint = substr($secretKey, 0, 7) . '…' . substr($secretKey, -4);
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' Stripe key used prefix/suffix: ' . $keyHint);
        if (stripos($api, 'Invalid API Key') !== false) {
            $error = 'Stripe recusou a Secret key. No VPS, em config.local.php use sk_live_... em secretKey[production], '
                . 'environment=production, e remova chaves antigas em secretKey[sandbox]. Veja: bash deploy/check-stripe.php';
        } else {
            $error = 'Não foi possível abrir o Stripe.' . ($api !== '' ? ' ' . $api : '');
        }
        return null;
    }

    $sessionId = (string)($data['id'] ?? '');
    return (string)$data['url'];
}
