-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2022 at 11:06 AM
-- Server version: 5.7.36
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qualven`
--

-- --------------------------------------------------------

--
-- Table structure for table `cfg_class`
--

DROP TABLE IF EXISTS `cfg_class`;
CREATE TABLE IF NOT EXISTS `cfg_class` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Class_name` varchar(100) NOT NULL,
  `Status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `ETD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cfg_class`
--

INSERT INTO `cfg_class` (`ID`, `Class_name`, `Status`, `ETD`) VALUES
(1, 'primary', 'active', '2022-10-11 06:32:01'),
(2, 'secondary', 'active', '2022-10-11 06:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Logo` varchar(255) NOT NULL,
  `Theme` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`ID`, `Logo`, `Theme`) VALUES
(1, 0x89504e470d0a1a0a0000000d49484452000000ea0000003d0806000000a3aff5d90000000473424954080808087c086488000000097048597300000b8800000b8801e58e29490000002074455874536f667477617265004d6163726f6d656469612046697265776f726b73204d58bb912a2400000016744558744372656174696f6e2054696d650031302f33302f3231d0e6cf3a0000200049444154789cedbd79705cd77de7fb3977ed058dc6d2600320099004080a12095ae222513, 'red');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Father_name` varchar(30) NOT NULL,
  `Status` enum('1','0') NOT NULL DEFAULT '0',
  `ETD` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Name`, `Father_name`, `Status`, `ETD`) VALUES
(1, 'student1', 'father1', '0', '2022-10-11 06:26:11'),
(2, 'student2', 'father2', '0', '2022-10-11 06:26:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
