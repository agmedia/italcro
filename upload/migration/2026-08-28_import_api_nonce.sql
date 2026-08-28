-- Italcro Import API signed-request nonce storage
-- Date: 2026-08-28
-- Apply before deploying the signed Import API controller. Runtime code never
-- creates or repairs this table and returns HTTP 503 until this migration exists.
-- NOTE: This script uses the "oc_" prefix. Replace it if DB_PREFIX is different.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_import_api_request_nonce` (
  `nonce_hash` CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `date_added` DATETIME NOT NULL,
  PRIMARY KEY (`nonce_hash`),
  KEY `idx_expires_at` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `oc_import_api_request_nonce`
  ENGINE=InnoDB,
  CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  MODIFY `expires_at` DATETIME NOT NULL,
  MODIFY `date_added` DATETIME NOT NULL;

ALTER TABLE `oc_import_api_request_nonce`
  MODIFY `nonce_hash` CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL;

-- Dynamic no-op SQL keeps index creation repeatable without CREATE ROUTINE.
SET @italcro_import_api_ddl = IF(
  EXISTS (
    SELECT 1
    FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'oc_import_api_request_nonce'
      AND INDEX_NAME = 'PRIMARY'
  ),
  'SELECT 1',
  'ALTER TABLE `oc_import_api_request_nonce` ADD PRIMARY KEY (`nonce_hash`)'
);
PREPARE italcro_import_api_stmt FROM @italcro_import_api_ddl;
EXECUTE italcro_import_api_stmt;
DEALLOCATE PREPARE italcro_import_api_stmt;

SET @italcro_import_api_ddl = IF(
  EXISTS (
    SELECT 1
    FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = 'oc_import_api_request_nonce'
      AND INDEX_NAME = 'idx_expires_at'
  ),
  'SELECT 1',
  'ALTER TABLE `oc_import_api_request_nonce` ADD KEY `idx_expires_at` (`expires_at`)'
);
PREPARE italcro_import_api_stmt FROM @italcro_import_api_ddl;
EXECUTE italcro_import_api_stmt;
DEALLOCATE PREPARE italcro_import_api_stmt;

SET @italcro_import_api_ddl = NULL;
