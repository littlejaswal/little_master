-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2012 at 10:59 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ski`
--

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE IF NOT EXISTS `social_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `key`, `value`) VALUES
(54, 'twitter_access_token', 'a:4:{s:11:"oauth_token";s:50:"85807461-hwUICBZHhPR7PM6728tRe3v5aBMdWdK4pqt0PytE4";s:18:"oauth_token_secret";s:43:"xWGptEcW2cAUSs9kabjrYeRADMOhLR5V37tHP7Q8epw";s:7:"user_id";s:8:"85807461";s:11:"screen_name";s:9:"SkiMarble";}'),
(59, 'fb_299865633388242_state', 'acc190b0d270baab54f56af864d90d0e');
