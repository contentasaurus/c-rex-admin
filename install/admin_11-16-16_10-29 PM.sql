# ************************************************************
# Sequel Pro SQL dump
# Version 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 10.0.27-MariaDB)
# Database: crex_admin
# Generation Time: 2016-11-17 04:29:47 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table components
# ------------------------------------------------------------

DROP TABLE IF EXISTS `components`;

CREATE TABLE `components` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `uuid` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `html` text,
  `css` text,
  `js` text,
  `nonblocking_js` text,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `components_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_insert_components` BEFORE INSERT ON `components` FOR EACH ROW SET new.uuid = concat('c',uuid()),
new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_update_components` BEFORE UPDATE ON `components` FOR EACH ROW SET new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table datasources
# ------------------------------------------------------------

DROP TABLE IF EXISTS `datasources`;

CREATE TABLE `datasources` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(100) NOT NULL DEFAULT 'mysql',
  `host` varchar(100) NOT NULL DEFAULT '',
  `port` varchar(100) NOT NULL DEFAULT '3306',
  `dbname` varchar(100) NOT NULL DEFAULT '',
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table datatypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `datatypes`;

CREATE TABLE `datatypes` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `collection_name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `datatypes_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_datatypes_insert` BEFORE INSERT ON `datatypes` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_datatypes_update` BEFORE UPDATE ON `datatypes` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table deployable_components
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_components`;

