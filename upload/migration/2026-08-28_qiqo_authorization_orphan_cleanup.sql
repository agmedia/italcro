-- QIQO / Italcro - recoverable cleanup of orphan authorization data
-- Date: 2026-08-28
-- NOTE: This script uses the "oc_" prefix. Replace it if DB_PREFIX is different.
-- Run manually after reviewing the SELECT statements. It is not called by runtime code.
-- Every deleted row is copied to an archive table first, so cleanup is recoverable.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_authorization_orphan_archive` (
  `customer_id` INT(11) NOT NULL,
  `partner_id` INT(11) NOT NULL,
  `delivery_place_id` INT(11) NOT NULL,
  `sales_rep_id` INT(11) NULL,
  `partner_discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `approved_by_user_id` INT(11) NOT NULL,
  `approved_at` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  `archived_at` DATETIME NOT NULL,
  `archive_reason` VARCHAR(191) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_delivery_place_orphan_archive` (
  `delivery_place_id` INT(11) NOT NULL,
  `partner_id` INT(11) NOT NULL,
  `code` VARCHAR(64) NOT NULL DEFAULT '',
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `address` VARCHAR(255) NOT NULL DEFAULT '',
  `place` VARCHAR(255) NOT NULL DEFAULT '',
  `api_modified_at` VARCHAR(64) NULL,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  `archived_at` DATETIME NOT NULL,
  `archive_reason` VARCHAR(191) NOT NULL,
  PRIMARY KEY (`delivery_place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

START TRANSACTION;

-- Review authorization rows with a missing, inactive or mismatched customer/partner/location.
-- These rows cannot identify a usable QIQO account and are archived before removal.
-- A missing/inactive sales representative is deliberately NOT a cleanup condition:
-- the authorization remains available for manual mapping, while new writes/orders must
-- require an active representative.
SELECT cqa.*,
  qp.partner_id AS existing_partner_id,
  qdp.partner_id AS delivery_partner_id
FROM `oc_customer_qiqo_authorization` cqa
LEFT JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_delivery_place` qdp ON (qdp.delivery_place_id = cqa.delivery_place_id)
WHERE c.customer_id IS NULL
   OR qp.partner_id IS NULL
   OR qp.active <> 1
   OR qdp.delivery_place_id IS NULL
   OR qdp.partner_id <> cqa.partner_id;

-- Explicit rollout report: these otherwise valid authorizations need an administrator
-- to select an active qKomercijalistWeb entry. They are reported, never auto-deleted.
SELECT COUNT(*) AS `authorizations_requiring_sales_rep_mapping`
FROM `oc_customer_qiqo_authorization` cqa
INNER JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
INNER JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id AND qp.active = 1)
INNER JOIN `oc_qiqo_delivery_place` qdp
  ON (qdp.delivery_place_id = cqa.delivery_place_id AND qdp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_sales_rep` qsr ON (qsr.sales_rep_id = cqa.sales_rep_id)
WHERE cqa.sales_rep_id IS NULL
   OR qsr.sales_rep_id IS NULL
   OR qsr.active <> 1;

SELECT cqa.customer_id, cqa.partner_id, cqa.delivery_place_id, cqa.sales_rep_id,
  CASE
    WHEN cqa.sales_rep_id IS NULL THEN 'missing_required_sales_rep'
    WHEN qsr.sales_rep_id IS NULL THEN 'missing_sales_rep'
    ELSE 'inactive_sales_rep'
  END AS `sales_rep_mapping_issue`
