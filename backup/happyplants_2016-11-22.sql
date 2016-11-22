# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.52-0+deb8u1)
# Database: happyplants
# Generation Time: 2016-11-22 07:25:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table modules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address` text,
  `hp_id` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;

INSERT INTO `modules` (`id`, `address`, `hp_id`)
VALUES
	(12,'13:37:B1:FC:D1:A5','HP Module'),
	(13,'98:D3:31:FC:31:A4','HC-06');

/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sensordata
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sensordata`;

CREATE TABLE `sensordata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `address` text,
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
	(1,'13:37:B1:FC:D1:A5','2016-11-02 12:58:07',25.25,700,268),
	(2,'13:37:B1:FC:D1:A5','2016-11-02 13:00:00',25.25,700,268),
	(3,'13:37:B1:FC:D1:A5','2016-11-02 13:05:00',25.45,700,468),
	(4,'13:37:B1:FC:D1:A5','2016-11-02 13:09:06',26,820,590),
	(5,'13:37:B1:FC:D1:A5','2016-11-02 13:14:58',25.95,700,600),
	(6,'13:37:B1:FC:D1:A5','2016-11-02 13:20:04',25.9,700,580),
	(7,'13:37:B1:FC:D1:A5','2016-11-02 13:25:02',25.7,680,575);

/*!40000 ALTER TABLE `sensordata` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
