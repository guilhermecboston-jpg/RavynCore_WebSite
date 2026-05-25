<?php
/**
 * Diagnóstico HTTP 500 — apague após corrigir.
 * https://ravyncore.com/check.php
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: text/plain; charset=utf-8');

echo 'PHP ' . PHP_VERSION . "\n\n";

try {
  require __DIR__ . '/common.php';
  echo "OK common.php\n";

  require SYSTEM . 'functions.php';
  echo "OK functions.php\n";

  require SYSTEM . 'init.php';
  echo "OK init.php — server: " . ($config['lua']['serverName'] ?? '?') . "\n";

  echo "DB tables sample: ";
  echo $db->hasTable('myaac_account_actions') ? 'myaac OK' : 'myaac MISSING';
  echo "\n";

  echo "\nSite bootstrap OK. If index still fails, error is in template/page/hooks.\n";
} catch (Throwable $e) {
  echo "\nFAILED:\n";
  echo $e->getMessage() . "\n";
  echo $e->getFile() . ':' . $e->getLine() . "\n\n";
  echo $e->getTraceAsString();
}