CREATE TABLE `deployable_components` (
   `name` VARCHAR(100) NOT NULL DEFAULT '',
   `html` MEDIUMTEXT NULL DEFAULT NULL,
   `scss` MEDIUMTEXT NULL DEFAULT NULL,
   `js_head` MEDIUMTEXT NULL DEFAULT NULL,
   `js_body` MEDIUMTEXT NULL DEFAULT NULL,
   `priority` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM;



# Dump of table deployable_layouts
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_layouts`;

CREATE TABLE `deployable_layouts` (
   `id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `layout_name` VARCHAR(107) NOT NULL DEFAULT '',
   `content` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_page_data
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_page_data`;

CREATE TABLE `deployable_page_data` (
   `page_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `page` VARCHAR(25) NOT NULL DEFAULT '',
   `reference_name` VARCHAR(100) NOT NULL DEFAULT '',
   `content` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_pages
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_pages`;

CREATE TABLE `deployable_pages` (
   `page_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `version_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `permalink` VARCHAR(255) NULL DEFAULT NULL,
   `page` VARCHAR(25) NOT NULL DEFAULT '',
   `layout` VARCHAR(107) NOT NULL DEFAULT '',
   `percentage` INT(11) NOT NULL DEFAULT '0',
   `title` VARCHAR(255) NOT NULL DEFAULT '',
   `contents` LONGTEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_scripts
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_scripts`;

CREATE TABLE `deployable_scripts` (
   `layout_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `layout_name` VARCHAR(107) NOT NULL DEFAULT '',
   `script_type` VARCHAR(50) NOT NULL DEFAULT '',
   `name` VARCHAR(50) NOT NULL DEFAULT '',
   `html` LONGTEXT NULL DEFAULT NULL,
   `load_order` INT(11) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM;



# Dump of table deployable_site_data
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_site_data`;

CREATE TABLE `deployable_site_data` (
   `reference_name` VARCHAR(100) NOT NULL DEFAULT '',
   `content` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table helpers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `helpers`;

CREATE TABLE `helpers` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `helpers_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_helpers_insert` BEFORE INSERT ON `helpers` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_helpers_update` BEFORE UPDATE ON `helpers` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table page_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_data`;

CREATE TABLE `page_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `datatype_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `author_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `reference_name` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`reference_name`),
  KEY `author_user_id` (`author_user_id`),
  KEY `datatype_id` (`datatype_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `page_data_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `page_data_ibfk_3` FOREIGN KEY (`datatype_id`) REFERENCES `datatypes` (`id`),
  CONSTRAINT `page_data_ibfk_4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_page_data_insert` BEFORE INSERT ON `page_data` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_page_data_update` BEFORE UPDATE ON `page_data` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table page_layout_scripts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_layout_scripts`;

CREATE TABLE `page_layout_scripts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_layout_id` bigint(20) unsigned NOT NULL,
  `script_id` bigint(20) unsigned NOT NULL,
  `load_order` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table page_layouts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_layouts`;

CREATE TABLE `page_layouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `page_layouts_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_page_layouts_insert` BEFORE INSERT ON `page_layouts` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_page_layouts_update` BEFORE UPDATE ON `page_layouts` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table page_version_preview
# ------------------------------------------------------------

DROP VIEW IF EXISTS `page_version_preview`;

CREATE TABLE `page_version_preview` (
   `page_version_id` BIGINT(20) UNSIGNED NULL DEFAULT '0',
   `page_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `layout_id` BIGINT(20) UNSIGNED NULL DEFAULT '0',
   `permalink` VARCHAR(255) NULL DEFAULT NULL,
   `title` VARCHAR(255) NULL DEFAULT '',
   `layout` TEXT NULL DEFAULT NULL,
   `contents` LONGTEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table page_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_versions`;

CREATE TABLE `page_versions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `page_layout_id` bigint(20) DEFAULT NULL,
  `percentage` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `contents` longtext,
  `comments` varchar(500) DEFAULT NULL,
  `is_publishable` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `author_user_id` (`author_user_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `page_versions_ibfk_2` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `page_versions_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_page_versions_insert` BEFORE INSERT ON `page_versions` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_page_version_update` BEFORE UPDATE ON `page_versions` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `permalink` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `sort_order` bigint(20) unsigned NOT NULL DEFAULT '1',
  `is_publishable` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`permalink`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_pages_insert` BEFORE INSERT ON `pages` FOR EACH ROW SET new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_pages_update` BEFORE UPDATE ON `pages` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table previewable_layouts
# ------------------------------------------------------------

DROP VIEW IF EXISTS `previewable_layouts`;

CREATE TABLE `previewable_layouts` (
   `id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `layout_name` VARCHAR(107) NOT NULL DEFAULT '',
   `content` TEXT NULL DEFAULT NULL,
   `js_head` TEXT NULL DEFAULT NULL,
   `js_body` TEXT NULL DEFAULT NULL,
   `scss` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table previewable_pages
# ------------------------------------------------------------

DROP VIEW IF EXISTS `previewable_pages`;

CREATE TABLE `previewable_pages` (
   `page_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `version_id` BIGINT(20) UNSIGNED NULL DEFAULT '0',
   `permalink` VARCHAR(255) NULL DEFAULT NULL,
   `page` VARCHAR(25) NOT NULL DEFAULT '',
   `layout` VARCHAR(107) NULL DEFAULT NULL,
   `percentage` INT(11) NULL DEFAULT '0',
   `title` VARCHAR(255) NULL DEFAULT '',
   `contents` LONGTEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table script_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `script_types`;

CREATE TABLE `script_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `template` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table scripts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `scripts`;

CREATE TABLE `scripts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `script_type_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `author_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `html` longtext,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_scripts_insert` BEFORE INSERT ON `scripts` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_scripts_update` BEFORE UPDATE ON `scripts` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table site_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `site_data`;

CREATE TABLE `site_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `datatype_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `author_user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `reference_name` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`reference_name`),
  KEY `author_user_id` (`author_user_id`),
  KEY `datatype_id` (`datatype_id`),
  CONSTRAINT `site_data_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `site_data_ibfk_3` FOREIGN KEY (`datatype_id`) REFERENCES `datatypes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_site_data_insert` BEFORE INSERT ON `site_data` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_site_data_update` BEFORE UPDATE ON `site_data` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(500) NOT NULL DEFAULT '',
  `password` varchar(1000) NOT NULL DEFAULT '',
  `title` varchar(100) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_users_insert` BEFORE INSERT ON `users` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_users_update` BEFORE UPDATE ON `users` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;




# Replace placeholder table for deployable_site_data with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_site_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_site_data`
AS SELECT
   `sd`.`reference_name` AS `reference_name`,
   `sd`.`content` AS `content`
FROM `site_data` `sd`;


# Replace placeholder table for deployable_layouts with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_layouts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_layouts`
AS SELECT
   `pl`.`id` AS `id`,concat('layout_',`pl`.`name`) AS `layout_name`,
   `pl`.`content` AS `content`
FROM `page_layouts` `pl`;


# Replace placeholder table for deployable_pages with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_pages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_pages`
AS SELECT
   `p`.`id` AS `page_id`,
   `pv`.`id` AS `version_id`,
   `p`.`permalink` AS `permalink`,concat('page_',`p`.`id`) AS `page`,concat('layout_',`pl`.`name`) AS `layout`,
   `pv`.`percentage` AS `percentage`,
   `pv`.`title` AS `title`,
   `pv`.`contents` AS `contents`
FROM ((`pages` `p` join `page_versions` `pv` on(((`pv`.`page_id` = `p`.`id`) and (`pv`.`is_publishable` = 1)))) join `page_layouts` `pl` on((`pl`.`id` = `pv`.`page_layout_id`))) where (`p`.`is_publishable` = 1);


# Replace placeholder table for deployable_components with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_components`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `deployable_components`
AS SELECT
   `c`.`name` AS `name`,concat('<div class="',`c`.`uuid`,' component_',`c`.`name`,'">',`c`.`html`,'</div>') AS `html`,concat('.',`c`.`uuid`,'{',`c`.`css`,'}') AS `scss`,concat('(function(uuid){',`c`.`js`,'})("',`c`.`uuid`,'");') AS `js_head`,concat('(function(uuid){',`c`.`nonblocking_js`,'})("',`c`.`uuid`,'");') AS `js_body`,
   `c`.`priority` AS `priority`
FROM `components` `c`;


# Replace placeholder table for page_version_preview with correct view syntax
# ------------------------------------------------------------

DROP TABLE `page_version_preview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `page_version_preview`
AS SELECT
   `pv`.`id` AS `page_version_id`,
   `p`.`id` AS `page_id`,
   `pl`.`id` AS `layout_id`,
   `p`.`permalink` AS `permalink`,
   `pv`.`title` AS `title`,
   `pl`.`content` AS `layout`,
   `pv`.`contents` AS `contents`
FROM ((`pages` `p` left join `page_versions` `pv` on((`pv`.`page_id` = `p`.`id`))) left join `page_layouts` `pl` on((`pl`.`id` = `pv`.`page_layout_id`)));


# Replace placeholder table for previewable_pages with correct view syntax
# ------------------------------------------------------------

DROP TABLE `previewable_pages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `previewable_pages`
AS SELECT
   `p`.`id` AS `page_id`,
   `pv`.`id` AS `version_id`,
   `p`.`permalink` AS `permalink`,concat('page_',`p`.`id`) AS `page`,concat('layout_',`pl`.`name`) AS `layout`,
   `pv`.`percentage` AS `percentage`,
   `pv`.`title` AS `title`,
   `pv`.`contents` AS `contents`
FROM ((`pages` `p` left join `page_versions` `pv` on((`pv`.`page_id` = `p`.`id`))) left join `page_layouts` `pl` on((`pl`.`id` = `pv`.`page_layout_id`)));


# Replace placeholder table for deployable_page_data with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_page_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `deployable_page_data`
AS SELECT
   `pd`.`page_id` AS `page_id`,concat('page_',`pd`.`page_id`) AS `page`,
   `pd`.`reference_name` AS `reference_name`,
   `pd`.`content` AS `content`
FROM (`page_data` `pd` join `deployable_pages` `dp` on((`dp`.`page` = concat('page_',`pd`.`page_id`)))) group by `pd`.`id`;


# Replace placeholder table for previewable_layouts with correct view syntax
# ------------------------------------------------------------

DROP TABLE `previewable_layouts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `previewable_layouts`
AS SELECT
   `pl`.`id` AS `id`,concat('layout_',`pl`.`name`) AS `layout_name`,
   `pl`.`content` AS `content`,group_concat(`s2`.`html` separator ' ') AS `js_head`,group_concat(`s3`.`html` separator ' ') AS `js_body`,group_concat(`s4`.`html` separator ' ') AS `scss`
FROM ((((`page_layouts` `pl` left join `page_layout_scripts` `pls` on((`pl`.`id` = `pls`.`page_layout_id`))) left join `scripts` `s2` on(((`s2`.`id` = `pls`.`script_id`) and (`s2`.`script_type_id` = 2)))) left join `scripts` `s3` on(((`s3`.`id` = `pls`.`script_id`) and (`s3`.`script_type_id` = 3)))) left join `scripts` `s4` on(((`s4`.`id` = `pls`.`script_id`) and (`s4`.`script_type_id` = 4)))) group by `pl`.`id` order by `pls`.`load_order`;


# Replace placeholder table for deployable_scripts with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_scripts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_scripts`
AS SELECT
   `pl`.`id` AS `layout_id`,concat('layout_',`pl`.`name`) AS `layout_name`,
   `st`.`name` AS `script_type`,
   `s`.`name` AS `name`,
   `s`.`html` AS `html`,
   `pls`.`load_order` AS `load_order`
FROM (((`page_layout_scripts` `pls` join `scripts` `s` on((`s`.`id` = `pls`.`script_id`))) join `page_layouts` `pl` on((`pl`.`id` = `pls`.`page_layout_id`))) join `script_types` `st` on((`st`.`id` = `s`.`script_type_id`))) order by `pls`.`load_order`;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
