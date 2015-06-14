-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2015 at 09:33 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dwa_labos`
--
CREATE DATABASE IF NOT EXISTS `dwa_labos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dwa_labos`;

-- --------------------------------------------------------

--
-- Table structure for table `alergeni`
--

CREATE TABLE IF NOT EXISTS `alergeni` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
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
-- Table structure for table `alergenihelper`
--

CREATE TABLE IF NOT EXISTS `alergenihelper` (
  `proizvodId` int(11) NOT NULL,
  `alergenId` int(11) NOT NULL,
  KEY `proizvodId` (`proizvodId`,`alergenId`),
  KEY `alergenId` (`alergenId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alergenihelper`
--

INSERT INTO `alergenihelper` (`proizvodId`, `alergenId`) VALUES
(1, 1),
(1, 2),
(1, 6),
(2, 3),
(2, 7),
(3, 1),
(3, 10),
(4, 8),
(4, 9),
(5, 2),
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE IF NOT EXISTS `proizvod` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NazivProizvoda` varchar(100) NOT NULL,
  `TipProizvodaId` int(11) NOT NULL,
  `OpisProizvoda` varchar(100) NOT NULL,
  `Vegetarijanski` int(11) NOT NULL,
  `Halal` int(11) NOT NULL,
  `Koser` int(11) NOT NULL,
  `Cijena` double NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `TipProizvodaID` (`TipProizvodaId`),
  KEY `TipProizvoda` (`TipProizvodaId`),
  KEY `TipProizvoda_2` (`TipProizvodaId`),
  KEY `TipProizvoda_3` (`TipProizvodaId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`ID`, `NazivProizvoda`, `TipProizvodaId`, `OpisProizvoda`, `Vegetarijanski`, `Halal`, `Koser`, `Cijena`) VALUES
(1, 'Gibanica', 1, 'Ovo je slani tip kolaca, punjena je orasima\r\n', 0, 0, 0, 10),
(2, 'Sirnica', 2, 'Ovo je slani tip kolaca, punjen sirom', 0, 0, 0, 12),
(3, 'Burek', 3, 'Ovo je slani tip kola?a, punjen mesom', 0, 0, 0, 14),
(4, 'Sacher torta', 4, 'Cokoladna torta u vise slojeva', 1, 1, 1, 16),
(5, 'Madarica', 5, 'Cokoladni tip torte u vise slojeva, s korama', 0, 0, 0, 10),
(6, 'sxasxasx', 1, 'asxsxasx', 1, 1, 1, 22);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alergenihelper`
--
ALTER TABLE `alergenihelper`
  ADD CONSTRAINT `alergeniHelper-alergeni-Constraint` FOREIGN KEY (`alergenId`) REFERENCES `alergeni` (`ID`),
  ADD CONSTRAINT `alergeni-Proizvod-Constraint` FOREIGN KEY (`proizvodId`) REFERENCES `proizvod` (`ID`);

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `proizvod-tipproizvoda-constraint` FOREIGN KEY (`TipProizvodaId`) REFERENCES `tipproizvoda` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
