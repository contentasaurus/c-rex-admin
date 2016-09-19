# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 45.55.40.232 (MySQL 5.5.5-10.1.10-MariaDB)
# Database: atlantic
# Generation Time: 2016-09-19 03:01:26 +0000
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

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;

INSERT INTO `components` (`id`, `author_user_id`, `name`, `description`, `html`, `css`, `js`, `created_at`, `updated_at`)
VALUES
	(1,1,'header','This is the header for the site','<section id=\"header\">\r\n    <header>\r\n        <h1>WELCOME!</h1>\r\n    </header>\r\n    \r\n    {{#each menu_col }}\r\n        {{> menu_block andy }}\r\n    {{/ menu_col }}\r\n    \r\n    <div>\r\n        <span>HI</span>\r\n    </div>\r\n    \r\n    <div>\r\n        <span>\r\n            <pre></pre>\r\n        </span>\r\n    </div>\r\n</section>','section#header{\r\n    color:blue;\r\n}\r\nsection#header a{\r\n    background-color:red;\r\n}','$(function(){\r\n    alert(\'hi\');\r\n});','2016-05-19 18:18:52','2016-08-13 01:56:05'),
	(3,1,'test','Hi','<button class=\"{{ button_class }}\">\r\n    {{ button_text }}\r\n</button>\r\n\r\n{{ etc }}\r\n\r\n{{#if stuff}}\r\nstuff\r\n{{/if}}',NULL,NULL,'2016-06-02 21:36:08','2016-08-26 12:49:55'),
	(6,7,'Related Articles','Grabs a list of related articles and outputs links to their details.','{{!-- Related Articles --}}\r\n\r\n<ul>\r\n	{{#each articles}}\r\n	<li class=\"{{theme_color}}\">\r\n		<a href=\"{{href}}\">\r\n			{{title}}\r\n		</a>\r\n	</li>\r\n	{{/each}}\r\n</ul>\r\n',NULL,NULL,'2016-09-07 18:29:45','2016-09-07 18:29:56');

/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `dam_media` WRITE;
/*!40000 ALTER TABLE `dam_media` DISABLE KEYS */;

