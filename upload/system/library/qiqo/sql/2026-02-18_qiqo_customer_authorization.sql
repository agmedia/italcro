-- QIQO / Italcro - Customer authorization & discount cache schema
-- Date: 2026-02-18
-- NOTE: This script uses "oc_" prefix. If your DB_PREFIX is different, replace "oc_" accordingly.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_partner` (
  `partner_id` INT(11) NOT NULL,
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `oib` VARCHAR(32) NOT NULL DEFAULT '',
  `address` VARCHAR(255) NOT NULL DEFAULT '',
  `place` VARCHAR(255) NOT NULL DEFAULT '',
  `base_discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `api_modified_at` VARCHAR(64) NULL,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`partner_id`),
  KEY `idx_oib` (`oib`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_delivery_place` (
  `delivery_place_id` INT(11) NOT NULL,
  `partner_id` INT(11) NOT NULL,
  `code` VARCHAR(64) NOT NULL DEFAULT '',
  `name` VARCHAR(255) NOT NULL DEFAULT '',
  `address` VARCHAR(255) NOT NULL DEFAULT '',
  `place` VARCHAR(255) NOT NULL DEFAULT '',
  `api_modified_at` VARCHAR(64) NULL,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`delivery_place_id`),
  KEY `idx_partner` (`partner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_partner_article_discount` (
  `partner_id` INT(11) NOT NULL,
  `article_code` VARCHAR(64) NOT NULL,
  `discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`partner_id`, `article_code`),
  KEY `idx_article` (`article_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_action_price` (
  `article_code` VARCHAR(64) NOT NULL,
  `indicator` CHAR(1) NOT NULL,
  `quantity` DECIMAL(15,4) NOT NULL DEFAULT 0,
  `price` DECIMAL(15,4) NOT NULL DEFAULT 0,
  `discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`article_code`, `indicator`, `quantity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `oc_qiqo_sync_state` (
  `feed_key` VARCHAR(64) NOT NULL,
  `last_sync_at` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`feed_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Komercijalisti (dok API tablica ne bude finalizirana, ova tablica se može puniti ručno/importom)
CREATE TABLE IF NOT EXISTS `oc_qiqo_sales_rep` (
  `sales_rep_id` INT(11) NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(64) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`sales_rep_id`),
  UNIQUE KEY `uq_code` (`code`),
  KEY `idx_active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Veza kupca na partner/mjesto isporuke/komercijalista + snapshot odobrenja
CREATE TABLE IF NOT EXISTS `oc_customer_qiqo_authorization` (
  `customer_id` INT(11) NOT NULL,
  `partner_id` INT(11) NOT NULL,
  `delivery_place_id` INT(11) NOT NULL,
  `sales_rep_id` INT(11) NULL,
  `partner_discount` DECIMAL(10,4) NOT NULL DEFAULT 0,
  `approved_by_user_id` INT(11) NOT NULL,
  `approved_at` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `idx_partner` (`partner_id`),
  KEY `idx_delivery_place` (`delivery_place_id`),
  KEY `idx_sales_rep` (`sales_rep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

