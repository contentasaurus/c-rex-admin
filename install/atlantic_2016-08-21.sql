# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 45.55.40.232 (MySQL 5.5.5-10.1.10-MariaDB)
# Database: atlantic
# Generation Time: 2016-08-22 02:32:39 +0000
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

LOCK TABLES `article_types` WRITE;
/*!40000 ALTER TABLE `article_types` DISABLE KEYS */;

INSERT INTO `article_types` (`id`, `name`)
VALUES
	(1,'Blog Post');

/*!40000 ALTER TABLE `article_types` ENABLE KEYS */;
UNLOCK TABLES;


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



# Dump of table datatypes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `datatypes`;

CREATE TABLE `datatypes` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `collection_name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `datatypes_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table datasources
# ------------------------------------------------------------

DROP TABLE IF EXISTS `datasources`;

CREATE TABLE `datasources` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `db_type` varchar(100) NOT NULL DEFAULT '',
  `db_name` varchar(100) NOT NULL DEFAULT '',
  `db_user` varchar(100) NOT NULL DEFAULT '',
  `db_password` varchar(100) NOT NULL DEFAULT '',
  `db_address` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table page_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_data`;

CREATE TABLE `page_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `datatype_id` bigint(20) unsigned NOT NULL,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `reference_name` varchar(100) NOT NULL DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`reference_name`),
  KEY `author_user_id` (`author_user_id`),
  KEY `page_id` (`page_id`),
  KEY `datatype_id` (`datatype_id`),
  CONSTRAINT `page_data_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `page_data_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `page_data_ibfk_3` FOREIGN KEY (`datatype_id`) REFERENCES `datatypes` (`id`)
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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

LOCK TABLES `page_status` WRITE;
/*!40000 ALTER TABLE `page_status` DISABLE KEYS */;

INSERT INTO `page_status` (`id`, `name`, `description`)
VALUES
	(10,'Draft','Draft of a page. Drafts are not published, nor promoted.'),
	(20,'Request Review','Request an editor to review the page.'),
	(30,'On Review','Editor has accepted page for review.'),
	(40,'Pass Review','Page has passed review and is acceptable for publication.'),
	(50,'Fail Review','Page has failed review and in unacceptable for publication.'),
	(60,'Publish Ready','Page is in a publishable state.'),
	(70,'Hold','Page has been put on hold.'),
	(100,'Rejected','Page has been rejected.');

/*!40000 ALTER TABLE `page_status` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `access_level`)
VALUES
	(1,'Site Owner',255),
	(2,'Editor',128),
	(3,'Author',64),
	(4,'Disabled User',0);

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table script_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `script_types`;

CREATE TABLE `script_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `template` varchar(500) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `script_types` WRITE;
/*!40000 ALTER TABLE `script_types` DISABLE KEYS */;

INSERT INTO `script_types` (`id`, `name`, `template`)
VALUES
	(1,'Meta','<meta name=\"description\" content=\"I love the Atlantic CMS\">'),
	(2,'JS','<script type=\"text/javascript\" src=\"javascripts.js\"></script>'),
	(3,'Nonblocking JS','<script type=\"text/javascript\" src=\"javascripts.js\"></script>'),
	(4,'Style','<style type=\"text/css\">\n.roses {color:red;}\n.violets {color:blue;}\n</style>'),
	(5,'Linked','<link rel=\"stylesheet\" type=\"text/css\" href=\"theme.css\">');

/*!40000 ALTER TABLE `script_types` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password`, `title`, `additional`, `updated_at`, `created_at`, `is_active`)
VALUES
	(1,1,'Joshua','Byington','jbyington@paradowski.com','$2y$10$Vj6Wq64MsoNrujkHHztno.a3NzqEph/rhG3x9B38i5xOAWOgZ1qMK','Director of Development',X'0403003500000003000E0063002100B3006661766F726974655F636F6C6F7261757468656E746963617465645F656D61696C666F7263655F70617373776F72645F726573657421677265656E21747275652174727565','2016-05-08 01:55:37','2016-04-27 16:59:58',1),
	(2,2,'Jim','Croche','jbyington+editor@paradowski.com','$2y$10$qu2FOYe4fnylKfDc1QS1yOKY9.5vwEI98vJVT0Hl0r8wAZPTIyKKS','Master Guitarist and Vocalist',NULL,'2016-05-31 18:19:31','2016-05-10 23:26:26',1),
	(3,3,'Cat','Stevens','jbyington+author@paradowski.com','$2y$10$RrSjdbpND0EB4/pzTRJ9uO9KMrV0XHg84Ly0IxxXkGRV1i9Tv6f36','Conductor, Peace Train',NULL,'2016-05-19 12:14:04','2016-05-10 23:51:42',1),
	(4,4,'James','Hendrix','jbyington+disabled@paradowski.com','$2y$10$O2omz5AOrHF.e9LAjYiSzedpz4zb6DcQdAFzIDEaJKmF6Mqz2ShMG','Genius',NULL,'2016-08-14 13:40:39','2016-05-10 23:52:43',0);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