INSERT INTO `dam_media` (`id`, `remote_uri`, `local_path`, `thumbnail_path`, `mimetype`, `width`, `height`, `size`, `views`, `created_at`, `updated_at`)
VALUES
	(1,'','/uploads/media/business.jpg','/uploads/media/thumbnails/business.jpg','image/jpeg',461,700,42050,1,'2016-06-09 23:35:17','2016-06-10 10:52:57'),
	(2,'','/uploads/media/Ek.jpg','/uploads/media/thumbnails/Ek.jpg','image/jpeg',1800,1800,1413747,0,'2016-06-09 23:35:17','0000-00-00 00:00:00'),
	(3,'','/uploads/media/greatjob.png','/uploads/media/thumbnails/greatjob.png','image/png',400,533,290414,0,'2016-06-09 23:35:17','0000-00-00 00:00:00'),
	(4,'','/uploads/media/old timey ping strong.fw.png','/uploads/media/thumbnails/old timey ping strong.fw.png','image/png',500,500,109497,0,'2016-06-09 23:36:15','0000-00-00 00:00:00'),
	(5,'','/uploads/media/2005-08-05 13.38.08.jpg','/uploads/media/thumbnails/2005-08-05 13.38.08.jpg','image/jpeg',400,300,29940,0,'2016-06-10 00:00:00','0000-00-00 00:00:00'),
	(6,'','/uploads/media/2005-08-05 13.38.46.jpg','/uploads/media/thumbnails/2005-08-05 13.38.46.jpg','image/jpeg',400,300,23641,0,'2016-06-10 00:00:00','0000-00-00 00:00:00'),
	(7,'','/uploads/media/2005-08-05 13.49.42.jpg','/uploads/media/thumbnails/2005-08-05 13.49.42.jpg','image/jpeg',400,300,25105,0,'2016-06-10 00:00:00','0000-00-00 00:00:00'),
	(8,'','/uploads/media/2005-08-05 13.49.44.jpg','/uploads/media/thumbnails/2005-08-05 13.49.44.jpg','image/jpeg',400,300,27337,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(9,'','/uploads/media/2005-08-05 13.49.46.jpg','/uploads/media/thumbnails/2005-08-05 13.49.46.jpg','image/jpeg',400,300,32420,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(10,'','/uploads/media/2005-08-05 13.49.48.jpg','/uploads/media/thumbnails/2005-08-05 13.49.48.jpg','image/jpeg',400,300,21392,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(11,'','/uploads/media/2005-08-05 13.51.54.jpg','/uploads/media/thumbnails/2005-08-05 13.51.54.jpg','image/jpeg',400,300,24702,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(12,'','/uploads/media/2005-08-05 13.51.56.jpg','/uploads/media/thumbnails/2005-08-05 13.51.56.jpg','image/jpeg',400,300,25427,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(13,'','/uploads/media/2005-08-05 13.52.02-1.jpg','/uploads/media/thumbnails/2005-08-05 13.52.02-1.jpg','image/jpeg',400,300,36268,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(14,'','/uploads/media/2005-08-05 13.52.02-2.jpg','/uploads/media/thumbnails/2005-08-05 13.52.02-2.jpg','image/jpeg',400,300,38089,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(15,'','/uploads/media/2005-08-05 13.52.02-3.jpg','/uploads/media/thumbnails/2005-08-05 13.52.02-3.jpg','image/jpeg',400,300,32909,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(16,'','/uploads/media/2005-08-05 13.52.02-4.jpg','/uploads/media/thumbnails/2005-08-05 13.52.02-4.jpg','image/jpeg',400,300,20296,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(17,'','/uploads/media/2005-08-05 13.52.02-5.jpg','/uploads/media/thumbnails/2005-08-05 13.52.02-5.jpg','image/jpeg',400,300,25757,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(18,'','/uploads/media/2005-08-05 13.52.02.jpg','/uploads/media/thumbnails/2005-08-05 13.52.02.jpg','image/jpeg',400,300,24995,0,'2016-06-10 00:00:01','0000-00-00 00:00:00'),
	(33,'','/uploads/media/HenryGreatJob.jpg','/uploads/media/thumbnails/HenryGreatJob.jpg','image/jpeg',251,251,90617,0,'2016-06-10 00:06:26','0000-00-00 00:00:00'),
	(34,'http://americasfarmerstest.s3.amazonaws.com/wp-content/uploads/2013/11/AF-OldFamilies-1200_0000_Derocher.jpg','/uploads/media/AF-OldFamilies-1200_0000_Derocher.jpg','/uploads/media/thumbnails/AF-OldFamilies-1200_0000_Derocher.jpg','image/jpeg',1200,510,140042,0,'2016-06-10 00:07:24','0000-00-00 00:00:00'),
	(35,'','/uploads/media/Keith.jpg','/uploads/media/thumbnails/Keith.jpg','image/jpeg',1800,1800,1138194,0,'2016-06-10 10:48:49','0000-00-00 00:00:00'),
	(36,'http://www.tacobueno.com/media/1382/bftlarge.png','/uploads/media/bftlarge.png','/uploads/media/thumbnails/bftlarge.png','image/png',722,445,340283,0,'2016-06-10 10:51:24','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `dam_media` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `dam_media_tags` WRITE;
/*!40000 ALTER TABLE `dam_media_tags` DISABLE KEYS */;

INSERT INTO `dam_media_tags` (`id`, `media_id`, `tag_id`)
VALUES
	(36,1,1),
	(37,2,1),
	(38,3,1),
	(5,17,1),
	(7,18,1),
	(9,19,1),
	(11,20,1),
	(13,21,1),
	(15,22,1),
	(17,23,1),
	(19,24,1),
	(21,25,1),
	(23,26,1),
	(25,27,1),
	(27,28,1),
	(29,29,1),
	(31,30,1),
	(40,1,2),
	(1,15,2),
	(3,16,2),
	(41,1,3),
	(33,31,3),
	(46,33,3),
	(42,1,4),
	(34,31,4),
	(47,33,4),
	(43,1,5),
	(2,15,5),
	(4,16,5),
	(6,17,5),
	(8,18,5),
	(10,19,5),
	(12,20,5),
	(14,21,5),
	(16,22,5),
	(18,23,5),
	(20,24,5),
	(22,25,5),
	(24,26,5),
	(26,27,5),
	(28,28,5),
	(30,29,5),
	(32,30,5),
	(44,1,6),
	(35,31,6),
	(45,1,7);

/*!40000 ALTER TABLE `dam_media_tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dam_media_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dam_media_types`;

CREATE TABLE `dam_media_types` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dam_media_types` WRITE;
/*!40000 ALTER TABLE `dam_media_types` DISABLE KEYS */;

INSERT INTO `dam_media_types` (`id`, `name`)
VALUES
	(1,'image'),
	(2,'video');

/*!40000 ALTER TABLE `dam_media_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dam_tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dam_tags`;

CREATE TABLE `dam_tags` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dam_tags` WRITE;
/*!40000 ALTER TABLE `dam_tags` DISABLE KEYS */;

INSERT INTO `dam_tags` (`id`, `tagname`)
VALUES
	(1,'portrait'),
	(2,'landscape'),
	(3,'XS'),
	(4,'SM'),
	(5,'MD'),
	(6,'LG'),
	(7,'XL');

/*!40000 ALTER TABLE `dam_tags` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `datasources` WRITE;
/*!40000 ALTER TABLE `datasources` DISABLE KEYS */;

INSERT INTO `datasources` (`id`, `name`, `type`, `host`, `port`, `dbname`, `username`, `password`, `description`)
VALUES
	(1,'staging','mysql','45.55.40.232','3306','atlantic_runtime','root','*T3mp3st!','The staging environment for Example.com');

/*!40000 ALTER TABLE `datasources` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `datatypes` WRITE;
/*!40000 ALTER TABLE `datatypes` DISABLE KEYS */;

INSERT INTO `datatypes` (`id`, `author_user_id`, `name`, `content`, `created_at`, `updated_at`)
VALUES
	(18,1,'menu','{[\r\n    {\r\n        \"name\":\"Home\",\r\n        \"href\":\"/\"\r\n    },\r\n    {\r\n        \"name\":\"Menu 1\",\r\n        \"children\":[\r\n            {\r\n              \"name\":\"Subitem 1\",\r\n              \"href\": \"/sub-item-1\"\r\n            },\r\n            {\r\n              \"name\":\"Subitem 2\",\r\n              \"href\": \"/sub-item-2\"\r\n            },\r\n            {\r\n              \"name\":\"Subitem 3\",\r\n              \"href\": \"/sub-item-3\"\r\n            },\r\n        ]\r\n    },\r\n    {\r\n        \"name\":\"Menu 2\",\r\n        \"children\":[\r\n            {\r\n              \"name\":\"Subitem 1\",\r\n              \"href\": \"/sub-item-1\"\r\n            },\r\n            {\r\n              \"name\":\"Subitem 2\",\r\n              \"href\": \"/sub-item-2\"\r\n            },\r\n            {\r\n              \"name\":\"Subitem 3\",\r\n              \"href\": \"/sub-item-3\"\r\n            },\r\n        ]\r\n    },\r\n]}','2016-07-09 23:53:00','2016-07-09 23:56:48'),
	(20,1,'form example','{\r\n    \"name\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"Name\",\r\n        \"label\": \"Name\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    },\r\n    \"age\":{ \r\n        \"type\":\"number\", \r\n        \"placeholder\":\"21\",\r\n        \"label\": \"Age\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"color\":{ \r\n        \"type\":\"color\", \r\n        \"placeholder\":\"\",\r\n        \"label\": \"Favorite Color\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"date\":{ \r\n        \"type\":\"date\", \r\n        \"placeholder\":\"\",\r\n        \"label\": \"Favorite Date\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"email\":{ \r\n        \"type\":\"email\", \r\n        \"placeholder\":\"atlantic@puffin.pinguinio.com\",\r\n        \"label\": \"Email Address\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"gender\":{ \r\n        \"type\":\"radio\", \r\n        \"options\":[\r\n            {\"label\":\"Male\", \"value\":\"M\"},\r\n            {\"label\":\"Female\", \"value\":\"F\"},\r\n            {\"label\":\"Both\", \"value\":\"B\"},\r\n            {\"label\":\"Neither\", \"value\":\"N\"},\r\n            {\"label\":\"Other\", \"value\":\"O\"}\r\n        ],\r\n        \"label\": \"Gender\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"role\":{\r\n        \"type\":\"select\", \r\n        \"label\": \"Role\",\r\n        \"default\": \"\",\r\n        \"multiple\": false,\r\n        \"options\":[\r\n            {\"label\":\"Standard\", \"value\":0},\r\n            {\"label\":\"Admin\", \"value\":1},\r\n            {\"label\":\"Superadmin\", \"value\":2}\r\n        ],\r\n        \"required\":false\r\n    },\r\n    \"food\":{\r\n        \"type\":\"select\", \r\n        \"label\": \"Food I Like\",\r\n        \"default\": \"\",\r\n        \"multiple\": true,\r\n        \"options\":[\r\n            {\"label\":\"Spaghetti\", \"value\":\"Spaghetti\"},\r\n            {\"label\":\"Pizza\", \"value\":\"Pizza\"},\r\n            {\"label\":\"Ice Cream\", \"value\":\"Ice Cream\"},\r\n            {\"label\":\"Burrito\", \"value\":\"Burrito\"}\r\n        ],\r\n        \"required\":false\r\n    },\r\n    \"hear_about\":{\r\n        \"type\":\"checkbox\",\r\n        \"label\": \"How did you hear about us?\",\r\n        \"options\":[\r\n            {\"label\":\"Mail\", \"value\":\"Mail\"},\r\n            {\"label\":\"Facebook\", \"value\":\"Facebook\"},\r\n            {\"label\":\"Twitter\", \"value\":\"Twitter\"},\r\n            {\"label\":\"CNN\", \"value\":\"CNN\"},\r\n            {\"label\":\"Newspaper\", \"value\":\"Newspaper\"}\r\n        ],\r\n        \"value\": \"true\"\r\n    },\r\n    \"comment\":{ \r\n        \"type\":\"textarea\", \r\n        \"placeholder\":\"Add a comment\",\r\n        \"label\": \"Comment\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    }\r\n}','2016-08-17 14:04:59','2016-08-20 00:19:20'),
	(21,1,'Repeater Example','{\r\n    \"name\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"Team Valour\",\r\n        \"label\": \"Team name\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    },\r\n    \"members\":{\r\n        \"type\":\"repeater\",\r\n        \"label\":\"Team members\",\r\n        \"fields\":{\r\n            \"first_name\":{ \r\n                \"type\":\"text\", \r\n                \"placeholder\":\"First Name\",\r\n                \"label\": \"First Name\",\r\n                \"default\": \"\",\r\n                \"required\":true\r\n            },\r\n            \"last_name\":{ \r\n                \"type\":\"text\", \r\n                \"placeholder\":\"Last Name\",\r\n                \"label\": \"Last Name\",\r\n                \"default\": \"\",\r\n                \"required\":true\r\n            },\r\n            \"hire_date\":{ \r\n                \"type\":\"date\", \r\n                \"label\": \"Hire Date\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"age\":{ \r\n                \"type\":\"number\", \r\n                \"placeholder\":\"21\",\r\n                \"label\": \"Age\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"lucky_number\":{ \r\n                \"type\":\"number\", \r\n                \"placeholder\":\"5\",\r\n                \"label\": \"Lucky Number\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"handedness\":{\r\n                \"type\":\"select\", \r\n                \"label\": \"Handedness\",\r\n                \"default\": \"\",\r\n                \"multiple\": false,\r\n                \"options\":[\r\n                    {\"label\":\"Left\", \"value\":\"Left\"},\r\n                    {\"label\":\"Right\", \"value\":\"Right\"},\r\n                    {\"label\":\"Both\", \"value\":\"Both\"},\r\n                    {\"label\":\"Neither\", \"value\":\"Neither\"}\r\n                ],\r\n                \"required\":true\r\n            }\r\n        }\r\n    }\r\n}','2016-08-20 00:31:58','2016-08-21 23:21:42');

/*!40000 ALTER TABLE `datatypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table deployable_components
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_components`;

CREATE TABLE `deployable_components` (
   `name` VARCHAR(100) NOT NULL DEFAULT '',
   `html` TEXT NULL DEFAULT NULL,
   `css` TEXT NULL DEFAULT NULL,
   `js` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_page_data
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_page_data`;

CREATE TABLE `deployable_page_data` (
   `page_data_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `page_id` BIGINT(20) UNSIGNED NOT NULL,
   `reference_name` VARCHAR(100) NOT NULL DEFAULT '',
   `content` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_page_layouts
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_page_layouts`;

CREATE TABLE `deployable_page_layouts` (
   `page_layout_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `content` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_pages
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_pages`;

CREATE TABLE `deployable_pages` (
   `permalink` VARCHAR(255) NULL DEFAULT NULL,
   `page_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `page_layout_id` BIGINT(20) NULL DEFAULT NULL,
   `percentage` INT(11) NOT NULL DEFAULT '0',
   `title` VARCHAR(255) NOT NULL DEFAULT '',
   `contents` LONGTEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `deployments`;

CREATE TABLE `deployments` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL DEFAULT '',
  `deployed_by_user_id` bigint(20) NOT NULL,
  `deployed_to_datasource_id` bigint(20) NOT NULL,
  `deployed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `deployments` WRITE;
/*!40000 ALTER TABLE `deployments` DISABLE KEYS */;

INSERT INTO `deployments` (`id`, `key`, `deployed_by_user_id`, `deployed_to_datasource_id`, `deployed_at`)
VALUES
	(1,'20160918215500',1,1,'2016-09-18 22:56:03');

/*!40000 ALTER TABLE `deployments` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `page_data` WRITE;
/*!40000 ALTER TABLE `page_data` DISABLE KEYS */;

INSERT INTO `page_data` (`id`, `page_id`, `datatype_id`, `author_user_id`, `reference_name`, `content`, `created_at`, `updated_at`)
VALUES
	(1,1,20,1,'test_data',NULL,'2016-08-17 14:19:00','2016-08-17 17:10:07'),
	(3,1,20,1,'test2','{\"name\":\"Josh Byington\",\"age\":\"36\",\"color\":\"#8efa00\",\"date\":\"1980-05-25\",\"email\":\"joshua.d.byington@gmail.com\",\"gender\":[\"M\"],\"role\":[\"1\"],\"food\":[\"Spaghetti\",\"Burrito\"],\"hear_about\":[\"Mail\",\"Facebook\",\"Twitter\",\"CNN\",\"Newspaper\"],\"comment\":\"\"}','2016-08-18 18:43:37','2016-08-20 00:19:06'),
	(4,1,21,1,'repeat','{\"name\":\"Team Kickass\",\"members\":[{\"first_name\":\"Josh\",\"last_name\":\"Byington\",\"hire_date\":\"1980-05-25\",\"age\":\"36\",\"lucky_number\":\"525\",\"handedness\":\"Right\"},{\"first_name\":\"Jeremy\",\"last_name\":\"Byington\",\"hire_date\":\"1982-05-10\",\"age\":\"34\",\"lucky_number\":\"57\",\"handedness\":\"Left\"},{\"first_name\":\"Colleen\",\"last_name\":\"Byington\",\"hire_date\":\"1979-12-23\",\"age\":\"36\",\"lucky_number\":\"23\",\"handedness\":\"Right\"},{\"first_name\":\"Daphene\",\"last_name\":\"Byington\",\"hire_date\":\"1936-08-12\",\"age\":\"80\",\"lucky_number\":\"5\",\"handedness\":\"Right\"}]}','2016-08-20 00:39:16','2016-08-21 23:21:52'),
	(5,4,20,1,'blah',NULL,'2016-08-21 22:40:23','0000-00-00 00:00:00'),
	(25,1,20,1,'____ghghghgh',NULL,'2016-09-12 15:37:56','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `page_data` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `page_layout_scripts` WRITE;
/*!40000 ALTER TABLE `page_layout_scripts` DISABLE KEYS */;

INSERT INTO `page_layout_scripts` (`id`, `page_layout_id`, `script_id`, `load_order`)
VALUES
	(60,1,4,1),
	(61,1,2,1),
	(62,1,6,1),
	(63,1,3,2),
	(64,1,5,1),
	(65,1,1,1),
	(66,5,3,0);

/*!40000 ALTER TABLE `page_layout_scripts` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `page_layouts` WRITE;
/*!40000 ALTER TABLE `page_layouts` DISABLE KEYS */;

INSERT INTO `page_layouts` (`id`, `author_user_id`, `name`, `description`, `content`, `created_at`, `updated_at`)
VALUES
	(1,1,'default','This is the default layout','<!doctype html>\r\n<html>\r\n<head>\r\n	<title>\r\n	{{#>title}}\r\n		{{~PAGE.title~}}\r\n	{{/title}}\r\n	</title>\r\n\r\n	{{#>meta}}\r\n		{{!-- Default MetaTags --}}\r\n		{{PAGE.meta}}\r\n	{{/meta}}\r\n\r\n	{{#>css}}\r\n		{{!-- Default CSS --}}\r\n		{{PAGE.css}}\r\n	{{/css}}\r\n\r\n	{{#>blocking_js}}\r\n		{{!-- Default Blocking JS --}}\r\n		{{PAGE.blocking_js}}\r\n	{{/blocking_js}}\r\n</head>\r\n<body>\r\n	{{#>header}}\r\n		{{>nav}}\r\n	{{/header}}\r\n	\r\n	{{#>body}}\r\n		{{!-- Default Body Content --}}\r\n	{{/body}}\r\n\r\n	{{#>footer}}\r\n		{{>footer}}\r\n	{{/footer}}\r\n\r\n	{{#>nonblocking_js}}\r\n		{{PAGE.nonblocking_js}}\r\n	{{/nonblocking_js}}\r\n</body>\r\n</html>','2016-06-22 21:47:20','2016-09-07 18:16:59'),
	(3,1,'header2','asdasd','asdasdads','2016-07-07 17:19:31','0000-00-00 00:00:00'),
	(4,1,'New Layout','This is a new layout',NULL,'2016-07-10 00:00:10','0000-00-00 00:00:00'),
	(5,7,'bob','',NULL,'2016-09-02 17:05:26','0000-00-00 00:00:00'),
	(6,7,'FiveColNoFooter','Who doesn\'t like 5 columns? Not this guy.','<!doctype html>\r\n<html>\r\n<head>\r\n	<title>\r\n	{{#>title}}\r\n		{{~PAGE.title~}}\r\n	{{/title}}\r\n	</title>\r\n\r\n	{{#>meta}}\r\n		{{!-- Default MetaTags --}}\r\n		{{PAGE.meta}}\r\n	{{/meta}}\r\n\r\n	{{#>css}}\r\n		{{!-- Default CSS --}}\r\n		{{PAGE.css}}\r\n	{{/css}}\r\n\r\n	{{#>blocking_js}}\r\n		{{!-- Default Blocking JS --}}\r\n		{{PAGE.blocking_js}}\r\n	{{/blocking_js}}\r\n</head>\r\n<body>\r\n	{{#>header}}\r\n		{{>nav}}\r\n	{{/header}}\r\n	\r\n	{{#>body}}\r\n		{{!-- Default Body Content --}}\r\n	{{/body}}\r\n\r\n	{{#>footer}}\r\n		{{>footer}}\r\n	{{/footer}}\r\n\r\n	{{#>nonblocking_js}}\r\n		{{PAGE.nonblocking_js}}\r\n	{{/nonblocking_js}}\r\n</body>\r\n</html>','2016-09-07 15:08:18','2016-09-07 18:16:46');

/*!40000 ALTER TABLE `page_layouts` ENABLE KEYS */;
UNLOCK TABLES;


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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author_user_id` (`author_user_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `page_versions_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `page_versions_ibfk_2` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `page_versions` WRITE;
/*!40000 ALTER TABLE `page_versions` DISABLE KEYS */;

INSERT INTO `page_versions` (`id`, `page_id`, `author_user_id`, `page_layout_id`, `percentage`, `title`, `contents`, `comments`, `is_publishable`, `created_at`, `updated_at`)
VALUES
	(1,1,1,1,50,'Home Page','Welcome to the Atlantic Client App.\r\n\r\n<a href=\"/new-test-page\">New Test Page</a>','This is the first version for the rollout',1,'2016-09-06 20:43:35','2016-09-12 15:42:35'),
	(2,1,1,1,50,'Home Page','Welcome to the Atlantic Client App.\r\n\r\n<a href=\"/new-test-page\">New Test Page</a>','This is an alternate version for the rollout',1,'2016-09-06 20:45:33','2016-09-15 20:11:24'),
	(10,1,1,1,0,'Home Page','Welcome to the Atlantic Client App.\r\n\r\n<a href=\"/new-test-page\">New Test Page</a>','This is the first version for the rollout',0,'2016-09-12 16:07:38','0000-00-00 00:00:00'),
	(11,1,1,1,0,'Home Page','Welcome to the Atlantic Client App.\r\n\r\n<a href=\"/new-test-page\">New Test Page</a>','This is the first version for the rollout',0,'2016-09-15 20:11:43','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `page_versions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `permalink` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `sort_order` bigint(20) unsigned NOT NULL DEFAULT '1',
  `is_publishable` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`permalink`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `author_user_id`, `permalink`, `name`, `sort_order`, `is_publishable`, `created_at`, `updated_at`, `published_at`)
VALUES
	(1,1,'/','Home Page',1,1,'2016-06-01 18:59:43','2016-09-10 01:13:06',NULL),
	(4,1,'/products/electric-toaster','Electric Toaster',1,1,'2016-06-23 20:41:56','2016-09-11 19:04:47',NULL),
	(5,7,'/products/bread-basket','Bread Basket',1,1,'2016-09-07 15:07:36','2016-09-11 19:04:40',NULL),
	(6,7,'/products','Products',1,1,'2016-09-07 18:18:49','2016-09-11 19:04:33',NULL),
	(7,1,'/features/the-watering-bowl','Featured Article',1,0,'2016-09-08 14:58:41','2016-09-11 19:04:11',NULL),
	(8,1,'/locations','Our Locations',1,0,'2016-09-08 14:58:41','2016-09-11 19:04:19',NULL),
	(9,1,'/locations/webster-groves','Webster Groves',1,0,'2016-09-08 14:58:41','2016-09-11 19:04:26',NULL),
	(10,1,'/features','Featured Article',1,0,'2016-09-08 14:58:41','2016-09-11 19:04:11',NULL),
	(22,1,'/dogs/henry','New Page',1,0,'2016-09-13 00:33:02','0000-00-00 00:00:00',NULL),
	(23,1,'/dogs/pippin','New Page',1,0,'2016-09-13 00:33:12','0000-00-00 00:00:00',NULL),
	(24,1,'/dogs','New Page',1,0,'2016-09-13 00:33:53','0000-00-00 00:00:00',NULL),
	(26,1,'/corey/wyatt','New Page',1,0,'2016-09-13 16:49:40','0000-00-00 00:00:00',NULL),
	(27,1,'/corey','New Page',1,0,'2016-09-13 16:50:43','0000-00-00 00:00:00',NULL),
	(28,1,'/test','New Page',1,0,'2016-09-13 16:53:22','0000-00-00 00:00:00',NULL),
	(29,1,'/corey/erin','New Page',1,0,'2016-09-13 16:53:53','0000-00-00 00:00:00',NULL),
	(34,1,'/demo/chris','New Page',1,0,'2016-09-15 20:12:28','0000-00-00 00:00:00',NULL),
	(35,1,'/demo','New Page',1,0,'2016-09-15 20:13:00','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


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

LOCK TABLES `scripts` WRITE;
/*!40000 ALTER TABLE `scripts` DISABLE KEYS */;

INSERT INTO `scripts` (`id`, `script_type_id`, `author_user_id`, `name`, `html`, `created_at`, `updated_at`)
VALUES
	(1,5,1,'Bootstrap CSS','<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" integrity=\"sha384-1q8mTJOASx8j1Au a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7\" crossorigin=\"anonymous\">\r\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css\" integrity=\"sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r\" crossorigin=\"anonymous\">','2016-07-03 00:24:16','2016-07-03 01:40:39'),
	(2,2,1,'Bootstrap JS','<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js\" integrity=\"sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS\" crossorigin=\"anonymous\"></script>','2016-07-03 17:40:14','2016-07-05 16:21:02'),
	(3,3,1,'jQuery','<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js\"></script>','2016-07-03 17:48:40','2016-07-05 16:20:18'),
	(4,1,1,'Sample META','<meta name=\"description\" content=\"I love the Atlantic CMS\">','2016-07-03 22:42:51','0000-00-00 00:00:00'),
	(5,4,1,'Sample Style','<style type=\"text/css\">\r\n.roses {color:red;}\r\n.violets {color:blue;}\r\n</style>','2016-07-03 22:43:17','0000-00-00 00:00:00'),
	(6,3,1,'demo','<script type=\"text/javascript\" src=\"javascripts.js\"></script>','2016-07-07 12:10:05','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `scripts` ENABLE KEYS */;
UNLOCK TABLES;


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
	(4,4,'James','Hendrix','jbyington+disabled@paradowski.com','$2y$10$O2omz5AOrHF.e9LAjYiSzedpz4zb6DcQdAFzIDEaJKmF6Mqz2ShMG','Genius',NULL,'2016-08-21 23:00:33','2016-05-10 23:52:43',0),
	(7,1,'Jake','Wood','jwood@paradowski.com','$2y$10$diIHUHjkseSMJq5ntj.Nm.x8HwiZMUmY9NNIBHHDg8qKPrcoqwWz6','Esq.',NULL,'0000-00-00 00:00:00','2016-08-26 12:19:52',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;




# Replace placeholder table for deployable_page_layouts with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_page_layouts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_page_layouts`
AS SELECT
   `pl`.`id` AS `page_layout_id`,
   `pl`.`content` AS `content`
FROM (`page_layouts` `pl` join `deployable_pages` `dp` on((`dp`.`page_layout_id` = `pl`.`id`))) group by `dp`.`page_layout_id`;


# Replace placeholder table for deployable_components with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_components`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_components`
AS SELECT
   `c`.`name` AS `name`,
   `c`.`html` AS `html`,
   `c`.`css` AS `css`,
   `c`.`js` AS `js`
FROM `components` `c`;


# Replace placeholder table for deployable_pages with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_pages`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_pages`
AS SELECT
   `p`.`permalink` AS `permalink`,
   `p`.`id` AS `page_id`,
   `pv`.`page_layout_id` AS `page_layout_id`,
   `pv`.`percentage` AS `percentage`,
   `pv`.`title` AS `title`,
   `pv`.`contents` AS `contents`
FROM (`pages` `p` join `page_versions` `pv` on(((`pv`.`page_id` = `p`.`id`) and (`pv`.`is_publishable` = 1)))) where (`p`.`is_publishable` = 1);


# Replace placeholder table for deployable_page_data with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_page_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_page_data`
AS SELECT
   `pd`.`id` AS `page_data_id`,
   `pd`.`page_id` AS `page_id`,
   `pd`.`reference_name` AS `reference_name`,
   `pd`.`content` AS `content`
FROM (`page_data` `pd` join `deployable_pages` `dp` on((`dp`.`page_id` = `pd`.`page_id`))) group by `pd`.`id`;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
