# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 45.55.40.232 (MySQL 5.5.5-10.1.10-MariaDB)
# Database: atlantic
# Generation Time: 2016-07-18 18:19:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table article_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article_types`;

CREATE TABLE `article_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table articles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `article_type_id` bigint(20) unsigned NOT NULL,
  `title` varchar(500) NOT NULL,
  `excerpt` varchar(500) NOT NULL DEFAULT '',
  `permalink` varchar(1000) DEFAULT NULL,
  `content` longtext,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `published_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `author_user_id` (`author_user_id`),
  KEY `page_type_id` (`article_type_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`article_type_id`) REFERENCES `article_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table components
# ------------------------------------------------------------

DROP TABLE IF EXISTS `components`;

CREATE TABLE `components` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `html` text,
  `css` text,
  `js` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `components_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table dam_media
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dam_media`;

CREATE TABLE `dam_media` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `remote_uri` varchar(2000) DEFAULT '',
  `local_path` varchar(2000) DEFAULT '',
  `thumbnail_path` varchar(2000) DEFAULT '',
  `mimetype` varchar(100) NOT NULL DEFAULT '',
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `size` bigint(20) NOT NULL,
  `views` bigint(11) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table dam_media_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dam_media_tags`;

CREATE TABLE `dam_media_tags` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `media_id` bigint(11) unsigned NOT NULL,
  `tag_id` bigint(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_id` (`tag_id`,`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table dam_media_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dam_media_types`;

CREATE TABLE `dam_media_types` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table dam_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dam_tags`;

CREATE TABLE `dam_tags` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `data`;

CREATE TABLE `data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `data` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `collection_name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `data_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table page_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_history`;

CREATE TABLE `page_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `page_layout_id` bigint(20) NOT NULL,
  `page_status_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `permalink` varchar(1000) DEFAULT NULL,
  `page_name` varchar(500) NOT NULL,
  `page_content` longtext,
  `page_additional` blob,
  `sort_order` bigint(20) unsigned NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_user_id` (`author_user_id`),
  KEY `page_status_id` (`page_status_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `page_history_ibfk_4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `page_layouts_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table page_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_logs`;

CREATE TABLE `page_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `new_page_status_id` bigint(20) unsigned NOT NULL,
  `prev_page_status_id` bigint(20) unsigned NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  KEY `user_id` (`user_id`),
  KEY `new_page_status_id` (`new_page_status_id`),
  KEY `prev_page_status_id` (`prev_page_status_id`),
  CONSTRAINT `page_logs_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `page_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `page_logs_ibfk_3` FOREIGN KEY (`new_page_status_id`) REFERENCES `page_status` (`id`),
  CONSTRAINT `page_logs_ibfk_4` FOREIGN KEY (`prev_page_status_id`) REFERENCES `page_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table page_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_status`;

CREATE TABLE `page_status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `page_status_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `page_layout_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `permalink` varchar(1000) DEFAULT NULL,
  `page_name` varchar(500) NOT NULL,
  `page_content` longtext,
  `page_additional` blob,
  `sort_order` bigint(20) unsigned NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_user_id` (`author_user_id`),
  KEY `page_status_id` (`page_status_id`),
  KEY `page_layout_id` (`page_layout_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `pages_ibfk_3` FOREIGN KEY (`page_status_id`) REFERENCES `page_status` (`id`),
  CONSTRAINT `pages_ibfk_4` FOREIGN KEY (`page_layout_id`) REFERENCES `page_layouts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `access_level` tinyint(4) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `script_type_id` bigint(20) unsigned NOT NULL,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `html` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(500) NOT NULL DEFAULT '',
  `password` varchar(1000) NOT NULL DEFAULT '',
  `title` varchar(100) DEFAULT NULL,
  `additional` blob,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
