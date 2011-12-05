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
-- Table structure for table `PG_Yelp_api_key`
--

CREATE TABLE IF NOT EXISTS `PG_Yelp_api_key` (
  `ykid` int(10) unsigned NOT NULL auto_increment,
  `consumer_key` varchar(50) NOT NULL,
  `consumer_secret` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `token_secret` varchar(50) NOT NULL,
  PRIMARY KEY  (`ykid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `PG_Yelp_api_key`
--

