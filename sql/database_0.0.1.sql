-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2019 at 12:10 AM
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
CREATE DATABASE IF NOT EXISTS `dbase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbase`;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `bitcoin` varchar(255) NOT NULL,
  `trans` enum('new','pending','unconfirmed','confirmed') NOT NULL DEFAULT 'new',
  `expected_satoshis` int(11) NOT NULL DEFAULT '0',
  `expected_usd` decimal(10,2) NOT NULL DEFAULT '0.00',
  `actual_usd` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `paytime` datetime NOT NULL,
  `times` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usd` decimal(10,2) NOT NULL DEFAULT '0.00',
  `send` decimal(10,2) NOT NULL,
  `eth` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `full_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_email` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `pwd` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `address` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `country` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tel` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `user_ip` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sq` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `sa` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` int(11) NOT NULL DEFAULT '0',
  `agree` tinyint(1) DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `md5_id` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `account_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD FULLTEXT KEY `idx_search` (`full_name`,`address`,`user_email`,`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
