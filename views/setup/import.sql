
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


CREATE DATABASE IF NOT EXISTS `tibaredha` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tibaredha`;


CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;


