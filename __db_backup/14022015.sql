-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Počítač: wm74.wedos.net:3306
-- Vygenerováno: Sob 14. úno 2015, 04:08
-- Verze serveru: 5.6.17
-- Verze PHP: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `d86162_zs`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `Attending`
--

CREATE TABLE IF NOT EXISTS `Attending` (
  `idEvent` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `idEvent` (`idEvent`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `Attending`
--

INSERT INTO `Attending` (`idEvent`, `idUser`, `updated_at`, `created_at`) VALUES
(2, 8, '2015-02-01 13:31:35', '2015-02-01 13:31:35'),
(2, 10, '2015-02-01 21:37:16', '2015-02-01 21:37:16'),
(2, 12, '2015-02-03 17:04:00', '2015-02-03 17:04:00'),
(2, 13, '2015-02-04 07:30:45', '2015-02-04 07:30:45'),
(2, 14, '2015-02-04 09:00:53', '2015-02-04 09:00:53'),
(3, 14, '2015-02-04 09:02:00', '2015-02-04 09:02:00'),
(6, 16, '2015-02-08 11:20:30', '2015-02-08 11:20:30'),
(6, 8, '2015-02-08 12:51:30', '2015-02-08 12:51:30'),
(6, 7, '2015-02-09 21:31:50', '2015-02-09 21:31:50'),
(6, 17, '2015-02-10 10:36:26', '2015-02-10 10:36:26'),
(7, 4, '2015-02-11 06:20:33', '2015-02-11 06:20:33'),
(2, 21, '2015-02-13 05:52:27', '2015-02-13 05:52:27'),
(2, 7, '2015-02-13 05:57:04', '2015-02-13 05:57:04'),
(2, 22, '2015-02-13 14:45:42', '2015-02-13 14:45:42'),
(3, 23, '2015-02-13 17:04:18', '2015-02-13 17:04:18'),
(5, 23, '2015-02-13 17:04:59', '2015-02-13 17:04:59'),
(5, 24, '2015-02-13 17:08:28', '2015-02-13 17:08:28');

-- --------------------------------------------------------

--
-- Struktura tabulky `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(100) NOT NULL,
  `popis` varchar(1000) NOT NULL,
  `datum` date NOT NULL,
  `maxLidi` int(11) NOT NULL,
  `skupina` int(11) NOT NULL,
  `cas` varchar(11) NOT NULL,
  `misto` varchar(255) NOT NULL,
  `cena` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Vypisuji data pro tabulku `Events`
--

INSERT INTO `Events` (`id`, `nazev`, `popis`, `datum`, `maxLidi`, `skupina`, `cas`, `misto`, `cena`, `updated_at`, `created_at`) VALUES
(2, 'Pilates', '\r\nHlavní výhody Pilates:<br>\r\n-odstranění bolesti páteře a zad<br>\r\n-rovná držení těla<br>\r\n- posiluje hluboké vnitřní svaly a tím zlepšuje balanc, stabilitu, sílu povrchových svalů<br>\r\n- zlepšuje náladu, zvyšuje sebevědomí a pomáhá zvednout libido a sexuální prožitek u obou pohlaví<br>\r\n- zlepšuje koncentraci<br>\r\n- posiluje dýchací svalstvo, pomáhá lépe dýchat<br>\r\n- celkově energizuje<br>\r\n- díky protažení je velice vhodným doplňkem pro sportovce<br>\r\n- pomáhá shodit přebytečné kilogramy<br><br>\r\nInstruktor: Jakub Trakal<br>\r\n<br>\r\nS sebou: karimatku a ručník', '2015-02-21', 20, 0, '9:00-11:00', 'SŠ Jablonecká, Jablonecká 999/51, 460 06 Liberec VI-Rochlice', 80, '2015-02-10 22:27:38', '2015-01-31 09:35:55'),
(3, 'Výtvarný kurz - Vítání jara', 'Přijďte s námi přivítat JARO - vyrobit něco, co Vám doma navodí jarní atmosféru.<br>\r\n<br>\r\nMOZAIKA -  zdobení květináče skleněnou mozaikou 9:00-12:00<br><br>\r\nCena kurzu: 350 Kč<br><br>\r\nPLETENÍ Z PAPÍRU - pletení košíku z papírových ruliček 13:00-16:00<br><br>\r\nCena kurzu: 280 Kč<br>\r\n<br>\r\n', '2015-03-21', 20, 0, '9:00-16:00', 'Aplaus výtvarné a hobby potřeby - Železná ulice', 0, '2015-02-01 10:27:10', '2015-02-01 09:08:22'),
(5, 'Aqua aerobic', 'AQUA AEROBIC je aerobní cvičení ve vodě (která sahá cca do 1/2 hrudníku). Je zaměřený na zvýšení fyzické kondice, redukci váhy a vytvarování těla. Odpor vody je v závislosti na rychlosti prováděného pohybu 4 až 42 krát vyšší než odpor vzduchu a tím zvyšuje intenzitu cvičení a současně masíruje svaly.<br>\r\nVodní prostředí má příznivé účinky na páteř a pohybovou soustavu. Oproti ostatním formám aerobicu je to cvičení bez jakýchkoliv otřesů a tím nejúčinněji chrání nejen naše klouby, ale i kardiovaskulární systém.', '2015-04-11', 15, 0, '', 'Plavecký bazén Liberec', 0, '2015-02-01 09:33:52', '2015-02-01 09:33:52'),
(6, 'Den matek s ŽENY SOBĚ - Muzikál MAMMA MIA!', 'MAMMA MIA! Jeden z nejúspěšnějších světových muzikálů založený na písních skupiny ABBA se konečně představí v české premiéře.<br>Těšit se můžete na největší hity jako Super Trouper, Chiquitita, Money Money Money, The Winner Takes It All, I Have A Dream, Our Last Summer, Dancing Queen nebo Mamma Mia v českém překladu a s texty Adama Nováka.<br><br>\r\nVíce informací na: www.mammamiamuzikal.cz<br><br>\r\n\r\nVarianta A: 690 Kč<BR>\r\nVarianta B: 890 Kč<br><br>\r\n\r\nCena zahrnuje: dopravu tam i zpět a vstupenku dle varianty<br><br>\r\n\r\nPlatba předem nejpozději do 12.2.2015 . Úhrada na bankovní účet: 670100-2212492181/6210. Popis pro příjemce prosím udat jméno účastnice.<br><br>\r\n\r\nVYPRODÁNO! Přihlášené ženy telefonicky nebo osobní dohodou prosím o úhradu na účet viz výše.<br><br>', '2015-05-16', 0, 0, '19:00', 'Praha - Kongresové centrum', 0, '2015-02-11 18:40:33', '2015-02-01 09:39:48'),
(7, 'test', 'test', '1991-01-01', 30, 0, '13:00', 'turnov', 150, '2015-02-06 23:51:05', '2015-02-06 23:51:05');

-- --------------------------------------------------------

--
-- Struktura tabulky `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `jmeno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `vek` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `test`
--

INSERT INTO `test` (`jmeno`, `prijmeni`, `vek`) VALUES
('antal', 'stasek', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Vypisuji data pro tabulku `Users`
--

INSERT INTO `Users` (`id`, `Jmeno`, `Ulice`, `Mesto`, `Psc`, `DatumNarozeni`, `Email`, `Telefon`, `password`, `updated_at`, `created_at`, `remember_token`) VALUES
(4, 'Matouš Kadrnoška', '28. r', 'turnov', '563', '1991-03-30', 'matous.kadrnoska@gmail.com', '731885442', '$2y$10$h6mGiLQNWnvmexlaSa7ciehCZuHgDdNVjHgSuVOdEhl/KlISw9b6y', '2015-02-14 03:05:01', '2015-01-31 07:32:44', 'Vu2dt2JywKzTFcDSWGpzbuYXZqLFP1nSWwZRz7n3NwBWrXQ1ynJxwUvjKcIL'),
(5, 'admin zenysobe', 'xxx', 'xxx', 'xxx', '2015-01-31', 'admin@zenysobe.eu', '000000000', '$2y$10$YRjsKmadvt3oGcEUagHk7OwHHNCoxVHUl9LDYsWEuZq9iWxZp1rkK', '2015-02-11 07:19:58', '2015-01-31 09:27:31', 'X8fmwvxehF0KsJN5Na0UUi3QTFvISxuuDPhDJVkAGBHRNj8JXLq08DNEC10k'),
(6, 'Petra Havlíčková', 'Sametová 733', 'Liberec 6', '46006', '1988-04-11', 'havlickovapetra@gmail.com', '737556309', '$2y$10$auV1xe2kmF4stAvQRfziqesRS8gZEoJ6keDWOcTMgRxL3ftvSR3Me', '2015-02-09 06:51:33', '2015-02-01 06:57:32', 'ZRgEIDGvnL0yeVCh8XKYozTdDx3k3T9PCjGFS1jUPfTICEDU4ivYBWpl0Sba'),
(7, 'Denisa Letovancová', 'Haškova 953', 'Liberec', '46006', '1992-06-08', 'd.letovancova@gmail.com', '774432301', '$2y$10$/opbk8NkYsjBFUMcwb.QreFO9as7KLTZ0p7.eHHGgH7vQQ0FveOOm', '2015-02-13 06:57:13', '2015-02-01 09:47:26', 'CtYUfZvSuAGJ7OLrlF2qNoCsCug6Pi9t7lpwBrEvW50aY83uSYCXiblpbxpx'),
(8, 'Šárka Letovancová', 'Haškova 953', 'Liberec', '46006', '1965-11-03', 'sariletka@seznam.cz', '777232518', '$2y$10$qRTkLmIpY9EczEZnwAKQjuBRHkICxCZ/VnVkYJFm45/b3qxcGWdUW', '2015-02-01 14:33:20', '2015-02-01 13:31:09', 'mUoxgN6nJaSGZB94q5J2bpiE3fH1cfBFGMzxgLyRpOSfv0ZOmrRCtBoQUCKN'),
(9, 'Veronika Albrehtová', 'Vojanova 359/18', 'Liberec', '46010', '1991-02-13', 'veronikaalbrechtova@hotmail.cz', '777967631', '$2y$10$NlOfmABhOox0dDbMuMBvJ.Bzi8bvc/5eW8VRZCTYKMWS2KFy0UMMi', '2015-02-01 19:54:35', '2015-02-01 19:54:35', ''),
(10, 'Gita Studená', 'Vlnařská 705', 'Liberec', '46006', '1965-01-01', 'gita.studena@zenysobe.eu', '739553717', '$2y$10$2o7lVoOuL9S3m/ndA.1eEOCwY7Xqx/wKXohVFztpDoz9DvujoGagq', '2015-02-01 22:37:23', '2015-02-01 21:36:55', 'QVBEqRdTz7L0vg9vLyc2rqjYHm6OfuuJnwBsQrYPFZrndQgQD1Tql8wyaOtD'),
(11, 'Antal Stašek', 'ulice', 'mesto', 'psc', '1991-03-30', 'm4t4@seznam.cz', '789456123', '$2y$10$zA8VA92ggewqSC5c8QP5zOpn5fFiIs1Opw3yp6LLKJ2A28HVZzVI.', '2015-02-02 16:44:26', '2015-02-02 16:44:26', ''),
(12, 'Hana Machatá', 'Vlnařská', 'Liberec', '46006', '1955-03-08', 'machata@personnel-welfare.cz', '732832462', '$2y$10$Hxsprw/ylCNbvsZxevNKPeOr3fUnkFx.oUqJmXLWXaIrJ/YsoInRq', '2015-02-03 18:05:24', '2015-02-03 17:02:51', '49LKNX4NMZTLnipI9FvAbsBS297x7b2W96VH09lVU8uAreKVwMnHMp9agbQe'),
(13, 'Marcela  Stillerová ', 'Nezvalova 654', 'Liberec ', '46015', '1963-06-02', 'stillerova.marcela1@gmail.com', '603208262', '$2y$10$D0gKzRgFgngQC1uKgCVka.8cu9UNfgSrVwMT0F317Kht47FskAEU6', '2015-02-04 07:29:30', '2015-02-04 07:29:30', ''),
(14, 'Kateřina Mauerová', 'Na Výsluní 1018', 'Nové Město pod Smrkem', '46365', '1994-07-24', 'mauerova.k@gmail.com', '774869102', '$2y$10$epboJdfEqzPSLr8tvCWCkOltdMBIMi.fB5twMzJ8jWh5Wg68avEmm', '2015-02-04 08:59:58', '2015-02-04 08:59:58', ''),
(15, 'Jana Labíková', 'Dlážděná 1423', 'Liberec 30', '46311', '1972-10-20', 'j.labikova@seznam.cz', '739554737', '$2y$10$5L09mwJvYyNikQy70/zQLeKb8nP3rjLsXN4BZNac5fPv6ySYfufP.', '2015-02-06 09:05:38', '2015-02-06 09:05:38', ''),
(16, 'Drahuse Jirova', 'Seifertova 900', 'Liberec 6 ', '46006', '1966-12-22', 'Drahusejirova@seznam.cz', '721158469', '$2y$10$DthmmbG.hWItzdTt5GtkKOrnQHWhxQd7LGHo4ebOJ0noCsuYTWQsq', '2015-02-08 12:54:28', '2015-02-08 11:18:44', 'cUQAfxsXLdHsa7Dy3XWoDYHJhsLAwmruWyKJlQhygjAGVEB47zmjUSWpvczi'),
(17, 'Lenka Doležalová', 'Kamenná 11', 'Jablonec nad Nisou', '466 01', '1959-05-06', 'lendolezal@seznam.cz', '724209589', '$2y$10$0vQxeUgGqdAkqQn2.mTla.e2sftd0bc1yh36HvP2peIPh..iKz5Iu', '2015-02-11 20:18:47', '2015-02-09 20:42:18', 'NQ5xDQZtJHXgToGW1mMCS8uoj9GZSDbq43olI0IiBWI7piUEMb5wTnKQ0Fxc'),
(19, 'Dagmar Petráková', 'Zdislava 98', 'KŘIŽANY', '463 53', '1953-02-02', 'dagmar.petrakova@seznam.cz', '725605105', '$2y$10$mquS3I.SGpkaLaMDvDV.iO21Ki/BAb.mvrm/hugUZya.QiA8lXI/K', '2015-02-11 15:11:40', '2015-02-11 14:10:20', 'noXQQIWzw7N7VH8LXOPuQ5jMXuElKeA7dqHQBu66SWauREOvqbFBcNAlWkPr'),
(20, 'Jana Rybářová', 'Dvouletky 958', 'Kostelec nad Černými lesy', '281 63', '1988-02-09', 'j.ryb@seznam.cz', '732973524', '$2y$10$/fOHpP6uFD3lh0SX/y0KUOI.OFAIXGQlAttc8j0bwWhz/NcVw1iwS', '2015-02-11 21:16:08', '2015-02-11 20:08:37', 'oeJo1P31J2dMRmw1W7JiyQ5v2drMgS99ZC2MNTls1SYPF2qhpun9EbD2iJVJ'),
(21, 'Klára Letovancová', 'Vojtěšská 446/1', 'Liberec', '46001', '1989-02-09', 'klara.letovancova@lukovplast.cz', '603500442', '$2y$10$.MVYZKNelEK2yZX.aXIcX.rp7QY/.fK6xv2hrsGzYYEusnkTLma2C', '2015-02-13 06:54:58', '2015-02-13 05:51:55', '9sqhMEh5QgAb8Ih505R1jsXttXqn6BXSGyNYvjUENSoW9ftC0mmVh9cvfRYL'),
(22, 'Helena Pokorná', 'Vysoká 822/17', 'Liberec 3', '46007', '1973-05-13', 'pokorna.hell@seznam.cz', '604278290', '$2y$10$vnxK66aTmFCNrZ.BMpzhzuxPAk34BOQ0UpP28ZREm86AjEk2A1PPK', '2015-02-13 14:45:07', '2015-02-13 14:45:07', ''),
(23, 'Lenka Linhartová', 'Norská 450', 'Liberec 11', '46001', '1987-05-02', 'zivule@centrum.cz', '775175087', '$2y$10$qQXthOTJ2KZEHSW/T8gLne.HGyFVf5cAvOb5ChCk2vZ/NqerAEGHe', '2015-02-13 18:05:05', '2015-02-13 16:32:07', '2WXNZOZ95prlLM9K7HPDwSblBSiHlxzPBHcJgAEzO5Yqszg6mKGhfe4u5UAb'),
(24, 'Dagmar Linhartová', 'Na Kačírku 477/28', 'Liberec 6', '46001', '1958-12-19', 'linhartova.dasa@volny.cz', '721654368', '$2y$10$cVLgcOYCdZUsSFJdyPugR.AoxcElZFUhpfqDePuNuciPV5CJjAwbi', '2015-02-13 18:09:22', '2015-02-13 17:07:59', 'tjSNGBrFBwG0X3uHafzGW9tzat1ablnAWDp1c6tlKhbEbnVCnHuVuA6iOsDO');

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `Attending`
--
ALTER TABLE `Attending`
  ADD CONSTRAINT `Attending_ibfk_2` FOREIGN KEY (`idEvent`) REFERENCES `Events` (`id`),
  ADD CONSTRAINT `Attending_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
