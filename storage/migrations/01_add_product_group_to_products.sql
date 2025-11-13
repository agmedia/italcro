
/*
Možda zatreba...

ALTER TABLE `italcro`.`oc_product`
    MODIFY COLUMN `date_available` DATE NULL DEFAULT NULL;

*/

ALTER TABLE `italcro`.`oc_product`
    ADD COLUMN `cent` VARCHAR(6) NULL DEFAULT NULL AFTER `price`;

ALTER TABLE `italcro`.`oc_product_description`
    ADD COLUMN `name_add` VARCHAR(191) NULL DEFAULT NULL AFTER `name`,
    ADD COLUMN `description_add` TEXT NULL AFTER `description`;

/*
Možda zatreba...

ALTER TABLE `italcro`.`oc_product_description`
    MODIFY COLUMN `name_add` VARCHAR(191) NULL DEFAULT NULL AFTER `name`,
    MODIFY COLUMN `description_add` TEXT NULL AFTER `description`;

*/