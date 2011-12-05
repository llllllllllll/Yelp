-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2011 at 03:20 PM
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
-- Table structure for table `PG_Yelp_option`
--

CREATE TABLE IF NOT EXISTS `PG_Yelp_option` (
  `yid` int(10) unsigned NOT NULL auto_increment,
  `pdm_idx` int(11) NOT NULL,
  `category` varchar(50) default NULL,
  `show_rows` int(10) unsigned NOT NULL,
  `template` varchar(50) default NULL,
  PRIMARY KEY  (`yid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `PG_Yelp_option`
--

