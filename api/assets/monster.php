<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';
$query = ['id' => (string) ($_GET['id'] ?? '')];
if (isset($_GET['direction'])) {
    $query['direction'] = (int) $_GET['direction'];
}
ravyn_asset_engine_proxy('/api/monster', $query);
