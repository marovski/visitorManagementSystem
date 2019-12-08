-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2018 at 09:54 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

USE  `nanium`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--

--

-- --------------------------------------------------------

--
-- Table structure for table `delivers`
--

DROP TABLE IF EXISTS `delivers`;
CREATE TABLE IF NOT EXISTS `delivers` (
  `idDeliver` int(11) NOT NULL AUTO_INCREMENT,
  `deIdUser` int(11) NOT NULL,
  `deFirmSupplier` varchar(45) DEFAULT NULL,
  `deDriverName` varchar(45) DEFAULT NULL,
  `deDriverID` int(10) NOT NULL,
  `vehicleRegistry` varchar(25) DEFAULT NULL,
  `deEntryTime` datetime(6) NOT NULL,
  `deExitTime` datetime(6) DEFAULT NULL,
  `entryWeight` float DEFAULT NULL,
  `exitWeight` float DEFAULT NULL,
  `image` varchar(60) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDeliver`,`deIdUser`),
  KEY `fk_Deliver_User2_idx` (`deIdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delivertype`
--

DROP TABLE IF EXISTS `delivertype`;
CREATE TABLE IF NOT EXISTS `delivertype` (
  `idDeliverType` int(11) NOT NULL AUTO_INCREMENT,
  `deliver_idDeliver` int(11) NOT NULL,
  `materialDetails` varchar(250) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `dangerousGood` tinyint(2) DEFAULT NULL,
  `sensitiveLevel` tinyint(6) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDeliverType`),
  KEY `fk_deliver_idDeliver` (`deliver_idDeliver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `drops`
--

DROP TABLE IF EXISTS `drops`;
CREATE TABLE IF NOT EXISTS `drops` (
  `idDrop` int(11) NOT NULL AUTO_INCREMENT,
  `dropIdUser` int(11) NOT NULL,
  `dropperName` varchar(45) NOT NULL,
  `dropperCompanyName` varchar(45) DEFAULT NULL,
  `dropReceiver` varchar(45) DEFAULT NULL,
  `droppedWhen` datetime(6) NOT NULL,
  `dropReceivedDate` datetime(6) DEFAULT NULL,
  `dropDescr` varchar(250) NOT NULL,
  `dropImportance` tinyint(3) DEFAULT NULL,
  `dropSize` varchar(60) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idDrop`,`dropIdUser`),
  KEY `fk_Deliver_User1_idx` (`dropIdUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lostitems`
--

DROP TABLE IF EXISTS `lostitems`;
CREATE TABLE IF NOT EXISTS `lostitems` (
  `idLostFound` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `itemCategory` int(11) NOT NULL,
  `itemDescription` varchar(50) DEFAULT NULL,
  `itemSize` varchar(60) DEFAULT NULL,
  `itemImportance` tinyint(4) DEFAULT NULL,
  `claimedDate` datetime DEFAULT NULL,
  `foundDate` datetime NOT NULL,
  `finderName` varchar(40) NOT NULL,
  `receiverName` varchar(60) DEFAULT NULL,
  `receiverPhone` varchar(60) DEFAULT NULL,
  `finderPhone` varchar(60) NOT NULL,
  `photo` varchar(40) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idLostFound`),
  KEY `fk_user_has_reported_lostFound` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
CREATE TABLE IF NOT EXISTS `meetings` (
  `idMeeting` int(11) NOT NULL AUTO_INCREMENT,
  `meetingName` varchar(45) DEFAULT NULL,
  `meetIdHost` int(11) NOT NULL,
  `visitReason` varchar(200) DEFAULT NULL,
  `meetStartDate` datetime(6) DEFAULT NULL,
  `meetEndDate` datetime(6) DEFAULT NULL,
  `meetStatus` tinyint(4) DEFAULT NULL,
  `confidentiality` tinyint(1) DEFAULT NULL,
  `sensibility` int(11) DEFAULT NULL,
  `room` varchar(45) DEFAULT NULL,
  `email` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMeeting`,`meetIdHost`),
  UNIQUE KEY `meetingName_UNIQUE` (`meetingName`),
  KEY `fk_Meeting_User1_idx` (`meetIdHost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_user`
--

DROP TABLE IF EXISTS `meeting_user`;
CREATE TABLE IF NOT EXISTS `meeting_user` (
  `user_idUser` int(11) NOT NULL,
  `meeting_idMeeting` int(11) NOT NULL,
  PRIMARY KEY (`user_idUser`,`meeting_idMeeting`),
  KEY `fk_User_has_Meeting_Meeting1_idx` (`meeting_idMeeting`),
  KEY `fk_User_has_Meeting_User1_idx` (`user_idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_visitor`
--

DROP TABLE IF EXISTS `meeting_visitor`;
CREATE TABLE IF NOT EXISTS `meeting_visitor` (
  `visitor_idVisitor` int(11) NOT NULL,
  `meeting_idMeeting` int(11) NOT NULL,
  PRIMARY KEY (`visitor_idVisitor`,`meeting_idMeeting`),
  KEY `fk_Visitor_has_Meeting_Meeting1_idx` (`meeting_idMeeting`),
  KEY `fk_Visitor_has_Meeting_Visitor1_idx` (`visitor_idVisitor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `securities`
--

DROP TABLE IF EXISTS `securities`;
CREATE TABLE IF NOT EXISTS `securities` (
  `idSecurity` int(11) NOT NULL,
  `superAdmin` tinyint(1) DEFAULT NULL,
  `meetingPermission` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idSecurity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `department` varchar(45) NOT NULL,
  `photo` varchar(60) NOT NULL,
  `fk_idSecurity` int(11) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUser`,`fk_idSecurity`),
  KEY `fk_User_Security1_idx` (`fk_idSecurity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE IF NOT EXISTS `visitors` (
  `idVisitor` int(11) NOT NULL AUTO_INCREMENT,
  `visitorName` varchar(45) NOT NULL,
  `visitorEmail` varchar(45) NOT NULL,
  `visitorCitizenCard` varchar(12) DEFAULT NULL,
  `visitorNPhone` varchar(60) DEFAULT NULL,
  `visitorCompanyName` varchar(45) DEFAULT NULL,
  `escorted` tinyint(1) DEFAULT NULL,
  `wifiAcess` tinyint(1) DEFAULT NULL,
  `visitorCitizenCardType` smallint(6) DEFAULT NULL,
  `visitorDangerousGood` tinyint(1) DEFAULT NULL,
  `visitorDeclaredGood` varchar(45) DEFAULT NULL,
  `signOutFlag` tinyint(1) NOT NULL DEFAULT '0',
  `exitTime` time DEFAULT NULL,
  `entryTime` time DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idVisitor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivers`
--
ALTER TABLE `delivers`
  ADD CONSTRAINT `fk_deliver_has_user` FOREIGN KEY (`deIdUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `delivertype`
--
ALTER TABLE `delivertype`
  ADD CONSTRAINT `fk_deliver_deliverType` FOREIGN KEY (`deliver_idDeliver`) REFERENCES `delivers` (`idDeliver`) ON UPDATE CASCADE;

--
-- Constraints for table `drops`
--
ALTER TABLE `drops`
  ADD CONSTRAINT `fk_drop_has_user` FOREIGN KEY (`dropIdUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `lostitems`
--
ALTER TABLE `lostitems`
  ADD CONSTRAINT `fk_user_has_reported_lostFound` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `fk_meeting_host` FOREIGN KEY (`meetIdHost`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `meeting_user`
--
ALTER TABLE `meeting_user`
  ADD CONSTRAINT `fk_meeting_has_user` FOREIGN KEY (`meeting_idMeeting`) REFERENCES `meetings` (`idMeeting`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_meeting` FOREIGN KEY (`user_idUser`) REFERENCES `users` (`idUser`) ON UPDATE CASCADE;

--
-- Constraints for table `meeting_visitor`
--
ALTER TABLE `meeting_visitor`
  ADD CONSTRAINT `fk_meeting_has_visitor` FOREIGN KEY (`meeting_idMeeting`) REFERENCES `meetings` (`idMeeting`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_visitor_has_meeting` FOREIGN KEY (`visitor_idVisitor`) REFERENCES `visitors` (`idVisitor`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_has_securityLevel` FOREIGN KEY (`fk_idSecurity`) REFERENCES `securities` (`idSecurity`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
