CREATE TABLE `mercadopago_transactions` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `payment_id` VARCHAR(50) NOT NULL,
  `external_reference` VARCHAR(50) NOT NULL,
  `account_id` int(11) UNSIGNED NOT NULL,
  `payment_method` VARCHAR(50) DEFAULT NULL,
  `payment_status` VARCHAR(50) NOT NULL,
  `code` VARCHAR(10) NOT NULL,
  `amount_brl` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `coins_amount` INT(11) NOT NULL,
  `bought` INT(11) DEFAULT NULL,
  `delivered` CHAR(1) NOT NULL DEFAULT '0',
  `in_double` CHAR(1) NOT NULL DEFAULT '0',
  `request` LONGTEXT DEFAULT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  UNIQUE KEY `payment_id` (`payment_id`),
  INDEX `account_id` (`account_id`),
  INDEX `payment_status` (`payment_status`),
  INDEX `amount_brl` (`amount_brl`),
  INDEX `delivered` (`delivered`),
  CONSTRAINT `mercadopago_transactions_account_fk`
    FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
