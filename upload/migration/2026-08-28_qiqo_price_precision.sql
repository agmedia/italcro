-- QIQO price precision contract:
-- calculate/display-basis prices to 5 decimals; normalized C-100 unit prices
-- need 7 decimals so multiplying back by 100 does not lose information.
-- Idempotent: MODIFY to the same definition can be safely repeated.

SET NAMES utf8mb4;
SET @italcro_old_sql_mode = @@SESSION.sql_mode;
SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION';

-- Core OpenCart columns are part of every supported installation. Repeating a
-- MODIFY with the same definition is idempotent and needs only ALTER privilege.
ALTER TABLE `oc_cart`
  MODIFY `quantity` DECIMAL(15,4) NOT NULL DEFAULT 0;
ALTER TABLE `oc_product`
  MODIFY `price` DECIMAL(15,7) NOT NULL DEFAULT 0;
ALTER TABLE `oc_order_product`
  MODIFY `price` DECIMAL(15,7) NOT NULL DEFAULT 0,
  MODIFY `total` DECIMAL(15,7) NOT NULL DEFAULT 0,
  MODIFY `tax` DECIMAL(15,7) NOT NULL DEFAULT 0;
ALTER TABLE `oc_order`
  MODIFY `total` DECIMAL(15,7) NOT NULL DEFAULT 0;
ALTER TABLE `oc_order_total`
  MODIFY `value` DECIMAL(15,7) NOT NULL DEFAULT 0;
ALTER TABLE `oc_product_discount`
  MODIFY `price` DECIMAL(15,7) NOT NULL DEFAULT 0;
ALTER TABLE `oc_product_special`
  MODIFY `price` DECIMAL(15,7) NOT NULL DEFAULT 0;

-- QIQO/package columns are optional during phased upgrades. Dynamic no-op SQL
-- keeps the migration repeatable without CREATE ROUTINE privileges.
SET @italcro_ddl = IF(
  EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'oc_product' AND COLUMN_NAME = 'vpc'
  ),
  'ALTER TABLE `oc_product` MODIFY `vpc` DECIMAL(15,7) NOT NULL DEFAULT 0',
  'SELECT 1'
);
PREPARE italcro_stmt FROM @italcro_ddl;
EXECUTE italcro_stmt;
DEALLOCATE PREPARE italcro_stmt;

SET @italcro_ddl = IF(
  EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'oc_qiqo_action_price' AND COLUMN_NAME = 'price'
  ),
  'ALTER TABLE `oc_qiqo_action_price` MODIFY `price` DECIMAL(15,7) NOT NULL DEFAULT 0',
  'SELECT 1'
);
PREPARE italcro_stmt FROM @italcro_ddl;
EXECUTE italcro_stmt;
DEALLOCATE PREPARE italcro_stmt;

SET SESSION sql_mode = @italcro_old_sql_mode;
