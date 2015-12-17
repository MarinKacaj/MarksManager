-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2015 at 10:10 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekretaria_mesimore`
--

-- --------------------------------------------------------

--
-- Table structure for table `dege`
--

CREATE TABLE IF NOT EXISTS `dege` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_dege` text NOT NULL,
  `id_njk` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_njk` (`id_njk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `dege`
--

INSERT INTO `dege` (`ID`, `em_dege`, `id_njk`) VALUES
(1, 'Inxhinieri Informatike', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frekuentim`
--

CREATE TABLE IF NOT EXISTS `frekuentim` (
  `id_lende` int(11) NOT NULL DEFAULT '0',
  `id_student` int(11) NOT NULL,
  `id_dege` int(11) NOT NULL,
  `frek_semin` tinyint(1) NOT NULL,
  `frek_lab` tinyint(1) NOT NULL,
  `kalon_dk` tinyint(1) NOT NULL,
  `gjendja` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_lende`,`id_student`,`id_dege`),
  KEY `id_lende` (`id_lende`),
  KEY `id_student` (`id_student`),
  KEY `id_dege` (`id_dege`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frekuentim`
--

INSERT INTO `frekuentim` (`id_lende`, `id_student`, `id_dege`, `frek_semin`, `frek_lab`, `kalon_dk`, `gjendja`) VALUES
(1, 1, 1, 1, 1, 1, 0),
(1, 2, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE IF NOT EXISTS `grup` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_grup` text NOT NULL,
  `id_dege` int(11) NOT NULL,
  `id_va_fillim` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_dege` (`id_dege`),
  KEY `id_va_fillim` (`id_va_fillim`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`ID`, `em_grup`, `id_dege`, `id_va_fillim`) VALUES
(1, '1-B', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ial`
--

CREATE TABLE IF NOT EXISTS `ial` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_ial` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ial`
--

INSERT INTO `ial` (`ID`, `em_ial`) VALUES
(1, 'UPT 001'),
(6, 'Luigj Gurakuqi'),
(16, 'MIT');

-- --------------------------------------------------------

--
-- Table structure for table `lende`
--

CREATE TABLE IF NOT EXISTS `lende` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_lende` text NOT NULL,
  `cikli` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lende`
--

INSERT INTO `lende` (`ID`, `em_lende`, `cikli`) VALUES
(1, 'Databaza te masakruara', 'Zeniti i gomarllekut');

-- --------------------------------------------------------

--
-- Table structure for table `njk`
--

CREATE TABLE IF NOT EXISTS `njk` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_njk` text NOT NULL,
  `adrese` text,
  `dekan` text NOT NULL,
  `kryesekretar` text NOT NULL,
  `sekretar` text NOT NULL,
  `id_ial` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_ial` (`id_ial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `njk`
--

INSERT INTO `njk` (`ID`, `em_njk`, `adrese`, `dekan`, `kryesekretar`, `sekretar`, `id_ial`) VALUES
(1, 'FTI', 'Sheshi "Nene Tereza"', 'Vladi Kolici', 'Unknown #1', 'Unknown #2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pedagog`
--

CREATE TABLE IF NOT EXISTS `pedagog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_pedagog` text NOT NULL,
  `mb_pedagog` text NOT NULL,
  `titull` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pedagog`
--

INSERT INTO `pedagog` (`ID`, `em_pedagog`, `mb_pedagog`, `titull`, `email`, `password`) VALUES
(1, 'Alban', 'Allkoci', 'MSc', 'def@def.com', 'def'),
(2, 'Alban', 'Rakipi', 'MSc', 'ghi@ghi.com', 'def'),
(3, 'Igli', 'Tafaj', 'Dr', 'jkl@jkl.com', 'def');

-- --------------------------------------------------------

--
-- Table structure for table `provim`
--

CREATE TABLE IF NOT EXISTS `provim` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_sezon` int(11) NOT NULL,
  `id_lende` int(11) NOT NULL,
  `id_dege` int(11) NOT NULL,
  `id_kryetar_komisioni` int(11) NOT NULL,
  `id_antar1` int(11) NOT NULL,
  `id_antar2` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_sezon` (`id_sezon`),
  KEY `id_lende` (`id_lende`),
  KEY `id_dege` (`id_dege`),
  KEY `id_kryetar_komisioni` (`id_kryetar_komisioni`),
  KEY `id_antar1` (`id_antar1`),
  KEY `id_antar2` (`id_antar2`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `provim`
--

INSERT INTO `provim` (`ID`, `id_sezon`, `id_lende`, `id_dege`, `id_kryetar_komisioni`, `id_antar1`, `id_antar2`) VALUES
(1, 1, 1, 1, 1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--

CREATE TABLE IF NOT EXISTS `rezultat` (
  `id_provim` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `date_provim` date NOT NULL,
  PRIMARY KEY (`id_provim`,`id_student`),
  KEY `id_provim` (`id_provim`),
  KEY `id_student` (`id_student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`id_provim`, `id_student`, `note`, `date_provim`) VALUES
(1, 1, 9, '2015-06-03'),
(1, 2, 9, '2015-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `sekretare`
--

CREATE TABLE IF NOT EXISTS `sekretare` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_sektretare` text NOT NULL,
  `mb_sekretare` text NOT NULL,
  `titull` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sekretare`
--

INSERT INTO `sekretare` (`ID`, `em_sektretare`, `mb_sekretare`, `titull`, `email`, `password`) VALUES
(1, 'Filane', 'Fistekja', 'Sociopate', 'abc@abc.com', 'def');

-- --------------------------------------------------------

--
-- Table structure for table `sezon`
--

CREATE TABLE IF NOT EXISTS `sezon` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_sezon` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sezon`
--

INSERT INTO `sezon` (`ID`, `em_sezon`) VALUES
(1, 'Armageddon');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `em_student` text NOT NULL,
  `mb_student` text NOT NULL,
  `id_grup` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_grup` (`id_grup`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `em_student`, `mb_student`, `id_grup`, `email`, `password`) VALUES
(1, 'Em1', 'Mb1', 1, 'em1.mb1@upt.com', 'pass1'),
(2, 'Em2', 'Mb2', 1, 'em2.mb2@upt.al', 'pass2');

-- --------------------------------------------------------

--
-- Table structure for table `va`
--

CREATE TABLE IF NOT EXISTS `va` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `viti` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `va`
--

INSERT INTO `va` (`ID`, `viti`) VALUES
(1, 2015);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dege`
--
ALTER TABLE `dege`
  ADD CONSTRAINT `dege_ibfk_1` FOREIGN KEY (`id_njk`) REFERENCES `njk` (`ID`);

--
-- Constraints for table `frekuentim`
--
ALTER TABLE `frekuentim`
  ADD CONSTRAINT `frekuentim_ibfk_1` FOREIGN KEY (`id_lende`) REFERENCES `lende` (`ID`),
  ADD CONSTRAINT `frekuentim_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `student` (`ID`),
  ADD CONSTRAINT `frekuentim_ibfk_3` FOREIGN KEY (`id_dege`) REFERENCES `dege` (`ID`);

--
-- Constraints for table `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `grup_ibfk_1` FOREIGN KEY (`id_dege`) REFERENCES `dege` (`ID`),
  ADD CONSTRAINT `grup_ibfk_2` FOREIGN KEY (`id_va_fillim`) REFERENCES `va` (`ID`);

--
-- Constraints for table `njk`
--
ALTER TABLE `njk`
  ADD CONSTRAINT `njk_ibfk_1` FOREIGN KEY (`id_ial`) REFERENCES `ial` (`ID`);

--
-- Constraints for table `provim`
--
ALTER TABLE `provim`
  ADD CONSTRAINT `provim_ibfk_1` FOREIGN KEY (`id_sezon`) REFERENCES `sezon` (`ID`),
  ADD CONSTRAINT `provim_ibfk_2` FOREIGN KEY (`id_lende`) REFERENCES `lende` (`ID`),
  ADD CONSTRAINT `provim_ibfk_3` FOREIGN KEY (`id_dege`) REFERENCES `dege` (`ID`),
  ADD CONSTRAINT `provim_ibfk_4` FOREIGN KEY (`id_kryetar_komisioni`) REFERENCES `pedagog` (`ID`),
  ADD CONSTRAINT `provim_ibfk_5` FOREIGN KEY (`id_antar1`) REFERENCES `pedagog` (`ID`),
  ADD CONSTRAINT `provim_ibfk_6` FOREIGN KEY (`id_antar2`) REFERENCES `pedagog` (`ID`);

--
-- Constraints for table `rezultat`
--
ALTER TABLE `rezultat`
  ADD CONSTRAINT `rezultat_ibfk_1` FOREIGN KEY (`id_provim`) REFERENCES `provim` (`ID`),
  ADD CONSTRAINT `rezultat_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `student` (`ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
