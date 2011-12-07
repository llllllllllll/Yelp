-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2011 at 08:28 AM
-- Server version: 5.0.77
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `plugin`
--

-- --------------------------------------------------------

--
-- Table structure for table `PG_Yelp_main`
--

CREATE TABLE IF NOT EXISTS `PG_Yelp_main` (
  `pm_idx` int(11) NOT NULL auto_increment,
  `pm_userid` varchar(20) NOT NULL,
  `pm_version` char(5) NOT NULL default '1.0.0',
  `pm_iv` varchar(50) default NULL,
  PRIMARY KEY  (`pm_idx`),
  UNIQUE KEY `pm_userid_2` (`pm_userid`),
  KEY `pm_userid` (`pm_userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `PG_Yelp_main`
--

INSERT INTO `PG_Yelp_main` (`pm_idx`, `pm_userid`, `pm_version`, `pm_iv`) VALUES
(1, 'pr', '1.0.0', NULL);
