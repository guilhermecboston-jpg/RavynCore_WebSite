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

function checkout_pdo(): PDO
{
    $c = checkout_config()['db'];
    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $c['host'], $c['name']);
    return new PDO($dsn, $c['user'], $c['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

function checkout_ensure_tables(PDO $pdo): void
{
    $pdo->exec("CREATE TABLE IF NOT EXISTS `ravyn_checkout_orders` (
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
            return [
                ['id' => 'credit_card'],
                ['id' => 'debit_card'],
                ['id' => 'ticket'],
            ];
        case 'debit_card':
            return [
                ['id' => 'credit_card'],
                ['id' => 'pix'],
                ['id' => 'ticket'],
            ];
        case 'two_cards':
            return [
                ['id' => 'pix'],
                ['id' => 'debit_card'],
                ['id' => 'ticket'],
            ];
        case 'credit_card':
        default:
            return [
                ['id' => 'pix'],
            ];
    }
}

function checkout_credit_coins(PDO $pdo, int $orderId): void
{
    $stmt = $pdo->prepare('SELECT * FROM ravyn_checkout_orders WHERE id = ? AND status = ?');
    $stmt->execute([$orderId, 'pending']);
    $order = $stmt->fetch();
    if (!$order) {
        return;
    }

    $coins = (int) $order['coins'];
    $character = $order['character_name'] ?? '';

    // znote_accounts.points — ajuste conforme seu schema
    if (!empty($order['account_id'])) {
        $upd = $pdo->prepare('UPDATE znote_accounts SET points = points + ? WHERE id = ?');
        $upd->execute([$coins, (int) $order['account_id']]);
    }

    $pdo->prepare('UPDATE ravyn_checkout_orders SET status = ?, paid_at = NOW() WHERE id = ?')
        ->execute(['paid', $orderId]);
}
