-- Italcro Revizija 3.1 - confirmed QIQO API contract
-- Date: 2026-10-06
-- Idempotent. NarudzbaSend remains disabled until the controlled ERP test.

SET NAMES utf8mb4;

-- Fail closed before any DDL (which may implicitly commit). Stop any external
-- worker before applying this migration and verify no outbox row is processing.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_send_enabled', '0', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `key` = 'qiqo_order_send_enabled'
);

UPDATE `oc_setting`
SET `value` = '0', `serialized` = 0
WHERE `store_id` = 0 AND `key` = 'qiqo_order_send_enabled';

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
  -- Default 1 is intentional: legacy/custom writers that omit the version
  -- are quarantined instead of being mistaken for a confirmed v2 payload.
  `payload_contract_version` SMALLINT UNSIGNED NOT NULL DEFAULT 1,
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

-- Version existing immutable payload snapshots. Version 1 used OpenCart's
-- gross order total and therefore must never be sent under the confirmed
-- net-items-plus-delivery contract.
SET @italcro_ddl = IF(
  EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'oc_qiqo_order_outbox'
      AND COLUMN_NAME = 'payload_contract_version'
  ),
  'SELECT 1',
  'ALTER TABLE `oc_qiqo_order_outbox` ADD COLUMN `payload_contract_version` SMALLINT UNSIGNED NOT NULL DEFAULT 1 AFTER `payload_hash`'
);
PREPARE italcro_stmt FROM @italcro_ddl;
EXECUTE italcro_stmt;
DEALLOCATE PREPARE italcro_stmt;

UPDATE `oc_qiqo_order_outbox`
SET `status` = 'blocked',
    `locked_at` = NULL,
    `last_error_code` = 'PAYLOAD_CONTRACT_UPGRADE',
    `last_error_description` = 'Payload je izrađen prema starom ugovoru; prije slanja obavezno kliknuti Obnovi payload.',
    `date_modified` = NOW()
WHERE `payload_contract_version` < 2
  AND `status` IN ('pending', 'blocked', 'failed', 'verified_not_sent', 'rebuilding');

-- Store pickup must be sent to QIQO as location 0001.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_pickup_location_code', '0001', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `key` = 'qiqo_order_pickup_location_code'
);

UPDATE `oc_setting`
SET `value` = '0001', `serialized` = 0
WHERE `store_id` = 0 AND `key` = 'qiqo_order_pickup_location_code';

-- Only explicitly approved delivery methods may export the customer's
-- authorised delivery location. Add a future dedicated Italcro shipping code
-- here only together with its tested rollout migration.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo_order', 'qiqo_order_delivery_shipping_codes', 'xshippingpro.xshippingpro1', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `key` = 'qiqo_order_delivery_shipping_codes'
);

-- qPartnerArtikalRabatWeb is an incremental feed. This date is used only
-- when no successful watermark exists yet; empty successful responses advance
-- the watermark and never clear the live discount cache.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo', 'qiqo_partner_article_initial_since', '2026-08-01 00:00:00', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `key` = 'qiqo_partner_article_initial_since'
);

UPDATE `oc_setting`
SET `value` = '2026-08-01 00:00:00', `serialized` = 0
WHERE `store_id` = 0 AND `key` = 'qiqo_partner_article_initial_since';

-- A historic watermark does not prove that the expected ~2 million-row
-- initial cache exists. Only the controlled importer may change this to 1
-- after row-count and integrity verification. Re-running this migration must
-- never reset a completed import.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo', 'qiqo_partner_article_initial_complete', '0', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `key` = 'qiqo_partner_article_initial_complete'
);
