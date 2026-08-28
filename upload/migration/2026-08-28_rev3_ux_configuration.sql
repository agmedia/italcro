-- Italcro Revizija 3.0 - approved UX/configuration changes
-- Date: 2026-08-28
-- NOTE: This script uses the "oc_" prefix. If DB_PREFIX is different, replace "oc_" before running.
-- Idempotent: it can safely be executed more than once.

SET NAMES utf8mb4;

-- Temporarily remove the blocking minimum order amount.
-- Product minimum quantities, stock validation and XShippingPro rates are intentionally unchanged.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'quickcheckout', 'quickcheckout_minimum_order', '0', 0
WHERE NOT EXISTS (
  SELECT 1
  FROM `oc_setting`
  WHERE `store_id` = 0
    AND `code` = 'quickcheckout'
    AND `key` = 'quickcheckout_minimum_order'
);

UPDATE `oc_setting`
SET `value` = '0',
    `serialized` = 0
WHERE `store_id` = 0
  AND `code` = 'quickcheckout'
  AND `key` = 'quickcheckout_minimum_order';

-- Basel menu module 49 uses status=0 for visible/enabled items.
-- Do not alter any other menu item or its order.
UPDATE `oc_mega_menu`
SET `status` = 0
WHERE `module_id` = 49
  AND `id` = 36; -- Blog; existing target is /blog

UPDATE `oc_mega_menu`
SET `status` = 0
WHERE `module_id` = 49
  AND `id` = 3; -- Letak; keep the existing link untouched

-- TODO(content): assign the approved Letak URL/PDF in Basel Mega Menu.
-- Until then, the theme renders this linkless leaf as visible but disabled (no fabricated target).
-- The menu cache namespace is versioned in basel_megamenu.php, so this deployment does not
-- depend on deleting generated files from storage/modification.
