-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2015 at 03:05 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `devsense_db`
--
CREATE DATABASE IF NOT EXISTS `devsense_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `devsense_db`;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT,
  `sessionId` varchar(100) NOT NULL,
  PRIMARY KEY (`cartId`),
  KEY `sessionId` (`sessionId`),
  KEY `sessionId_2` (`sessionId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cartId`, `sessionId`) VALUES
(1, '1234567'),
(2, 'A1hOTzfIzM'),
(3, 'n85JTUp3wp');

-- --------------------------------------------------------

--
-- Table structure for table `carts_to_items`
--

CREATE TABLE IF NOT EXISTS `carts_to_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cartId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cartId` (`cartId`,`itemId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `carts_to_items`
--

INSERT INTO `carts_to_items` (`id`, `cartId`, `itemId`) VALUES
(3, 1, 3),
(2, 1, 4),
(4, 1, 5),
(8, 3, 3),
(10, 3, 5),
(11, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemName` varchar(100) NOT NULL,
  `itemPrice` int(11) NOT NULL,
  `itemImage` varchar(255) NOT NULL,
  PRIMARY KEY (`itemId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `itemName`, `itemPrice`, `itemImage`) VALUES
(3, 'IceCream', 20, 'iceCreamImage'),
(4, 'Tuna', 15, 'TunaImage'),
(5, 'Cola', 10, 'ColaImageUrl'),
(6, 'Neviot', 9, 'NeviotImageUrl');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `sessionId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `password`, `sessionId`) VALUES
(1, 'asasdasd', '9803fc00636dcf4befc979bb32eb7303', NULL),
(3, 'asasdasd3434', '834fe5a648e1b164e750f49a7c71cbfe', NULL),
(20, 'aaaaa', '594f803b380a41396ed63dca39503542', 'n85JTUp3wp');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
