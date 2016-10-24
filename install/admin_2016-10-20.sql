# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Generation Time: 2016-10-20 15:31:31 +0000
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `components_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;

INSERT INTO `components` (`id`, `author_user_id`, `uuid`, `name`, `description`, `html`, `css`, `js`, `nonblocking_js`, `created_at`, `updated_at`)
VALUES
	(8,1,'cf6225428-842e-11e6-9506-04019a288d01','button','standard button','<button {{~#if class}} class=\"{{ class }}\"{{/if~}} {{~#if type}} class=\"{{ type }}\"{{/if~}}>{{ value }}</button>','border:1px solid orange;',NULL,NULL,'2016-09-24 00:35:16','2016-10-19 23:58:40'),
	(9,1,'cf62254d3-842e-11e6-9506-04019a288d01','a','Anchor Tag','<a {{~#if class}} class=\"{{ class }}\"{{/if~}} {{~#if target}} target=\"{{ target }}\"{{/if~}} {{~#if href}} href=\"{{ href }}\"{{/if~}} >{{ text }}</a>','display:flex;\r\na {\r\n    font-size:4em;\r\n    color:red;\r\n    border:1px solid red;\r\n    margin:4px;\r\n    padding:4px;\r\n}',NULL,'','2016-09-24 00:36:17','2016-10-18 14:47:58'),
	(20,1,'c46168939-8727-11e6-9506-04019a288d01','team_member_table','table wrapper for team members','<h1>{{ name }}</h1>\r\n<table class=\"table table-bordered table-hover\">\r\n    <thead>\r\n        <tr>\r\n            <th>First Name</th>\r\n            <th>Last Name</th>\r\n            <th>Hire Date</th>\r\n            <th>Age</th>\r\n            <th>Lucky Number</th>\r\n            <th>Handedness</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        {{#each members}}\r\n            <tr>\r\n                <td>{{ first_name }}</td>\r\n                <td>{{ last_name }}</td>\r\n                <td>{{ hire_date }}</td>\r\n                <td>{{ age }}</td>\r\n                <td>{{ lucky_number }}</td>\r\n                <td>{{ handedness }}</td>\r\n            </tr>\r\n        {{/each}}\r\n    </tbody>\r\n</table>',NULL,NULL,NULL,'2016-09-30 12:02:23','2016-09-30 12:44:23');

/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_insert_components` BEFORE INSERT ON `components` FOR EACH ROW SET new.uuid = concat('c',uuid()),
new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_update_components` BEFORE UPDATE ON `components` FOR EACH ROW SET new.updated_at = now() */;;
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `collection_name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `datatypes_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `datatypes` WRITE;
/*!40000 ALTER TABLE `datatypes` DISABLE KEYS */;

INSERT INTO `datatypes` (`id`, `author_user_id`, `name`, `content`, `created_at`, `updated_at`)
VALUES
	(20,1,'form example','{\r\n    \"name\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"Name\",\r\n        \"label\": \"Name\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    },\r\n    \"age\":{ \r\n        \"type\":\"number\", \r\n        \"placeholder\":\"21\",\r\n        \"label\": \"Age\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"color\":{ \r\n        \"type\":\"color\", \r\n        \"placeholder\":\"\",\r\n        \"label\": \"Favorite Color\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"date\":{ \r\n        \"type\":\"date\", \r\n        \"placeholder\":\"\",\r\n        \"label\": \"Favorite Date\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"email\":{ \r\n        \"type\":\"email\", \r\n        \"placeholder\":\"atlantic@puffin.pinguinio.com\",\r\n        \"label\": \"Email Address\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"gender\":{ \r\n        \"type\":\"radio\", \r\n        \"options\":[\r\n            {\"label\":\"Male\", \"value\":\"M\"},\r\n            {\"label\":\"Female\", \"value\":\"F\"},\r\n            {\"label\":\"Both\", \"value\":\"B\"},\r\n            {\"label\":\"Neither\", \"value\":\"N\"},\r\n            {\"label\":\"Other\", \"value\":\"O\"}\r\n        ],\r\n        \"label\": \"Gender\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    },\r\n    \"role\":{\r\n        \"type\":\"select\", \r\n        \"label\": \"Role\",\r\n        \"default\": \"\",\r\n        \"multiple\": false,\r\n        \"options\":[\r\n            {\"label\":\"Standard\", \"value\":0},\r\n            {\"label\":\"Admin\", \"value\":1},\r\n            {\"label\":\"Superadmin\", \"value\":2}\r\n        ],\r\n        \"required\":false\r\n    },\r\n    \"food\":{\r\n        \"type\":\"select\", \r\n        \"label\": \"Food I Like\",\r\n        \"default\": \"\",\r\n        \"multiple\": true,\r\n        \"options\":[\r\n            {\"label\":\"Spaghetti\", \"value\":\"Spaghetti\"},\r\n            {\"label\":\"Pizza\", \"value\":\"Pizza\"},\r\n            {\"label\":\"Ice Cream\", \"value\":\"Ice Cream\"},\r\n            {\"label\":\"Burrito\", \"value\":\"Burrito\"}\r\n        ],\r\n        \"required\":false\r\n    },\r\n    \"hear_about\":{\r\n        \"type\":\"checkbox\",\r\n        \"label\": \"How did you hear about us?\",\r\n        \"options\":[\r\n            {\"label\":\"Mail\", \"value\":\"Mail\"},\r\n            {\"label\":\"Facebook\", \"value\":\"Facebook\"},\r\n            {\"label\":\"Twitter\", \"value\":\"Twitter\"},\r\n            {\"label\":\"CNN\", \"value\":\"CNN\"},\r\n            {\"label\":\"Newspaper\", \"value\":\"Newspaper\"}\r\n        ],\r\n        \"value\": \"true\"\r\n    },\r\n    \"comment\":{ \r\n        \"type\":\"textarea\", \r\n        \"placeholder\":\"Add a comment\",\r\n        \"label\": \"Comment\",\r\n        \"default\": \"\",\r\n        \"required\":false\r\n    }\r\n}','2016-08-17 14:04:59','2016-08-20 00:19:20'),
	(21,1,'Repeater Example','{\r\n    \"name\":{ \r\n        \"type\":\"text\", \r\n        \"placeholder\":\"Team Valour\",\r\n        \"label\": \"Team name\",\r\n        \"default\": \"\",\r\n        \"required\":true\r\n    },\r\n    \"members\":{\r\n        \"type\":\"repeater\",\r\n        \"label\":\"Team members\",\r\n        \"fields\":{\r\n            \"first_name\":{ \r\n                \"type\":\"text\", \r\n                \"placeholder\":\"First Name\",\r\n                \"label\": \"First Name\",\r\n                \"default\": \"\",\r\n                \"required\":true\r\n            },\r\n            \"last_name\":{ \r\n                \"type\":\"text\", \r\n                \"placeholder\":\"Last Name\",\r\n                \"label\": \"Last Name\",\r\n                \"default\": \"\",\r\n                \"required\":true\r\n            },\r\n            \"hire_date\":{ \r\n                \"type\":\"date\", \r\n                \"label\": \"Hire Date\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"age\":{ \r\n                \"type\":\"number\", \r\n                \"placeholder\":\"21\",\r\n                \"label\": \"Age\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"lucky_number\":{ \r\n                \"type\":\"number\", \r\n                \"placeholder\":\"5\",\r\n                \"label\": \"Lucky Number\",\r\n                \"default\": \"\",\r\n                \"required\":false\r\n            },\r\n            \"handedness\":{\r\n                \"type\":\"select\", \r\n                \"label\": \"Handedness\",\r\n                \"default\": \"\",\r\n                \"multiple\": false,\r\n                \"options\":[\r\n                    {\"label\":\"Left\", \"value\":\"Left\"},\r\n                    {\"label\":\"Right\", \"value\":\"Right\"},\r\n                    {\"label\":\"Both\", \"value\":\"Both\"},\r\n                    {\"label\":\"Neither\", \"value\":\"Neither\"}\r\n                ],\r\n                \"required\":true\r\n            }\r\n        }\r\n    }\r\n}','2016-08-20 00:31:58','2016-08-21 23:21:42');

/*!40000 ALTER TABLE `datatypes` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_datatypes_insert` BEFORE INSERT ON `datatypes` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_datatypes_update` BEFORE UPDATE ON `datatypes` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


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
   `id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '0',
   `layout_name` VARCHAR(107) NOT NULL DEFAULT '',
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

