# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.52-0+deb8u1)
# Database: happyplants
# Generation Time: 2017-02-01 22:00:04 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table crops
# ------------------------------------------------------------

DROP TABLE IF EXISTS `crops`;

CREATE TABLE `crops` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `nicename` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `crops` WRITE;
/*!40000 ALTER TABLE `crops` DISABLE KEYS */;

INSERT INTO `crops` (`id`, `name`, `nicename`)
VALUES
	(1,'tomato','Tomaat'),
	(2,'corn','Mais'),
	(3,'courgette','Courgette'),
	(4,'potato','Aardappel'),
	(5,'pickle','Augurk'),
	(6,'cucumber','Komkommer'),
	(7,'carrot','Wortel');

/*!40000 ALTER TABLE `crops` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `request` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;

INSERT INTO `locations` (`id`, `user`, `lat`, `lng`, `offer`, `request`)
VALUES
	(1,'Trevor',51.895,4.41943,'potato','corn'),
	(2,'Franklin',51.9078,4.46132,'carrot','potato');

/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table modules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(12) NOT NULL DEFAULT '',
  `hp_id` varchar(64) DEFAULT '',
  `crop` varchar(45) NOT NULL DEFAULT 'none',
  `nxt_cmd` varchar(22) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;

INSERT INTO `modules` (`id`, `address`, `hp_id`, `crop`, `nxt_cmd`)
VALUES
	(21,'03987654','Mais','potato','0');

/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sensordata
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sensordata`;

CREATE TABLE `sensordata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(12) DEFAULT '',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temp` float DEFAULT NULL,
  `light` int(11) DEFAULT NULL,
  `moist` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `sensordata` WRITE;
/*!40000 ALTER TABLE `sensordata` DISABLE KEYS */;

INSERT INTO `sensordata` (`id`, `address`, `timestamp`, `temp`, `light`, `moist`)
VALUES
	(1,'08798675','2016-11-02 12:58:07',25.25,700,268),
	(2,'08798675','2016-11-02 13:00:00',25.25,700,268),
	(3,'08798675','2016-11-02 13:05:00',25.45,700,468),
	(4,'08798675','2016-11-02 13:09:06',26,820,590),
	(5,'08798675','2016-11-02 13:14:58',25.95,700,600),
	(6,'08798675','2016-11-02 13:20:04',25.9,700,580),
	(7,'08798675','2016-11-02 13:25:02',25.7,680,575),
	(8,'03987654','2017-01-31 09:44:14',24.56,341,100),
	(9,'03987654','2017-01-31 09:44:28',24.56,341,100),
	(10,'03987654','2017-01-31 09:44:30',24.56,341,100);

/*!40000 ALTER TABLE `sensordata` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
