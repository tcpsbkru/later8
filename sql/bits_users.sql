-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2018 at 07:42 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbase`
--

-- --------------------------------------------------------

--
-- Table structure for table `bits`
--

DROP TABLE IF EXISTS `bits`;
CREATE TABLE IF NOT EXISTS `bits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `expected_satoshis` bigint(20) NOT NULL DEFAULT '0',
  `expected_gvb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `actual_gvb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `owed_gvb` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment` enum('new','pending','confirmed_wrong_amount','confirmed','complete','unconfirmed','canceled') COLLATE latin1_general_ci NOT NULL,
  `email_sent` enum('not_sent','sent','sent_wrong_amount') COLLATE latin1_general_ci NOT NULL,
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `cus_address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `paytime` datetime NOT NULL,
  `times` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `md5_id` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `full_name` tinytext COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_email` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pwd` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `address` text COLLATE latin1_general_ci NOT NULL,
  `country` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tel` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `fax` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `website` text COLLATE latin1_general_ci,
  `user_ip` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sq` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `sa` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `approved` int(1) NOT NULL DEFAULT '0',
  `activation_code` int(10) NOT NULL DEFAULT '0',
  `agree` int(1) DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `account_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users` ADD FULLTEXT KEY `idx_search` (`full_name`,`address`,`user_email`,`user_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
