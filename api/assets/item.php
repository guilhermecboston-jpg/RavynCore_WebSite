<?php
declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';
ravyn_asset_engine_proxy('/api/item', ['id' => (int) ($_GET['id'] ?? 0)]);
