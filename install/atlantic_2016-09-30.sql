# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 45.55.40.232 (MySQL 5.5.5-10.1.10-MariaDB)
# Database: atlantic
# Generation Time: 2016-09-30 18:46:57 +0000
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `components_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;

INSERT INTO `components` (`id`, `author_user_id`, `uuid`, `name`, `description`, `html`, `css`, `js`, `nonblocking_js`, `created_at`, `updated_at`)
VALUES
	(1,1,'cf6224bd4-842e-11e6-9506-04019a288d01','header','This is the header for the site','<div class=\"jumbotron\">\r\n  <h1>Hello, world!</h1>\r\n</div>','','','','2016-05-19 18:18:52','2016-09-30 12:38:40'),
	(7,1,'cf6225263-842e-11e6-9506-04019a288d01','footer','The Footer','<footer>\r\n    <div>i\'m the fucking footer</div>\r\n</footer>',NULL,NULL,NULL,'2016-09-23 17:15:59','2016-09-29 19:23:19'),
	(8,1,'cf6225428-842e-11e6-9506-04019a288d01','button','standard button','<button class=\"{{ class }}\" type=\"{{ type }}\">{{ value }}</button>','border:1px solid orange;',NULL,NULL,'2016-09-24 00:35:16','2016-09-30 11:37:02'),
	(9,1,'cf62254d3-842e-11e6-9506-04019a288d01','a','Anchor Tag','<a {{~#if class}} class=\"{{ class }}\"{{/if~}} {{~#if target}} target=\"{{ target }}\"{{/if~}} {{~#if href}} href=\"{{ href }}\"{{/if~}} >{{ text }}</a>','display:flex;\r\na {\r\n    font-size:4em;\r\n    color:blue;\r\n    border:1px solid red;\r\n    margin:4px;\r\n    padding:4px;\r\n}',NULL,'','2016-09-24 00:36:17','2016-09-30 11:37:24'),
	(20,1,'c46168939-8727-11e6-9506-04019a288d01','team_member_table','table wrapper for team members','<h1>{{ name }}</h1>\r\n<table class=\"table table-bordered table-hover\">\r\n    <thead>\r\n        <tr>\r\n            <th>First Name</th>\r\n            <th>Last Name</th>\r\n            <th>Hire Date</th>\r\n            <th>Age</th>\r\n            <th>Lucky Number</th>\r\n            <th>Handedness</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        {{#each members}}\r\n            <tr>\r\n                <td>{{ first_name }}</td>\r\n                <td>{{ last_name }}</td>\r\n                <td>{{ hire_date }}</td>\r\n                <td>{{ age }}</td>\r\n                <td>{{ lucky_number }}</td>\r\n                <td>{{ handedness }}</td>\r\n            </tr>\r\n        {{/each}}\r\n    </tbody>\r\n</table>',NULL,NULL,NULL,'2016-09-30 12:02:23','2016-09-30 12:44:23');

/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`%` */ /*!50003 TRIGGER `before_insert_components` BEFORE INSERT ON `components` FOR EACH ROW SET new.uuid = concat('c',uuid()) */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


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
	(4,'Staging','mysql','45.55.40.232','3306','atlantic_runtime','root','*T3mp3st!','Staging!');

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
	(21,1,'Repeater Example','{\r\n    \"name\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"Team Valour\",\r\n        \"label\": \"Team name\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    },\r\n    \"members\":{\r\n        \"type\":\"repeater\",\r\n        \"label\":\"Team members\",\r\n        \"fields\":{\r\n            \"first_name\":{ \r\n                \"type\":\"text\", \r\n                \"placeholder\":\"First Name\",\r\n                \"label\": \"First Name\",\r\n                \"default\": \"\",\r\n                \"required\":true\r\n            },\r\n            \"last_name\":{ \r\n                \"type\":\"text\", \r\n                \"placeholder\":\"Last Name\",\r\n                \"label\": \"Last Name\",\r\n                \"default\": \"\",\r\n                \"required\":true\r\n            },\r\n            \"hire_date\":{ \r\n                \"type\":\"date\", \r\n                \"label\": \"Hire Date\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"age\":{ \r\n                \"type\":\"number\", \r\n                \"placeholder\":\"21\",\r\n                \"label\": \"Age\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"lucky_number\":{ \r\n                \"type\":\"number\", \r\n                \"placeholder\":\"5\",\r\n                \"label\": \"Lucky Number\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"handedness\":{\r\n                \"type\":\"select\", \r\n                \"label\": \"Handedness\",\r\n                \"default\": \"\",\r\n                \"multiple\": false,\r\n                \"options\":[\r\n                    {\"label\":\"Left\", \"value\":\"Left\"},\r\n                    {\"label\":\"Right\", \"value\":\"Right\"},\r\n                    {\"label\":\"Both\", \"value\":\"Both\"},\r\n                    {\"label\":\"Neither\", \"value\":\"Neither\"}\r\n                ],\r\n                \"required\":true\r\n            }\r\n        }\r\n    }\r\n}','2016-08-20 00:31:58','2016-08-21 23:21:42'),
	(22,1,'Anchor Tag','{\r\n    \"href\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"href\",\r\n        \"label\": \"href\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    },\r\n    \"text\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"text\",\r\n        \"label\": \"text\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    }\r\n}','2016-09-26 16:20:57','2016-09-26 16:22:00');

/*!40000 ALTER TABLE `datatypes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table deployable_components
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_components`;

CREATE TABLE `deployable_components` (
   `name` VARCHAR(100) NOT NULL DEFAULT '',
   `html` MEDIUMTEXT NULL DEFAULT NULL,
   `css` MEDIUMTEXT NULL DEFAULT NULL,
   `js` MEDIUMTEXT NULL DEFAULT NULL,
   `nonblocking_js` MEDIUMTEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_layouts
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_layouts`;

