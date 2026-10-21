CREATE TABLE IF NOT EXISTS `oc_leaflet` (
  `leaflet_id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `published_at` DATE NOT NULL,
  `filename` VARCHAR(64) NOT NULL,
  `original_filename` VARCHAR(255) NOT NULL,
  `pdf_size` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `thumbnail` VARCHAR(255) NOT NULL DEFAULT '',
  `status` TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order` INT(11) NOT NULL DEFAULT 0,
  `date_added` DATETIME NOT NULL,
  `date_modified` DATETIME NOT NULL,
  PRIMARY KEY (`leaflet_id`),
  KEY `published` (`status`,`published_at`,`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
