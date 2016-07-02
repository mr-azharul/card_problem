-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2016 at 11:36 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `card`
--

-- --------------------------------------------------------

--
-- Table structure for table `get_card`
--

CREATE TABLE IF NOT EXISTS `get_card` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `yellow` int(9) NOT NULL,
  `red` int(9) NOT NULL,
  `cause` varchar(255) NOT NULL,
  `endtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `get_card`
--

INSERT INTO `get_card` (`id`, `user`, `yellow`, `red`, `cause`, `endtime`) VALUES
(1, 'azharul', 0, 0, '', '0000-00-00 00:00:00'),
(2, 'rafsan', 0, 0, '', '0000-00-00 00:00:00'),
(3, 'rokebull', 0, 0, '', '0000-00-00 00:00:00'),
(4, 'akif', 0, 0, '', '0000-00-00 00:00:00'),
(5, 'shuvo', 0, 0, '', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
