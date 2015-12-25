CREATE DATABASE IF NOT EXISTS `starbs-yeh`;

CREATE TABLE IF NOT EXISTS `starbs-yeh`.`images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hash` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `image` mediumblob DEFAULT NULL,
  `mime` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `images_hash_unique` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
