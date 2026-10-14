-- ERP introduction date for the three-calendar-month Novo listing and badges.
-- Do not backfill from date_added/date_available: reimported products are not new.
-- The ERP owner still needs to confirm the source API field before date import.
-- Replace oc_ if the installation uses another prefix. Safe to run repeatedly.
SET @italcro_old_sql_mode = @@SESSION.sql_mode;
SET SESSION sql_mode = 'NO_ENGINE_SUBSTITUTION';
SET @italcro_ddl = IF(
  EXISTS (
    SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'oc_product' AND COLUMN_NAME = 'qiqo_introduced_at'
  ),
  'SELECT 1',
  'ALTER TABLE `oc_product` ADD COLUMN `qiqo_introduced_at` DATE NULL DEFAULT NULL AFTER `date_available`, ADD INDEX `idx_qiqo_introduced_at` (`qiqo_introduced_at`, `status`)'
);
PREPARE italcro_stmt FROM @italcro_ddl;
EXECUTE italcro_stmt;
DEALLOCATE PREPARE italcro_stmt;

-- Use the established catalog listing layout instead of the default home layout.
INSERT INTO `oc_layout_route` (`layout_id`, `store_id`, `route`)
SELECT source.`layout_id`, source.`store_id`, 'product/new_product'
FROM `oc_layout_route` source
WHERE source.`route` = 'product/special'
  AND NOT EXISTS (
    SELECT 1 FROM `oc_layout_route` existing
    WHERE existing.`store_id` = source.`store_id` AND existing.`route` = 'product/new_product'
  );
SET SESSION sql_mode = @italcro_old_sql_mode;
