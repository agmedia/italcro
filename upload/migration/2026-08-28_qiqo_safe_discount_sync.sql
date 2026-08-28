-- Staging table used by qPartnerArtikalRabatWeb full synchronization.
-- The application validates and fills this table before an atomic RENAME swap.
CREATE TABLE IF NOT EXISTS `oc_qiqo_partner_article_discount` (
  `partner_id` INT(11) NOT NULL,
  `article_code` VARCHAR(64) NOT NULL,
  `discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`partner_id`, `article_code`),
  KEY `idx_article` (`article_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_partner_article_discount_stage`
LIKE `oc_qiqo_partner_article_discount`;

CREATE TABLE IF NOT EXISTS `oc_qiqo_action_price` (
  `article_code` VARCHAR(64) NOT NULL,
  `indicator` CHAR(1) NOT NULL,
  `quantity` DECIMAL(15,4) NOT NULL DEFAULT 0,
  `price` DECIMAL(15,7) NOT NULL DEFAULT 0,
  `discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`article_code`, `indicator`, `quantity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_action_price_stage`
LIKE `oc_qiqo_action_price`;

-- Destructive FULL swaps and disable-missing remain fail-closed until the ERP
-- owner confirms that the configured call is a complete snapshot, not a delta.
INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo', 'qiqo_full_snapshot_confirmed', '0', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `code` = 'qiqo' AND `key` = 'qiqo_full_snapshot_confirmed'
);

INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo', 'qiqo_full_snapshot_since', '', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `code` = 'qiqo' AND `key` = 'qiqo_full_snapshot_since'
);

INSERT INTO `oc_setting` (`store_id`, `code`, `key`, `value`, `serialized`)
SELECT 0, 'qiqo', 'qiqo_full_snapshot_min_ratio', '0.8', 0
WHERE NOT EXISTS (
  SELECT 1 FROM `oc_setting`
  WHERE `store_id` = 0 AND `code` = 'qiqo' AND `key` = 'qiqo_full_snapshot_min_ratio'
);
