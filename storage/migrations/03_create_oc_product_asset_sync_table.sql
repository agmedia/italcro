CREATE TABLE `italcro`.`oc_product_asset_sync`
(
    `product_asset_sync_id` INT(11) NOT NULL AUTO_INCREMENT,
    `sku`                   VARCHAR(64) NOT NULL,
    `product_id`            INT(11) DEFAULT NULL,

    `has_product`           TINYINT(1) NOT NULL DEFAULT 0,   -- produkt postoji u OC bazi
    `has_folder`            TINYINT(1) NOT NULL DEFAULT 0,   -- postoji folder Database/sku/

    `missing_images`        TINYINT(1) NOT NULL DEFAULT 0,   -- sku folder ima više slika nego baza
    `missing_price`         TINYINT(1) NOT NULL DEFAULT 0,   -- cijena = 0 ili nema zapisa
    `missing_sku_data`      TINYINT(1) NOT NULL DEFAULT 0,   -- SKU postoji ali nedostaju osnovna polja

    `status`                VARCHAR(32) NOT NULL DEFAULT '', -- ok, missing_folder, missing_product, partial
    `last_checked`          DATETIME    NOT NULL,
    `message`               TEXT,

    PRIMARY KEY (`product_asset_sync_id`),
    KEY                     `sku` (`sku`),
    KEY                     `product_id` (`product_id`),
    KEY                     `status` (`status`)
) ENGINE=MyISAM
  DEFAULT CHARSET=utf8
  COLLATE=utf8_general_ci;
