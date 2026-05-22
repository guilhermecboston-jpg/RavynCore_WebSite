<?php
if ($db->hasTable('pagseguro_transactions') && !$db->hasColumn('pagseguro_transactions', 'amount_brl')) {
  $db->exec("ALTER TABLE `pagseguro_transactions` ADD `amount_brl` DECIMAL(12,2) NOT NULL DEFAULT 0.00 AFTER `code`;");
  $db->exec("CREATE INDEX `amount_brl` ON `pagseguro_transactions` (`amount_brl`);");
}

if ($db->hasTable('mercadopago_transactions') && !$db->hasColumn('mercadopago_transactions', 'amount_brl')) {
  $db->exec("ALTER TABLE `mercadopago_transactions` ADD `amount_brl` DECIMAL(12,2) NOT NULL DEFAULT 0.00 AFTER `code`;");
  $db->exec("CREATE INDEX `amount_brl` ON `mercadopago_transactions` (`amount_brl`);");
}
