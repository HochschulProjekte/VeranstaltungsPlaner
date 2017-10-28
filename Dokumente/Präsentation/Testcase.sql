-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Okt 2017 um 00:43
-- Server-Version: 10.1.24-MariaDB
-- PHP-Version: 7.1.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `vstp4`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` longtext,
  `length` int(11) DEFAULT NULL,
  `maxParticipants` int(11) DEFAULT NULL,
  `eventManager` varchar(12) NOT NULL,
  PRIMARY KEY (`eventId`),
  KEY `fk_Event_User1_idx` (`eventManager`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `event`
--

INSERT INTO `Event` (`eventId`, `name`, `description`, `length`, `maxParticipants`, `eventManager`) VALUES
(1, 'Excel Seminar', 'Lernen Sie MS Excel besser kennen', 4, 4, 'Dozent 1'),
(2, 'Word Seminar', 'Lernen Sie MS Word besser kennen', 2, 10, 'Dozent 2'),
(8, 'Outlook Seminar', 'Lernen Sie MS Outlook besser kennen', 4, 6, 'Dozent 2'),
(9, 'IE Seminar', 'Braucht sowieso niemand', 1, 10, 'Dozent 3'),
(10, 'Editor Seminar', 'Lernen Sie den Editor besser kennen', 1, 10, 'Dozent 3');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eventregistration`
--

CREATE TABLE IF NOT EXISTS `EventRegistration` (
  `eventRegistrationId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL,
  `projectWeekEntryId` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `priority` int(11) DEFAULT '1',
  `approved` tinyint(4) DEFAULT NULL,
  `registrationDate` datetime DEFAULT NULL,
  PRIMARY KEY (`eventRegistrationId`,`username`,`projectWeekEntryId`),
  KEY `fk_BenutzerProVeranstaltung_Benutzer1_idx` (`username`),
  KEY `fk_UserPerEvent_ProjectWeekEntry1_idx` (`projectWeekEntryId`),
  KEY `fk_EventRegistration_ProjectWeek1_idx` (`year`,`week`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projectweek`
--

CREATE TABLE IF NOT EXISTS `ProjectWeek` (
  `year` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `from` datetime DEFAULT NULL,
  `until` datetime DEFAULT NULL,
  `phase` int(11) DEFAULT '1',
  PRIMARY KEY (`year`,`week`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `projectweek`
--

INSERT INTO `ProjectWeek` (`year`, `week`, `from`, `until`, `phase`) VALUES
(2017, 43, '2017-10-23 00:00:00', '2017-10-27 00:00:00', 1),
(2017, 44, '2017-10-30 00:00:00', '2017-11-03 00:00:00', 2),
(2017, 45, '2017-11-06 00:00:00', '2017-11-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projectweekentry`
--

CREATE TABLE IF NOT EXISTS `ProjectWeekEntry` (
  `projectWeekEntryId` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `participants` int(11) NOT NULL,
  `maxParticipants` int(11) NOT NULL,
  PRIMARY KEY (`projectWeekEntryId`),
  KEY `fk_ProjectWeekEntry_Event1_idx` (`eventId`),
  KEY `fk_ProjectWeekEntry_ProjectWeek1_idx` (`year`,`week`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `projectweekentry`
--

INSERT INTO `ProjectWeekEntry` (`projectWeekEntryId`, `eventId`, `year`, `week`, `position`, `participants`, `maxParticipants`) VALUES
(1, 1, 2017, 44, 1, 0, 4),
(2, 8, 2017, 44, 1, 0, 6),
(3, 2, 2017, 44, 5, 0, 10),
(5, 1, 2017, 44, 7, 0, 3),
(7, 9, 2017, 44, 7, 0, 10),
(8, 10, 2017, 44, 8, 0, 10),
(9, 2, 2017, 44, 9, 0, 10),
(10, 1, 2017, 45, 1, 0, 4),
(11, 8, 2017, 45, 1, 0, 6),
(13, 2, 2017, 45, 5, 0, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `User` (
  `name` varchar(12) NOT NULL,
  `password` varchar(45) DEFAULT NULL,
  `personnalManager` tinyint(4) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `User` (`name`, `password`, `personnalManager`, `email`) VALUES
('admin', 'admin', 1, ''),
('Dozent 1', 'admin', 1, ''),
('Dozent 2', 'admin', 1, ''),
('Dozent 3', 'admin', 1, ''),
('Mitarbeiter1', 'user', 0, ''),
('Mitarbeiter2', 'user', 0, ''),
('Mitarbeiter3', 'user', 0, ''),
('Mitarbeiter4', 'user', 0, ''),
('Mitarbeiter5', 'user', 0, '');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `fk_Event_User1` FOREIGN KEY (`eventManager`) REFERENCES `user` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `eventregistration`
--
ALTER TABLE `EventRegistration`
  ADD CONSTRAINT `fk_BenutzerProVeranstaltung_Benutzer1` FOREIGN KEY (`username`) REFERENCES `user` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_EventRegistration_ProjectWeek1` FOREIGN KEY (`year`,`week`) REFERENCES `projectweek` (`year`, `week`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UserPerEvent_ProjectWeekEntry1` FOREIGN KEY (`projectWeekEntryId`) REFERENCES `projectweekentry` (`projectWeekEntryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `projectweekentry`
--
ALTER TABLE `ProjectWeekEntry`
  ADD CONSTRAINT `fk_ProjectWeekEntry_Event1` FOREIGN KEY (`eventId`) REFERENCES `event` (`eventId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ProjectWeekEntry_ProjectWeek1` FOREIGN KEY (`year`,`week`) REFERENCES `projectweek` (`year`, `week`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
