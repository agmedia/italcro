-- Italcro / QIQO product packaging columns
-- Date: 2026-05-27
-- NOTE: This script uses the "oc_" prefix. If DB_PREFIX is different, replace "oc_" before running.

SET NAMES utf8mb4;
SET @italcro_old_sql_mode = @@SESSION.sql_mode;
SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION';

DROP PROCEDURE IF EXISTS italcro_add_column_if_missing;
DELIMITER $$
CREATE PROCEDURE italcro_add_column_if_missing(
  IN p_table_name VARCHAR(64),
  IN p_column_name VARCHAR(64),
  IN p_alter_sql TEXT
)
BEGIN
  IF NOT EXISTS (
    SELECT 1
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = p_table_name
      AND COLUMN_NAME = p_column_name
  ) THEN
    SET @italcro_ddl = p_alter_sql;
    PREPARE italcro_stmt FROM @italcro_ddl;
    EXECUTE italcro_stmt;
    DEALLOCATE PREPARE italcro_stmt;
  END IF;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS italcro_add_index_if_missing;
DELIMITER $$
CREATE PROCEDURE italcro_add_index_if_missing(
  IN p_table_name VARCHAR(64),
  IN p_index_name VARCHAR(64),
  IN p_alter_sql TEXT
)
BEGIN
  IF NOT EXISTS (
    SELECT 1
    FROM INFORMATION_SCHEMA.STATISTICS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = p_table_name
      AND INDEX_NAME = p_index_name
  ) THEN
    SET @italcro_ddl = p_alter_sql;
    PREPARE italcro_stmt FROM @italcro_ddl;
    EXECUTE italcro_stmt;
    DEALLOCATE PREPARE italcro_stmt;
  END IF;
END$$
DELIMITER ;

CALL italcro_add_column_if_missing(
  'oc_product',
  'jm',
  'ALTER TABLE `oc_product` ADD COLUMN `jm` VARCHAR(32) NOT NULL DEFAULT '''' AFTER `ean`'
);

CALL italcro_add_column_if_missing(
  'oc_product',
  'pakkol',
  'ALTER TABLE `oc_product` ADD COLUMN `pakkol` DECIMAL(15,4) NOT NULL DEFAULT 0 AFTER `jm`'
);

CALL italcro_add_column_if_missing(
  'oc_product',
  'pak',
  'ALTER TABLE `oc_product` ADD COLUMN `pak` TINYINT(1) NOT NULL DEFAULT 0 AFTER `pakkol`'
);

CALL italcro_add_column_if_missing(
  'oc_product',
  'vpc',
  'ALTER TABLE `oc_product` ADD COLUMN `vpc` DECIMAL(15,4) NOT NULL DEFAULT 0 AFTER `price`'
);

CALL italcro_add_index_if_missing(
  'oc_product',
  'idx_pak',
  'ALTER TABLE `oc_product` ADD INDEX `idx_pak` (`pak`)'
);

CALL italcro_add_index_if_missing(
  'oc_product',
  'idx_vpc',
  'ALTER TABLE `oc_product` ADD INDEX `idx_vpc` (`vpc`)'
);

UPDATE `oc_product`
SET `jm` = TRIM(`ean`)
WHERE (`jm` IS NULL OR `jm` = '')
  AND TRIM(`ean`) <> '';

UPDATE `oc_product`
SET `pakkol` = `minimum`
WHERE (`pakkol` IS NULL OR `pakkol` <= 0)
  AND `minimum` > 0;

UPDATE `oc_product`
SET `pak` = 1
WHERE (`pak` IS NULL OR `pak` = 0)
  AND `minimum` > 1
  AND UPPER(TRIM(COALESCE(NULLIF(`jm`, ''), `ean`))) <> 'MET';

UPDATE `oc_product`
SET `vpc` = `price`
WHERE (`vpc` IS NULL OR `vpc` <= 0)
  AND `price` > 0;

UPDATE `oc_product`
SET `minimum` = CEIL(`pakkol`)
WHERE `pak` = 1
  AND `pakkol` > 0
  AND `minimum` <> CEIL(`pakkol`);

DROP PROCEDURE IF EXISTS italcro_add_index_if_missing;
DROP PROCEDURE IF EXISTS italcro_add_column_if_missing;

SET SESSION sql_mode = @italcro_old_sql_mode;