FROM `oc_customer_qiqo_authorization` cqa
INNER JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
INNER JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id AND qp.active = 1)
INNER JOIN `oc_qiqo_delivery_place` qdp
  ON (qdp.delivery_place_id = cqa.delivery_place_id AND qdp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_sales_rep` qsr ON (qsr.sales_rep_id = cqa.sales_rep_id)
WHERE cqa.sales_rep_id IS NULL
   OR qsr.sales_rep_id IS NULL
   OR qsr.active <> 1
ORDER BY cqa.customer_id;

-- Archive first. ON DUPLICATE KEY UPDATE makes reruns safe and refreshes the backup.
INSERT INTO `oc_qiqo_authorization_orphan_archive` (
  `customer_id`, `partner_id`, `delivery_place_id`, `sales_rep_id`,
  `partner_discount`, `approved_by_user_id`, `approved_at`, `date_modified`,
  `archived_at`, `archive_reason`
)
SELECT
  cqa.customer_id, cqa.partner_id, cqa.delivery_place_id, cqa.sales_rep_id,
  cqa.partner_discount, cqa.approved_by_user_id, cqa.approved_at, cqa.date_modified,
  NOW(),
  CASE
    WHEN c.customer_id IS NULL THEN 'missing_customer'
    WHEN qp.partner_id IS NULL THEN 'missing_partner'
    WHEN qp.active <> 1 THEN 'inactive_partner'
    WHEN qdp.delivery_place_id IS NULL THEN 'missing_delivery_place'
    WHEN qdp.partner_id <> cqa.partner_id THEN 'delivery_partner_mismatch'
    ELSE 'unknown_orphan_reference'
  END
FROM `oc_customer_qiqo_authorization` cqa
LEFT JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_delivery_place` qdp ON (qdp.delivery_place_id = cqa.delivery_place_id)
WHERE c.customer_id IS NULL
   OR qp.partner_id IS NULL
   OR qp.active <> 1
   OR qdp.delivery_place_id IS NULL
   OR qdp.partner_id <> cqa.partner_id
ON DUPLICATE KEY UPDATE
  `partner_id` = VALUES(`partner_id`),
  `delivery_place_id` = VALUES(`delivery_place_id`),
  `sales_rep_id` = VALUES(`sales_rep_id`),
  `partner_discount` = VALUES(`partner_discount`),
  `approved_by_user_id` = VALUES(`approved_by_user_id`),
  `approved_at` = VALUES(`approved_at`),
  `date_modified` = VALUES(`date_modified`),
  `archived_at` = VALUES(`archived_at`),
  `archive_reason` = VALUES(`archive_reason`);

DELETE cqa
FROM `oc_customer_qiqo_authorization` cqa
LEFT JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_delivery_place` qdp ON (qdp.delivery_place_id = cqa.delivery_place_id)
WHERE c.customer_id IS NULL
   OR qp.partner_id IS NULL
   OR qp.active <> 1
   OR qdp.delivery_place_id IS NULL
   OR qdp.partner_id <> cqa.partner_id;

-- Review delivery places whose cached partner no longer exists.
-- Referenced rows are archived and reported, but are not deleted automatically.
SELECT qdp.*,
  EXISTS (
    SELECT 1
    FROM `oc_customer_qiqo_authorization` cqa
    WHERE cqa.delivery_place_id = qdp.delivery_place_id
  ) AS referenced_by_authorization
FROM `oc_qiqo_delivery_place` qdp
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = qdp.partner_id)
WHERE qp.partner_id IS NULL;

INSERT INTO `oc_qiqo_delivery_place_orphan_archive` (
  `delivery_place_id`, `partner_id`, `code`, `name`, `address`, `place`,
  `api_modified_at`, `date_added`, `date_modified`, `archived_at`, `archive_reason`
)
SELECT
  qdp.delivery_place_id, qdp.partner_id, qdp.code, qdp.name, qdp.address, qdp.place,
  qdp.api_modified_at, qdp.date_added, qdp.date_modified, NOW(),
  CASE
    WHEN EXISTS (
      SELECT 1
      FROM `oc_customer_qiqo_authorization` cqa
      WHERE cqa.delivery_place_id = qdp.delivery_place_id
    ) THEN 'missing_partner_referenced_by_authorization'
    ELSE 'missing_partner'
  END
FROM `oc_qiqo_delivery_place` qdp
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = qdp.partner_id)
WHERE qp.partner_id IS NULL
ON DUPLICATE KEY UPDATE
  `partner_id` = VALUES(`partner_id`),
  `code` = VALUES(`code`),
  `name` = VALUES(`name`),
  `address` = VALUES(`address`),
  `place` = VALUES(`place`),
  `api_modified_at` = VALUES(`api_modified_at`),
  `date_added` = VALUES(`date_added`),
  `date_modified` = VALUES(`date_modified`),
  `archived_at` = VALUES(`archived_at`),
  `archive_reason` = VALUES(`archive_reason`);

DELETE qdp
FROM `oc_qiqo_delivery_place` qdp
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = qdp.partner_id)
LEFT JOIN `oc_customer_qiqo_authorization` cqa ON (cqa.delivery_place_id = qdp.delivery_place_id)
WHERE qp.partner_id IS NULL
  AND cqa.customer_id IS NULL;

COMMIT;

-- Post-cleanup verification. The first set should be empty. A delivery place
-- intentionally retained because it is still referenced can remain in the second set.
SELECT cqa.*
FROM `oc_customer_qiqo_authorization` cqa
LEFT JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_delivery_place` qdp ON (qdp.delivery_place_id = cqa.delivery_place_id)
WHERE c.customer_id IS NULL
   OR qp.partner_id IS NULL
   OR qp.active <> 1
   OR qdp.delivery_place_id IS NULL
   OR qdp.partner_id <> cqa.partner_id;

SELECT qdp.*, cqa.customer_id AS referenced_by_customer_id
FROM `oc_qiqo_delivery_place` qdp
LEFT JOIN `oc_qiqo_partner` qp ON (qp.partner_id = qdp.partner_id)
LEFT JOIN `oc_customer_qiqo_authorization` cqa ON (cqa.delivery_place_id = qdp.delivery_place_id)
WHERE qp.partner_id IS NULL;

-- Final mapping report. This may be non-empty after cleanup by design: those
-- authorizations remain usable for admin remediation, but must not produce an order.
SELECT cqa.*,
  qsr.active AS sales_rep_active
FROM `oc_customer_qiqo_authorization` cqa
INNER JOIN `oc_customer` c ON (c.customer_id = cqa.customer_id)
INNER JOIN `oc_qiqo_partner` qp ON (qp.partner_id = cqa.partner_id AND qp.active = 1)
INNER JOIN `oc_qiqo_delivery_place` qdp
  ON (qdp.delivery_place_id = cqa.delivery_place_id AND qdp.partner_id = cqa.partner_id)
LEFT JOIN `oc_qiqo_sales_rep` qsr ON (qsr.sales_rep_id = cqa.sales_rep_id)
WHERE cqa.sales_rep_id IS NULL
   OR qsr.sales_rep_id IS NULL
   OR qsr.active <> 1;

-- Manual recovery examples (review collisions before executing):
-- INSERT INTO `oc_customer_qiqo_authorization`
--   (`customer_id`, `partner_id`, `delivery_place_id`, `sales_rep_id`, `partner_discount`,
--    `approved_by_user_id`, `approved_at`, `date_modified`)
-- SELECT `customer_id`, `partner_id`, `delivery_place_id`, `sales_rep_id`, `partner_discount`,
--        `approved_by_user_id`, `approved_at`, `date_modified`
-- FROM `oc_qiqo_authorization_orphan_archive`;
--
-- INSERT INTO `oc_qiqo_delivery_place`
--   (`delivery_place_id`, `partner_id`, `code`, `name`, `address`, `place`,
--    `api_modified_at`, `date_added`, `date_modified`)
-- SELECT `delivery_place_id`, `partner_id`, `code`, `name`, `address`, `place`,
--        `api_modified_at`, `date_added`, `date_modified`
-- FROM `oc_qiqo_delivery_place_orphan_archive`;