LOCK TABLES `helpers` WRITE;
/*!40000 ALTER TABLE `helpers` DISABLE KEYS */;

INSERT INTO `helpers` (`id`, `author_user_id`, `name`, `description`, `content`, `created_at`, `updated_at`)
VALUES
	(1,1,'button','',NULL,'2016-09-24 22:34:22','0000-00-00 00:00:00'),
	(2,1,'anchor','A helper to make anchor tags','function( $opt ){\r\n    return \"{{>a $opt }}\";\r\n}','2016-09-24 22:35:27','2016-09-26 16:32:48');

/*!40000 ALTER TABLE `helpers` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_helpers_insert` BEFORE INSERT ON `helpers` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_helpers_update` BEFORE UPDATE ON `helpers` FOR EACH ROW set new.updated_at = now() */;;
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
  KEY `page_id` (`page_id`),
  KEY `datatype_id` (`datatype_id`),
  CONSTRAINT `page_data_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `page_data_ibfk_2` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `page_data_ibfk_3` FOREIGN KEY (`datatype_id`) REFERENCES `datatypes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_page_data_insert` BEFORE INSERT ON `page_data` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_page_data_update` BEFORE UPDATE ON `page_data` FOR EACH ROW set new.updated_at = now() */;;
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `author_user_id` (`author_user_id`),
  CONSTRAINT `page_layouts_ibfk_1` FOREIGN KEY (`author_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `page_layouts` WRITE;
/*!40000 ALTER TABLE `page_layouts` DISABLE KEYS */;

INSERT INTO `page_layouts` (`id`, `author_user_id`, `name`, `description`, `content`, `created_at`, `updated_at`)
VALUES
	(1,1,'default','This is the default layout','<!doctype html>\r\n<html>\r\n    <meta charset=\"utf-8\">\r\n    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\r\n    <head>\r\n        {{#>meta}}{{/meta}}\r\n    	<title>\r\n    	    {{#>title}}\r\n    	        There is no title\r\n    	    {{/title}}\r\n    	</title>\r\n    	\r\n    	{{#>css}}{{/css}}\r\n    	{{#>js}}{{/js}}\r\n    	\r\n    </head>\r\n    <body>\r\n    	<div class=\"containter\">\r\n    	    <div class=\"row\">\r\n    	        <div class=\"col-md-12\">\r\n    	            {{>header}}\r\n    	        </div>\r\n    	    </div>\r\n            <div class=\"row\">\r\n    	        <div class=\"col-lg-12\">\r\n                    {{#>contents}}\r\n        	             Ya done goofed\r\n                    {{/contents}}  \r\n    	        </div>\r\n    	    </div>\r\n    	    <div class=\"row\">\r\n    	        <div class=\"col-md-12\">\r\n    	            {{>footer}}\r\n    	        </div>\r\n    	    </div>\r\n    	</div>\r\n    	{{#>nonblocking_js}}{{/nonblocking_js}}\r\n    </body>\r\n</html>','2016-06-22 21:47:20','2016-09-30 14:37:36');

/*!40000 ALTER TABLE `page_layouts` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_page_layouts_insert` BEFORE INSERT ON `page_layouts` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_page_layouts_update` BEFORE UPDATE ON `page_layouts` FOR EACH ROW set new.updated_at = now() */;;
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

LOCK TABLES `page_versions` WRITE;
/*!40000 ALTER TABLE `page_versions` DISABLE KEYS */;

INSERT INTO `page_versions` (`id`, `page_id`, `author_user_id`, `page_layout_id`, `percentage`, `title`, `contents`, `comments`, `is_publishable`, `created_at`, `updated_at`)
VALUES
	(18,1,1,1,100,'New Page Version','<h1>Welcome, {{Get.name}}</h1>\r\n\r\n{{>a href=\"/\" text=\"Home\" target=\"_blank\"}}\r\n\r\n{{> team_member_table Page.producers }}\r\n\r\n{{#each Site.newsroom }}\r\n    <h2>{{.}}</h2>\r\n{{/each}}','For Monsanto Pollinator Week',1,'2016-10-10 12:22:42','2016-10-19 23:55:34'),
	(19,65,1,1,0,'New Page Version','ABout!','New Page Version',0,'2016-10-10 16:45:52','2016-10-10 17:04:58'),
	(23,102,1,1,0,'New Page Version','','New Page Version',0,'2016-10-18 15:18:32','2016-10-18 15:20:17');

/*!40000 ALTER TABLE `page_versions` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_page_versions_insert` BEFORE INSERT ON `page_versions` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_page_version_update` BEFORE UPDATE ON `page_versions` FOR EACH ROW set new.updated_at = now() */;;
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

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;

INSERT INTO `pages` (`id`, `author_user_id`, `permalink`, `name`, `sort_order`, `is_publishable`, `created_at`, `updated_at`, `published_at`)
VALUES
	(1,1,'/','Home Page',1,1,'2016-06-01 18:59:43','2016-10-10 16:41:06',NULL),
	(50,1,'/partners','New Page',1,0,'2016-10-10 12:12:51','2016-10-10 12:38:26',NULL),
	(51,1,'/partners/platform-partners','New Page',1,0,'2016-10-10 12:13:16','2016-10-10 12:38:25',NULL),
	(52,1,'/partners/integration-guidelines','New Page',1,0,'2016-10-10 12:13:32','2016-10-10 12:38:23',NULL),
	(53,1,'/pricing','New Page',1,0,'2016-10-10 12:13:43','2016-10-10 12:38:22',NULL),
	(54,1,'/support','New Page',1,0,'2016-10-10 12:13:53','2016-10-10 12:38:22',NULL),
	(55,1,'/climate-insights','New Page',1,0,'2016-10-10 12:14:02','2016-10-10 12:38:20',NULL),
	(56,1,'/features','New Page',1,0,'2016-10-10 12:14:14','2016-10-10 12:38:19',NULL),
	(57,1,'/features/data-connectivity','New Page',1,0,'2016-10-10 12:14:32','2016-10-10 12:38:17',NULL),
	(59,1,'/features/data-visualization','New Page',1,0,'2016-10-10 12:15:33','2016-10-10 12:38:16',NULL),
	(60,1,'/features/field-health-imagery','New Page',1,0,'2016-10-10 12:15:57','2016-10-10 12:38:15',NULL),
	(61,1,'/features/scouting','New Page',1,0,'2016-10-10 12:16:07','2016-10-10 12:38:14',NULL),
	(62,1,'/features/yeild-analysis','New Page',1,0,'2016-10-10 12:16:22','2016-10-10 12:38:13',NULL),
	(63,1,'/features/auto-and-manual-scripting','New Page',1,0,'2016-10-10 12:16:43','2016-10-10 12:38:12',NULL),
	(64,1,'/features/nitrogen-monitoring','New Page',1,0,'2016-10-10 12:16:57','2016-10-10 12:38:11',NULL),
	(65,1,'/about','New Page',1,0,'2016-10-10 12:17:12','2016-10-10 17:05:05',NULL),
	(66,1,'/about/leadership','New Page',1,0,'2016-10-10 12:17:27','2016-10-10 12:38:09',NULL),
	(67,1,'/about/newsroom','New Page',1,0,'2016-10-10 12:17:36','2016-10-10 12:38:08',NULL),
	(68,1,'/about/contact','New Page',1,0,'2016-10-10 12:17:43','2016-10-10 12:38:07',NULL),
	(69,1,'/careers','New Page',1,0,'2016-10-10 12:17:52','2016-10-10 12:38:06',NULL),
	(70,1,'/newsroom','New Page',1,0,'2016-10-10 12:18:03','2016-10-10 12:38:05',NULL),
	(72,1,'/legal','New Page',1,0,'2016-10-10 12:18:31','2016-10-10 12:38:03',NULL),
	(73,1,'/legal/disclaimer','New Page',1,0,'2016-10-10 12:18:41','2016-10-10 12:38:02',NULL),
	(74,1,'/legal/end-user-license-agreement','New Page',1,0,'2016-10-10 12:18:59','2016-10-10 12:38:01',NULL),
	(75,1,'/legal/privacy-policy','New Page',1,0,'2016-10-10 12:19:13','2016-10-10 12:37:59',NULL),
	(76,1,'/legal/privacy-policy-faq','New Page',1,0,'2016-10-10 12:19:30','2016-10-10 12:37:58',NULL),
	(77,1,'/legal/privacy-policy-products','New Page',1,0,'2016-10-10 12:20:48','2016-10-10 12:37:57',NULL),
	(78,1,'/legal/state-licenses','New Page',1,0,'2016-10-10 12:21:13','2016-10-10 12:37:56',NULL),
	(79,1,'/legal/terms-of-use','New Page',1,0,'2016-10-10 12:21:25','2016-10-10 12:37:55',NULL),
	(80,1,'/legal/underwriting','New Page',1,0,'2016-10-10 12:21:42','2016-10-10 12:37:54',NULL),
	(81,1,'/sign-up','New Page',1,0,'2016-10-10 12:22:05','2016-10-10 12:37:52',NULL),
	(85,1,'/newsroom/media-kit','New Page',1,0,'2016-10-10 17:12:45','0000-00-00 00:00:00',NULL),
	(102,1,'/styleguide','New Page',1,0,'2016-10-18 15:18:21','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_pages_insert` BEFORE INSERT ON `pages` FOR EACH ROW SET new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_pages_update` BEFORE UPDATE ON `pages` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_scripts_insert` BEFORE INSERT ON `scripts` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_scripts_update` BEFORE UPDATE ON `scripts` FOR EACH ROW set new.updated_at = now() */;;
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
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_site_data_insert` BEFORE INSERT ON `site_data` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_site_data_update` BEFORE UPDATE ON `site_data` FOR EACH ROW set new.updated_at = now() */;;
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `is_admin`, `first_name`, `last_name`, `email`, `password`, `title`, `reset_token`, `created_at`, `updated_at`, `is_active`)
VALUES
	(1,2,'Joshua','Byington','jbyington@paradowski.com','$2y$10$1Zmf4JJJJvQ8fQkEa/IP7.HEUNOmCjvSCES6E7i5xgFnV6rbQRlYG','Director of Development',NULL,'2016-04-27 16:59:58','2016-10-17 02:30:23',1),
	(7,1,'Jake','Wood','jwood@paradowski.com','$2y$10$diIHUHjkseSMJq5ntj.Nm.x8HwiZMUmY9NNIBHHDg8qKPrcoqwWz6','Esq.',NULL,'2016-08-26 12:19:52','2016-10-12 12:08:49',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_users_insert` BEFORE INSERT ON `users` FOR EACH ROW set new.created_at = now() */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017  */ /*!50003 TRIGGER `before_users_update` BEFORE UPDATE ON `users` FOR EACH ROW set new.updated_at = now() */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;




# Replace placeholder table for deployable_layouts with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_layouts`;

CREATE VIEW `deployable_layouts`
AS SELECT
   `pl`.`id` AS `id`,concat('layout_',`pl`.`name`) AS `layout_name`,
   `pl`.`content` AS `content`,group_concat(`s1`.`html` separator ' ') AS `meta`,group_concat(`s2`.`html` separator ' ') AS `js`,group_concat(`s3`.`html` separator ' ') AS `nonblocking_js`,group_concat(`s4`.`html` separator ' ') AS `style`
FROM (((((`page_layouts` `pl` left join `page_layout_scripts` `pls` on((`pl`.`id` = `pls`.`page_layout_id`))) left join `scripts` `s1` on(((`s1`.`id` = `pls`.`script_id`) and (`s1`.`script_type_id` = 1)))) left join `scripts` `s2` on(((`s2`.`id` = `pls`.`script_id`) and (`s2`.`script_type_id` = 2)))) left join `scripts` `s3` on(((`s3`.`id` = `pls`.`script_id`) and (`s3`.`script_type_id` = 3)))) left join `scripts` `s4` on(((`s4`.`id` = `pls`.`script_id`) and (`s4`.`script_type_id` = 4)))) group by `pl`.`id` order by `pls`.`load_order`;


# Replace placeholder table for deployable_site_data with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_site_data`;

CREATE VIEW `deployable_site_data`
AS SELECT
   `sd`.`reference_name` AS `reference_name`,
   `sd`.`content` AS `content`
FROM `site_data` `sd`;


# Replace placeholder table for deployable_pages with correct view syntax
# ------------------------------------------------------------

DROP TABLE `deployable_pages`;

CREATE VIEW `deployable_pages`
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

CREATE VIEW `deployable_components`
AS SELECT
   `c`.`name` AS `name`,concat('<div class="',`c`.`uuid`,' component_',`c`.`name`,'">',`c`.`html`,'</div>') AS `html`,concat('.',`c`.`uuid`,'{',`c`.`css`,'}') AS `css`,concat('(function(uuid){',`c`.`js`,'})("',`c`.`uuid`,'")') AS `js`,concat('(function(uuid){',`c`.`nonblocking_js`,'})("',`c`.`uuid`,'")') AS `nonblocking_js`
FROM `components` `c`;


# Replace placeholder table for page_version_preview with correct view syntax
# ------------------------------------------------------------

DROP TABLE `page_version_preview`;

CREATE VIEW `page_version_preview`
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

CREATE VIEW `previewable_pages`
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

CREATE VIEW `deployable_page_data`
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