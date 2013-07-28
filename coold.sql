-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 28. Jul 2013 um 20:22
-- Server Version: 5.6.11
-- PHP-Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `coold`
--
CREATE DATABASE IF NOT EXISTS `coold` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `coold`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `coold`
--

CREATE TABLE IF NOT EXISTS `coold` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) NOT NULL,
  `todo` varchar(255) NOT NULL,
  `who` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `kategorie` int(1) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `coold`
--

INSERT INTO `coold` (`ID`, `client`, `todo`, `who`, `status`, `kategorie`, `added`) VALUES
(1, 'BatterieExpress GmbH', 'Konfigurator', 'Fabian, Lukas', 1, 1, '2013-07-28 15:01:57'),
(2, 'BatterieExpress GmbH', 'MatrixTableRates', 'Tobias', 2, 1, '2013-07-28 15:01:57'),
(3, 'co-op design', 'CRM', 'Tobias', 2, 2, '2013-07-28 15:01:57');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `login`
--

INSERT INTO `login` (`ID`, `name`, `pass`) VALUES
(1, 'co-op design', 'kartoffelsalat');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
