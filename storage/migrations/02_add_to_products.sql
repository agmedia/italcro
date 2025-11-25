
ALTER TABLE `italcro`.`oc_product`
    ADD COLUMN `image_hash` CHAR(40) NULL AFTER `image`;

ALTER TABLE `italcro`.`oc_product_image`
    ADD COLUMN `image_hash` CHAR(40) NULL AFTER `image`;

ALTER TABLE `italcro`.`oc_product_attach_file`
    ADD COLUMN `hash` CHAR(40) NULL AFTER `filename`;
