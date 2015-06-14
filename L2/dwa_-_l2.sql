-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2015 at 12:53 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dwa - l2`
--
CREATE DATABASE IF NOT EXISTS `dwa - l2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dwa - l2`;

-- --------------------------------------------------------

--
-- Table structure for table `alergeni`
--

CREATE TABLE IF NOT EXISTS `alergeni` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `alergeni`
--

INSERT INTO `alergeni` (`ID`, `Naziv`) VALUES
(1, 'Soja'),
(2, 'Jaja'),
(3, 'Kikiriki'),
(4, 'Mlijeko'),
(5, 'Rakovi'),
(6, 'Skoljke'),
(7, 'Orasasti plodovi'),
(8, 'Jagode'),
(9, 'Kivi'),
(10, 'Ananas');

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE IF NOT EXISTS `proizvod` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NazivProizvoda` varchar(100) NOT NULL,
  `TipProizvoda` varchar(50) NOT NULL,
  `OpisProizvoda` varchar(100) NOT NULL,
  `Vegetarijanski` int(11) NOT NULL,
  `Halal` int(11) NOT NULL,
  `Koser` int(11) NOT NULL,
  `Alergeni` varchar(100) NOT NULL,
  `Cijena` double NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `TipProizvodaID` (`TipProizvoda`),
  KEY `AlergeniID` (`Alergeni`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`ID`, `NazivProizvoda`, `TipProizvoda`, `OpisProizvoda`, `Vegetarijanski`, `Halal`, `Koser`, `Alergeni`, `Cijena`) VALUES
(1, 'Gibanica', 'Ostalo', 'Ovo je slani tip kolaca, punjena je orasima\r\n', 0, 0, 0, 'jaja, orasi', 10),
(2, 'Sirnica', 'Ostalo', 'Ovo je slani tip kolaca, punjen sirom', 0, 0, 0, 'jaja, mlijeko', 12),
(3, 'Burek', 'Ostalo', 'Ovo je slani tip kola?a, punjen mesom', 0, 0, 0, 'jaja', 14),
(4, 'Sacher torta', 'Kolac', 'Cokoladna torta u vise slojeva', 1, 1, 1, '', 16),
(5, 'Madarica', 'Kolac', 'Cokoladni tip torte u vise slojeva, s korama', 0, 0, 0, 'jaja', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tipproizvoda`
--

CREATE TABLE IF NOT EXISTS `tipproizvoda` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Tip` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tipproizvoda`
--

INSERT INTO `tipproizvoda` (`ID`, `Tip`) VALUES
(1, 'Kolac'),
(2, 'Torta'),
(3, 'Keks'),
(4, 'Cokolada'),
(5, 'Pice'),
(6, 'Ostalo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
