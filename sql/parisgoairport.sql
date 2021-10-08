-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2013 at 10:16 AM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `articles_parisgoairport`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `coldate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `coldate`) VALUES
(1, 'asdsadasd', 'niklas@hotmail.com', 'sdasada dsad ', 'asdköl kölk adsölkda sd', '2013-07-23 11:19:22'),
(2, 'asdsadasd', 'niklas@hotmail.com', 'sdasada dsad ', 'asdköl kölk adsölkda sd', '2013-07-23 11:21:42'),
(3, 'niklas', 'niklas@mail.com', 'my little subject', 'and my message indeed', '2013-07-25 16:07:02'),
(4, 'niklas', 'niklas@mail.com', 'my little subject', 'and my message indeed', '2013-07-25 16:10:49');

-- --------------------------------------------------------

--
-- Table structure for table `personnes`
--

CREATE TABLE IF NOT EXISTS `personnes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coldate` datetime NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `arrivaldate` date NOT NULL,
  `arrivaltime` time NOT NULL,
  `flightnumb` varchar(255) NOT NULL,
  `airport` varchar(255) NOT NULL,
  `terminal` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `tfairport` varchar(255) NOT NULL,
  `nbadults` int(11) NOT NULL,
  `nbchildren` int(11) NOT NULL,
  `shuservice` varchar(255) NOT NULL,
  `parisaddress` varchar(255) NOT NULL,
  `shuttlefee` int(11) NOT NULL,
  `way` varchar(255) NOT NULL,
  `returningdate` date NOT NULL,
  `returningtime` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
