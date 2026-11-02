-- A separate opt-in for qArtikliWeb, never the global partner/action FULL gates.
-- Keep disabled until its complete historical response has been reviewed.
INSERT INTO `oc_setting` (`store_id`,`code`,`key`,`value`,`serialized`)
SELECT 0,'qiqo','qiqo_catalog_snapshot_confirmed','0',0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE store_id=0 AND `key`='qiqo_catalog_snapshot_confirmed');

INSERT INTO `oc_setting` (`store_id`,`code`,`key`,`value`,`serialized`)
SELECT 0,'qiqo','qiqo_catalog_snapshot_since','',0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE store_id=0 AND `key`='qiqo_catalog_snapshot_since');

INSERT INTO `oc_setting` (`store_id`,`code`,`key`,`value`,`serialized`)
SELECT 0,'qiqo','qiqo_catalog_snapshot_min_ratio','0.8',0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE store_id=0 AND `key`='qiqo_catalog_snapshot_min_ratio');

INSERT INTO `oc_setting` (`store_id`,`code`,`key`,`value`,`serialized`)
SELECT 0,'qiqo','qiqo_catalog_snapshot_max_deactivation_ratio','0.2',0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE store_id=0 AND `key`='qiqo_catalog_snapshot_max_deactivation_ratio');

-- Explicit per-SKU temporary exceptions only; no global skip for unnamed active products.
INSERT INTO `oc_setting` (`store_id`,`code`,`key`,`value`,`serialized`)
SELECT 0,'qiqo','qiqo_catalog_deferred_unnamed_skus','[]',0
WHERE NOT EXISTS (SELECT 1 FROM `oc_setting` WHERE store_id=0 AND `key`='qiqo_catalog_deferred_unnamed_skus');
