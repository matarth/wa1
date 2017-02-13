-- Adminer 3.3.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Attending`;
CREATE TABLE `Attending` (
  `idEvent` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `idEvent` (`idEvent`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `Attending_ibfk_2` FOREIGN KEY (`idEvent`) REFERENCES `Events` (`id`),
  CONSTRAINT `Attending_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `Users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `Events`;
CREATE TABLE `Events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(100) NOT NULL,
  `popis` varchar(1000) NOT NULL,
  `datum` date NOT NULL,
  `maxLidi` int(11) NOT NULL,
  `skupina` int(11) NOT NULL,
  `cas` varchar(11) NOT NULL,
  `misto` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Jmeno` varchar(255) DEFAULT NULL,
  `Ulice` varchar(300) DEFAULT NULL,
  `Mesto` varchar(300) DEFAULT NULL,
  `Psc` varchar(300) DEFAULT NULL,
  `DatumNarozeni` date NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telefon` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_email` (`Email`),
  UNIQUE KEY `Jmeno` (`Jmeno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2015-02-04 04:58:42

