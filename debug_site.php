<?php
/**
 * Diagnóstico HTTP 500 — apague após corrigir (segurança).
 * Acesse: https://ravyncore.com/debug_site.php
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: text/plain; charset=utf-8');

echo "PHP " . PHP_VERSION . "\n\n";

$steps = [
  'syntax functions.php' => function () {
    $out = [];
    exec('php -l ' . escapeshellarg(__DIR__ . '/system/functions.php') . ' 2>&1', $out);
    return implode("\n", $out);
  },
  'syntax config.php' => function () {
    $out = [];
    exec('php -l ' . escapeshellarg(__DIR__ . '/config.php') . ' 2>&1', $out);
    return implode("\n", $out);
  },
  'common.php' => function () {
    require __DIR__ . '/common.php';
    return 'MYAAC=' . (defined('MYAAC') ? 'yes' : 'no');
  },
  'functions.php' => function () {
    require __DIR__ . '/system/functions.php';
    return 'loaded, getRavynLoyaltyDisplayTiers=' . (function_exists('getRavynLoyaltyDisplayTiers') ? 'yes' : 'no');
  },
  'config.local.php' => function () {
    global $config;
    $p = __DIR__ . '/config.local.php';
    if (!file_exists($p)) {
      return 'MISSING config.local.php (fatal on production)';
    }
    require $p;
    return 'installed=' . var_export($config['installed'] ?? null, true)
      . "\nserver_path=" . ($config['server_path'] ?? '(empty)');
  },
  'init.php' => function () {
    global $config;
    require __DIR__ . '/system/init.php';
    return 'init OK, serverName=' . ($config['lua']['serverName'] ?? '?');
  },
];

foreach ($steps as $name => $fn) {
  echo "=== $name ===\n";
  try {
    echo $fn() . "\n\n";
  } catch (Throwable $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
    echo 'File: ' . $e->getFile() . ':' . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n\n";
    break;
  }
}

echo "Done.\n";
