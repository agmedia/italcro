-- Italcro / QIQO NarudzbaSend outbox
-- Date: 2026-08-28
-- Apply after 2026-08-28_qiqo_price_precision.sql and before deploying the
-- accompanying PHP code. The precision migration preserves C-100 line totals.
-- Credentials are intentionally NOT stored here; configure QIQO_ORDER_USERNAME
-- and QIQO_ORDER_PASSWORD outside the repository (upload/env.php or process env).

SET NAMES utf8mb4;

-- Dynamic no-op DDL keeps this repeatable without requiring CREATE ROUTINE.
SET @italcro_ddl = IF(
  EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'oc_order_product'
      AND COLUMN_NAME = 'sku'
  ),
  'SELECT 1',
  'ALTER TABLE `oc_order_product` ADD COLUMN `sku` VARCHAR(64) NOT NULL DEFAULT '''' AFTER `reward`'
);
PREPARE italcro_stmt FROM @italcro_ddl;
EXECUTE italcro_stmt;
DEALLOCATE PREPARE italcro_stmt;

SET @italcro_ddl = IF(
  EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'oc_order_product'
      AND COLUMN_NAME = 'qiqo_cent'
  ),
  'SELECT 1',
  'ALTER TABLE `oc_order_product` ADD COLUMN `qiqo_cent` VARCHAR(16) NOT NULL DEFAULT '''' AFTER `sku`'
);
PREPARE italcro_stmt FROM @italcro_ddl;
EXECUTE italcro_stmt;
DEALLOCATE PREPARE italcro_stmt;

ALTER TABLE `oc_order_product`
  MODIFY `quantity` DECIMAL(15,4) NOT NULL DEFAULT 0;

UPDATE `oc_order_product` op
INNER JOIN `oc_product` p ON (p.product_id = op.product_id)
SET op.sku = p.sku
WHERE TRIM(COALESCE(op.sku, '')) = ''
  AND TRIM(COALESCE(p.sku, '')) <> '';

UPDATE `oc_order_product` op
INNER JOIN `oc_product` p ON (p.product_id = op.product_id)
SET op.qiqo_cent = p.cent
WHERE TRIM(COALESCE(op.qiqo_cent, '')) = ''
  AND TRIM(COALESCE(p.cent, '')) <> '';

CREATE TABLE IF NOT EXISTS `oc_qiqo_order_outbox` (
  `outbox_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` INT NOT NULL,
  `order_status_id` INT NOT NULL DEFAULT 0,
  `partner_code` VARCHAR(64) NOT NULL DEFAULT '',
  `delivery_place_code` VARCHAR(64) NOT NULL DEFAULT '',
  `sales_rep_code` VARCHAR(64) NOT NULL DEFAULT '',
  `currency_code` VARCHAR(3) NOT NULL DEFAULT 'EUR',
  `payload_json` MEDIUMTEXT NOT NULL,
  `payload_hash` CHAR(64) NOT NULL,
  `status` VARCHAR(20) NOT NULL DEFAULT 'pending',
  `attempts` INT UNSIGNED NOT NULL DEFAULT 0,
  `locked_at` DATETIME NULL,
  `last_http_status` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `last_error_code` VARCHAR(64) NOT NULL DEFAULT '',
  `last_error_description` VARCHAR(1000) NOT NULL DEFAULT '',
  `last_response` TEXT NULL,
  `sent_at` DATETIME NULL,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`outbox_id`),
  UNIQUE KEY `uq_order_id` (`order_id`),
  KEY `idx_status_modified` (`status`, `date_modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Safe defaults: create payload snapshots, but never call the private ERP endpoint
-- until the endpoint and credentials have been tested and sending is explicitly enabled.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_send_enabled', '0', 0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE `store_id` = 0 AND `key` = 'qiqo_order_send_enabled');

INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_allow_insecure_http', '0', 0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE `store_id` = 0 AND `key` = 'qiqo_order_allow_insecure_http');

INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_endpoint', 'http://192.168.16.102:9988/WebQReaderNew.asmx/NarudzbaSend', 0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE `store_id` = 0 AND `key` = 'qiqo_order_endpoint');

INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_accepted_status_ids', '1', 0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE `store_id` = 0 AND `key` = 'qiqo_order_accepted_status_ids');

INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_price_mode', 'erp_display', 0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE `store_id` = 0 AND `key` = 'qiqo_order_price_mode');

-- Reconciliation must never enqueue historical production orders. This
-- immutable rollout boundary limits repair to orders created after deployment.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_outbox_start_at', DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), 0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE `store_id` = 0 AND `key` = 'qiqo_order_outbox_start_at');