CREATE TABLE `deployable_layouts` (
   `id` BIGINT(20) UNSIGNED NULL DEFAULT '0',
   `layout_name` VARCHAR(107) NULL DEFAULT NULL,
   `content` TEXT NULL DEFAULT NULL,
   `meta` TEXT NULL DEFAULT NULL,
   `js` TEXT NULL DEFAULT NULL,
   `nonblocking_js` TEXT NULL DEFAULT NULL,
   `style` TEXT NULL DEFAULT NULL
) ENGINE=MyISAM;



# Dump of table deployable_page_data
# ------------------------------------------------------------

DROP VIEW IF EXISTS `deployable_page_data`;

CREATE TABLE `deployable_page_data` (
   `page_id` BIGINT(20) UNSIGNED NOT NULL,
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



# Dump of table helpers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `helpers`;

CREATE TABLE `helpers` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(200) DEFAULT '',
  `content` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `helpers_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `helpers` WRITE;
/*!40000 ALTER TABLE `helpers` DISABLE KEYS */;

INSERT INTO `helpers` (`id`, `author_user_id`, `name`, `description`, `content`, `created_at`, `updated_at`)
VALUES
	(1,1,'button','',NULL,'2016-09-24 22:34:22','0000-00-00 00:00:00'),
	(2,1,'anchor','A helper to make anchor tags','function( $opt ){\r\n    return \"{{>a $opt }}\";\r\n}','2016-09-24 22:35:27','2016-09-26 16:32:48');

/*!40000 ALTER TABLE `helpers` ENABLE KEYS */;
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
	(3,1,20,1,'test2','{\"name\":\"Josh Byington\",\"age\":\"36\",\"color\":\"#8efa00\",\"date\":\"1980-05-25\",\"email\":\"joshua.d.byington@gmail.com\",\"gender\":[\"M\"],\"role\":[\"1\"],\"food\":[\"Spaghetti\",\"Burrito\"],\"hear_about\":[\"Mail\",\"Facebook\",\"Twitter\",\"CNN\",\"Newspaper\"],\"comment\":\"\"}','2016-08-18 18:43:37','2016-08-20 00:19:06'),
	(4,1,21,1,'repeat','{\"name\":\"Team Kickass\",\"members\":[{\"first_name\":\"Josh\",\"last_name\":\"Byington\",\"hire_date\":\"1980-05-25\",\"age\":\"36\",\"lucky_number\":\"525\",\"handedness\":\"Right\"},{\"first_name\":\"Jeremy\",\"last_name\":\"Byington\",\"hire_date\":\"1982-05-10\",\"age\":\"34\",\"lucky_number\":\"57\",\"handedness\":\"Left\"},{\"first_name\":\"Colleen\",\"last_name\":\"Byington\",\"hire_date\":\"1979-12-23\",\"age\":\"36\",\"lucky_number\":\"23\",\"handedness\":\"Right\"},{\"first_name\":\"Daphene\",\"last_name\":\"Byington\",\"hire_date\":\"1936-08-12\",\"age\":\"80\",\"lucky_number\":\"5\",\"handedness\":\"Right\"}]}','2016-08-20 00:39:16','2016-08-21 23:21:52'),
	(26,1,22,1,'my_a','{\"href\":\"\\/about\",\"text\":\"This is my anchor tag\"}','2016-09-26 16:22:18','2016-09-26 16:22:31');

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
	(75,1,8,1),
	(76,1,11,1),
	(77,1,10,1),
	(78,1,7,2);

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
	(1,1,'default','This is the default layout','<!doctype html>\r\n<html>\r\n    <meta charset=\"utf-8\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\r\n    <head>\r\n        {{#>meta}}{{/meta}}\r\n    	<title>\r\n    	    {{#>title}}\r\n    	        There is no title\r\n    	    {{/title}}\r\n    	</title>\r\n    	\r\n    	{{#>css}}{{/css}}\r\n    	{{#>js}}{{/js}}\r\n    	\r\n    </head>\r\n    <body>\r\n    	<div class=\"containter\">\r\n    	    <div class=\"row\">\r\n    	        <div class=\"col-md-12\">\r\n    	            {{>header}}\r\n    	        </div>\r\n    	    </div>\r\n            <div class=\"row\">\r\n    	        <div class=\"col-lg-12\">\r\n                    {{#>contents}}\r\n        	             Ya done goofed\r\n                    {{/contents}}  \r\n    	        </div>\r\n    	    </div>\r\n    	    <div class=\"row\">\r\n    	        <div class=\"col-md-12\">\r\n    	            {{>footer}}\r\n    	        </div>\r\n    	    </div>\r\n    	</div>\r\n    	{{#>nonblocking_js}}{{/nonblocking_js}}\r\n    </body>\r\n</html>','2016-06-22 21:47:20','2016-09-30 14:37:36'),
	(7,1,'climate','The climate.com layout','<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <meta charset=\'utf-8\'>\r\n	<title>\r\n		Climate | {{#>title }}{{/title }}\r\n	</title>\r\n\r\n	<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\" />\r\n\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cloud.typography.com/7509932/6863752/css/fonts.css\" />\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"http://redesign.climate.parado.cz/main.css\">\r\n\r\n	{{#>js }}{{/js }}\r\n</head>\r\n\r\n<body class=\"\">\r\n	<section id=\"page\">\r\n		{{>climate_header }}\r\n\r\n        {{>climate_subheader }}\r\n\r\n        {{#>contents }}Nothing here!{{/contents }}\r\n\r\n        {{>climate_footer }}\r\n	</section>\r\n\r\n	<script type=\"text/javascript\" src=\"/main.js\"></script>\r\n\r\n	{{#>nonblocking_js }}{{/nonblocking_js }}\r\n</body>\r\n</html>','2016-09-24 01:26:03','2016-09-24 01:46:58');

/*!40000 ALTER TABLE `page_layouts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table page_version_preview
# ------------------------------------------------------------

DROP VIEW IF EXISTS `page_version_preview`;

CREATE TABLE `page_version_preview` (
   `page_version_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `page_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `layout_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `permalink` VARCHAR(255) NULL DEFAULT NULL,
   `title` VARCHAR(255) NOT NULL DEFAULT '',
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
	(1,1,1,1,50,'Home Page','<h1>Welcome to the Home Page, {{ Get.name }}!</h1>\r\n\r\n{{>a Data.my_a }}\r\n\r\n{{>a href=\"/about2\" text=\"This sucks\" class=\"btn btn-success\" }}\r\n\r\n\r\n{{>team_member_table Data.repeat }}','This is the first version for the rollout',1,'2016-09-06 20:43:35','2016-09-30 12:07:35'),
	(13,4,1,1,0,'About this CMS','<h1>Welcome to the About Page!</h1>\r\n\r\n{{>button button_value=\"I\'m a button!\"}}\r\n\r\n{{>a a_href=\"/\" a_text=\"Go Home!\"}}','Default copy describing the CMS',1,'2016-09-24 00:33:52','2016-09-24 00:55:02'),
	(14,40,1,7,0,'Climate test','This is the climate test','New Page Version',0,'2016-09-24 01:36:08','2016-09-24 01:36:31');

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
	(1,1,'/','Home Page',1,1,'2016-06-01 18:59:43','2016-09-21 18:35:38',NULL),
	(4,1,'/about','About',1,1,'2016-06-23 20:41:56','2016-09-24 00:33:39',NULL),
	(40,1,'/climate-test','New Page',1,1,'2016-09-24 01:35:59','2016-09-24 01:36:03',NULL);

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
	(4,'Style','<style type=\"text/css\">\n.roses {color:red;}\n.violets {color:blue;}\n</style>');

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
  `html` longtext,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `scripts` WRITE;
/*!40000 ALTER TABLE `scripts` DISABLE KEYS */;

INSERT INTO `scripts` (`id`, `script_type_id`, `author_user_id`, `name`, `html`, `created_at`, `updated_at`)
VALUES
	(7,4,1,'components.css','<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/components.css\">','2016-09-27 12:36:25','2016-09-27 12:37:09'),
	(8,2,1,'jquery','<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js\"></script>','2016-09-27 18:20:53','0000-00-00 00:00:00'),
	(10,4,1,'bootstrap3','<!-- Latest compiled and minified CSS -->\r\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">\r\n\r\n<!-- Optional theme -->\r\n<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css\" integrity=\"sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp\" crossorigin=\"anonymous\">\r\n','2016-09-30 12:34:47','0000-00-00 00:00:00'),
	(11,3,1,'bootstrap3','<!-- Latest compiled and minified JavaScript -->\r\n<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\" integrity=\"sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa\" crossorigin=\"anonymous\"></script>','2016-09-30 12:35:06','0000-00-00 00:00:00');

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
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `password`, `title`, `updated_at`, `created_at`, `is_active`)
VALUES
	(1,1,'Joshua','Byington','jbyington@paradowski.com','$2y$10$Vj6Wq64MsoNrujkHHztno.a3NzqEph/rhG3x9B38i5xOAWOgZ1qMK','Director of Development','2016-05-08 01:55:37','2016-04-27 16:59:58',1),
	(2,2,'Jim','Croche','jbyington+editor@paradowski.com','$2y$10$qu2FOYe4fnylKfDc1QS1yOKY9.5vwEI98vJVT0Hl0r8wAZPTIyKKS','Master Guitarist and Vocalist','2016-05-31 18:19:31','2016-05-10 23:26:26',1),
	(3,3,'Cat','Stevens','jbyington+author@paradowski.com','$2y$10$RrSjdbpND0EB4/pzTRJ9uO9KMrV0XHg84Ly0IxxXkGRV1i9Tv6f36','Conductor, Peace Train','2016-05-19 12:14:04','2016-05-10 23:51:42',1),
	(4,4,'James','Hendrix','jbyington+disabled@paradowski.com','$2y$10$O2omz5AOrHF.e9LAjYiSzedpz4zb6DcQdAFzIDEaJKmF6Mqz2ShMG','Genius','2016-08-21 23:00:33','2016-05-10 23:52:43',0),
	(7,1,'Jake','Wood','jwood@paradowski.com','$2y$10$diIHUHjkseSMJq5ntj.Nm.x8HwiZMUmY9NNIBHHDg8qKPrcoqwWz6','Esq.','0000-00-00 00:00:00','2016-08-26 12:19:52',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;




# Replace placeholder table for deployable_layouts with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_layouts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_layouts`
AS SELECT
   `pl`.`id` AS `id`,concat('layout_',`pl`.`name`) AS `layout_name`,
   `pl`.`content` AS `content`,group_concat(`s1`.`html` separator ' ') AS `meta`,group_concat(`s2`.`html` separator ' ') AS `js`,group_concat(`s3`.`html` separator ' ') AS `nonblocking_js`,group_concat(`s4`.`html` separator ' ') AS `style`
FROM (((((`page_layout_scripts` `pls` left join `page_layouts` `pl` on((`pl`.`id` = `pls`.`page_layout_id`))) left join `scripts` `s1` on(((`s1`.`id` = `pls`.`script_id`) and (`s1`.`script_type_id` = 1)))) left join `scripts` `s2` on(((`s2`.`id` = `pls`.`script_id`) and (`s2`.`script_type_id` = 2)))) left join `scripts` `s3` on(((`s3`.`id` = `pls`.`script_id`) and (`s3`.`script_type_id` = 3)))) left join `scripts` `s4` on(((`s4`.`id` = `pls`.`script_id`) and (`s4`.`script_type_id` = 4)))) order by `pls`.`load_order`;


# Replace placeholder table for deployable_components with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_components`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_components`
AS SELECT
   `c`.`name` AS `name`,concat('<div class="',`c`.`uuid`,' component_',`c`.`name`,'">',`c`.`html`,'</div>') AS `html`,concat('.',`c`.`uuid`,'{',`c`.`css`,'}') AS `css`,concat('(FUNCTION(uuid){',`c`.`js`,'})("',`c`.`uuid`,'")') AS `js`,concat('(function(uuid){',`c`.`nonblocking_js`,'})("',`c`.`uuid`,'")') AS `nonblocking_js`
FROM `components` `c`;


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
FROM ((`pages` `p` join `page_versions` `pv` on((`pv`.`page_id` = `p`.`id`))) join `page_layouts` `pl` on((`pl`.`id` = `pv`.`page_layout_id`)));


# Replace placeholder table for deployable_page_data with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_page_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `deployable_page_data`
AS SELECT
   `pd`.`page_id` AS `page_id`,concat('page_',`pd`.`page_id`) AS `page`,
   `pd`.`reference_name` AS `reference_name`,
   `pd`.`content` AS `content`
FROM (`page_data` `pd` join `deployable_pages` `dp` on((`dp`.`page` = concat('page_',`pd`.`page_id`)))) group by `pd`.`id`;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
