-- ERP classifications are separate from product families (mpn).
CREATE TABLE IF NOT EXISTS `oc_qiqo_article_classification` (
  `article_code` VARCHAR(64) NOT NULL,
  `classification` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`article_code`),
  KEY `classification` (`classification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Rev3.3 reconciles the current action list from its complete historical window.
-- Keep the separate catalog/full-deactivation contract disabled.
INSERT INTO `oc_setting` (`store_id`,`code`,`key`,`value`,`serialized`)
SELECT 0,'qiqo','qiqo_action_snapshot_since','2000-01-01',0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE store_id=0 AND `key`='qiqo_action_snapshot_since');
