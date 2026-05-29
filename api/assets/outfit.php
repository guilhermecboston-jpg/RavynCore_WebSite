<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';

$query = ['id' => (int) ($_GET['id'] ?? 0)];
foreach (['addons', 'direction', 'head', 'body', 'legs', 'feet'] as $k) {
    if (isset($_GET[$k])) {
        $query[$k] = (int) $_GET[$k];
    }
}
ravyn_asset_engine_proxy('/api/outfit', $query);
