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
        `gateway_ref` VARCHAR(128) DEFAULT NULL,
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

function ravynDonateValidateBirthDate(string $s): bool
{
    if (!preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $s, $m)) {
        return false;
    }
    $d = (int)$m[1];
    $mo = (int)$m[2];
    $y = (int)$m[3];
    return checkdate($mo, $d, $y);
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

function ravynDonateCreateMercadoPagoCheckout(array $order): ?string
{
    global $config;
    require_once PLUGINS . 'mercadopago/config.php';
    ravynDonateSyncGatewayPackages();

    $environment = $config['mercadoPago']['environment'] ?? 'production';
    $accessToken = $config['mercadoPago']['accessToken'][$environment] ?? '';
    if ($accessToken === '') {
        return null;
    }

    $baseUrl = ravynPublicBaseUrl();
    $successUrl = $baseUrl . '?subtopic=donate&action=final&gateway=mercadopago&order=' . urlencode($order['order_ref']);
    $failureUrl = $baseUrl . '?subtopic=donate&order=' . urlencode($order['order_ref']);
    $notificationUrl = rtrim($baseUrl, '/') . '/payments/mercadopago.php';

    $payload = [
        'items' => [[
            'id' => $order['package_id'],
            'title' => $order['coins'] . ' RavynCore Coins',
            'quantity' => 1,
            'currency_id' => 'BRL',
            'unit_price' => (float)$order['amount_brl'],
        ]],
        'payer' => [
            'name' => $order['full_name'],
            'email' => $order['email'],
            'identification' => [
                'type' => $order['region'] === 'BR' ? 'CPF' : 'Otro',
                'number' => $order['tax_id'],
            ],
        ],
        'external_reference' => $order['order_ref'],
        'notification_url' => $notificationUrl,
        'back_urls' => [
            'success' => $successUrl,
            'pending' => $successUrl,
            'failure' => $failureUrl,
        ],
        'auto_return' => 'approved',
        'metadata' => [
            'order_ref' => $order['order_ref'],
            'code' => $order['package_id'],
            'account_id' => (string)$order['account_id'],
        ],
    ];

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
    curl_close($ch);

    $data = json_decode((string)$response, true);
    if ($httpCode < 200 || $httpCode >= 300 || empty($data['init_point'])) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' MP: ' . (string)$response);
        return null;
    }
    return $data['init_point'];
}

function ravynDonateCreateStripeCheckout(array $order): ?string
{
    global $config;
    require_once PLUGINS . 'stripe/config.php';

    $environment = $config['stripe']['environment'] ?? 'production';
    $secretKey = $config['stripe']['secretKey'][$environment] ?? '';
    if ($secretKey === '') {
        return null;
    }

    $baseUrl = ravynPublicBaseUrl();
    $successUrl = $baseUrl . '?subtopic=donate&action=final&gateway=stripe&order=' . urlencode($order['order_ref']);
    $cancelUrl = $baseUrl . '?subtopic=donate';

    $unitAmount = (int)round((float)$order['amount_brl'] * 100);
    $payload = [
        'mode' => 'payment',
        'success_url' => $successUrl,
        'cancel_url' => $cancelUrl,
        'client_reference_id' => $order['order_ref'],
        'customer_email' => $order['email'],
        'metadata' => [
            'order_ref' => $order['order_ref'],
            'code' => $order['package_id'],
            'account_id' => (string)$order['account_id'],
        ],
        'line_items' => [[
            'quantity' => 1,
            'price_data' => [
                'currency' => 'brl',
                'unit_amount' => $unitAmount,
                'product_data' => [
                    'name' => $order['coins'] . ' RavynCore Coins',
                ],
            ],
        ]],
    ];

    $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_USERPWD => $secretKey . ':',
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_TIMEOUT => 30,
    ]);
    $response = curl_exec($ch);
    $httpCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode((string)$response, true);
    if ($httpCode < 200 || $httpCode >= 300 || empty($data['url'])) {
        log_append('ravyn_donate_errors.log', date('Y-m-d H:i:s') . ' Stripe: ' . (string)$response);
        return null;
    }
    return $data['url'];
}
