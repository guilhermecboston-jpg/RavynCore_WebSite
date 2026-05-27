<?php

function checkout_config(): array
{
    static $cfg;
    if ($cfg === null) {
        $cfg = require __DIR__ . '/config.php';
    }
    return $cfg;
}

function checkout_json_response(array $data, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function checkout_read_json(): ?array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || $raw === '') {
        return null;
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : null;
}

function checkout_myaac_db()
{
    static $cached;
    if ($cached !== null) {
        return $cached;
    }
    $siteRoot = dirname(__DIR__, 2);
    if (!is_file($siteRoot . '/common.php')) {
        return null;
    }
    require_once $siteRoot . '/common.php';
    require_once SYSTEM . 'init.php';
    global $db;
    $cached = $db ?? null;
    return $cached;
}

function checkout_db_or_fail()
{
    $db = checkout_myaac_db();
    if (!$db) {
        checkout_json_response(['error' => 'Banco MyAAC indisponível'], 500);
    }
    checkout_ensure_tables($db);
    return $db;
}

function checkout_ensure_tables($db): void
{
    $db->exec("CREATE TABLE IF NOT EXISTS `ravyn_checkout_orders` (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `external_id` VARCHAR(64) NOT NULL,
        `package_id` VARCHAR(32) NOT NULL,
        `coins` INT UNSIGNED NOT NULL,
        `amount_usd` DECIMAL(12,2) NOT NULL,
        `gateway` VARCHAR(16) NOT NULL,
        `payment_method` VARCHAR(32) NOT NULL,
        `region` VARCHAR(8) NOT NULL,
        `full_name` VARCHAR(128) NOT NULL,
        `birth_date` VARCHAR(16) NOT NULL,
        `tax_id` VARCHAR(32) DEFAULT NULL,
        `email` VARCHAR(128) NOT NULL,
        `character_name` VARCHAR(64) DEFAULT NULL,
        `account_id` INT UNSIGNED DEFAULT 0,
        `status` ENUM('pending','paid','failed','cancelled') NOT NULL DEFAULT 'pending',
        `gateway_ref` VARCHAR(128) DEFAULT NULL,
        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `paid_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `external_id` (`external_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
}

function checkout_validate_cpf(string $cpf): bool
{
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        $sum = 0;
        for ($i = 0; $i < $t; $i++) {
            $sum += (int) $cpf[$i] * (($t + 1) - $i);
        }
        $d = ((10 * $sum) % 11) % 10;
        if ((int) $cpf[$t] !== $d) {
            return false;
        }
    }
    return true;
}

function checkout_mp_excluded_types(string $method): array
{
    switch ($method) {
        case 'pix':
            return [['id' => 'credit_card'], ['id' => 'debit_card'], ['id' => 'ticket']];
        case 'debit_card':
            return [['id' => 'credit_card'], ['id' => 'pix'], ['id' => 'ticket']];
        case 'two_cards':
            return [['id' => 'pix'], ['id' => 'debit_card'], ['id' => 'ticket']];
        default:
            return [['id' => 'pix']];
    }
}

function checkout_resolve_account_id($db, array $order): int
{
    $accountId = (int) ($order['account_id'] ?? 0);
    if ($accountId > 0) {
        return $accountId;
    }
    $character = trim($order['character_name'] ?? '');
    if ($character === '' || !$db->hasTable('players')) {
        return 0;
    }
    $row = $db->query(
        'SELECT `account_id` FROM `players` WHERE `name` = ' . $db->quote($character) . ' LIMIT 1'
    )->fetch();
    return (int) ($row['account_id'] ?? 0);
}

function checkout_credit_coins($db, int $orderId): void
{
    $order = $db->query(
        'SELECT * FROM `ravyn_checkout_orders` WHERE `id` = ' . (int) $orderId . " AND `status` = 'pending'"
    )->fetch();
    if (!$order) {
        return;
    }

    $accountId = checkout_resolve_account_id($db, $order);
    if ($accountId <= 0) {
        log_append('ravyn_checkout.log', date('Y-m-d H:i:s') . " order {$orderId}: account not found for character " . ($order['character_name'] ?? ''));
        return;
    }

    $cfg = checkout_config();
    $field = preg_replace('/[^a-z_]/', '', $cfg['donation_field'] ?? 'coins_transferable');
    if ($field === '' || !$db->hasColumn('accounts', $field)) {
        $field = 'coins_transferable';
    }

    $coins = (int) $order['coins'];
    $db->exec("UPDATE `accounts` SET `{$field}` = `{$field}` + {$coins} WHERE `id` = {$accountId}");

    if (function_exists('ravynGrantDonationLoyaltyPoints')) {
        ravynGrantDonationLoyaltyPoints($accountId, (float) $order['amount_usd']);
    }

    $desc = $db->quote('Donate - OTC Checkout (' . $order['gateway'] . ')');
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

    $db->exec("UPDATE `ravyn_checkout_orders` SET `status` = 'paid', `paid_at` = NOW(), `account_id` = {$accountId} WHERE `id` = " . (int) $orderId);
    log_append('ravyn_checkout.log', date('Y-m-d H:i:s') . " PAID order={$orderId} account={$accountId} coins={$coins}");
}
