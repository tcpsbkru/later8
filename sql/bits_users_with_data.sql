-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2018 at 07:28 AM
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
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `bits`
--

INSERT INTO `bits` (`id`, `user_id`, `expected_satoshis`, `expected_gvb`, `actual_gvb`, `owed_gvb`, `payment`, `email_sent`, `address`, `cus_address`, `paytime`, `times`) VALUES
  (15, 28, 16063, '1.00', '1.00', '0.00', 'confirmed', 'sent', 'n1ZFoZMq4SMVFoQ5fFYsXxbZthdKQHXZMT', '0x7B8b7bE3B77Aea368C36fAd4bdAfb012B650d6b1', '2018-10-14 14:51:32', '2018-12-14 19:40:58'),
  (16, 28, 45915, '3.00', '0.00', '3.00', 'pending', 'not_sent', 'mo4UeUzgnnup64wbqS9m1R8MC9mFTFVeaH', '0x7B8b7bE3B77Aea368C36fAd4bdAfb012B650d6b1', '2018-10-14 15:11:58', '2018-12-14 19:41:03'),
  (17, 28, 45911, '3.00', '0.07', '2.93', 'confirmed_wrong_amount', 'sent_wrong_amount', 'mfvUZhqRjJGgun4TsCdgSZbzG9U2xsspZ6', '0x7B8b7bE3B77Aea368C36fAd4bdAfb012B650d6b1', '2018-10-14 15:11:59', '2018-12-14 20:01:14'),
  (18, 28, 15660, '1.00', '0.00', '1.00', 'unconfirmed', 'not_sent', 'mqwDScpkfUtyvYogxFJoTYnrDG9MKeicWZ', '0x7B8b7bE3B77Aea368C36fAd4bdAfb012B650d6b1', '2018-10-15 21:25:25', '2018-12-14 20:01:21'),
  (19, 28, 0, '0.00', '0.00', '0.00', 'pending', 'not_sent', 'n1bKGaTtLDG4oJTDVihSNbwyea5Ns5KtoL', '', '2018-10-16 20:35:54', '2018-12-14 20:01:27'),
  (20, 28, 15560, '1.00', '0.00', '1.00', 'pending', 'not_sent', 'n2iHHmWr7sy3ynsRYyjUzkVmqarGKFZLtC', '0x7B8b7bE3B77Aea368C36fAd4bdAfb012B650d6b1', '2018-10-16 20:36:07', '2018-12-14 20:01:33'),
  (21, 28, 0, '0.00', '0.00', '0.00', 'pending', 'not_sent', 'mkHhqwk68PmeQgZju4iooVtoPSNwXaokW3', '', '2018-12-22 01:11:00', '2018-12-22 01:11:00'),
  (22, 28, 0, '0.00', '0.00', '0.00', 'pending', 'not_sent', 'mqCcR6V3rry7u1ZnpFqxeBTVigMv1uQyVw', '', '2018-12-22 01:11:50', '2018-12-22 01:11:50'),
  (23, 28, 52247, '2.00', '0.00', '2.00', 'pending', 'not_sent', 'murSkThWZ7AWks4GbcozuDU9BE45Xk5o61', 'wwwww', '2018-12-22 01:14:53', '2018-12-22 01:14:53'),
  (24, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n35VmUn7uFgPm1LoPTgM8vbsWVaUZ2JU44', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (25, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mtsMCfMr7wdnq8UABs6nzSNnGebFWiPTwJ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (26, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mtK4vPw76PngrVs3RC6uACogKqMudVwUMy', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (27, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'miiyf2xGsPY75XGsCZzS5VQDkwuUEzVRaR', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (28, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mp5dFHi2JcgYccMDVEaLpSFLsKpzQJWkX3', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (29, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mqBdgxAbKUiQF31714y4aCvZ3k9kp5C4NA', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (30, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mk7XfiFwxEcp3d1qhsx8Low9Svd6hzCfAZ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (31, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mfq6wzvgBPh97YJK9zEKwPZtd7bSrKxjYq', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (32, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mzGjTcov1mCYGssXkpGYVzHz1mb3Urqg9v', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (33, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n4cWTyJFsDMTtLjGbo24jwvaxTMHNbbyYw', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (34, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mwfxPrQ1QXmhz1behh3BrBc1kGbHPkTCAJ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (35, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n3gHu11PTyiCZb8HRjn8PAiPPkDiB41RfJ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (36, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mpwwxdYSKXf54PLFYiNjjKQ2wYEjYARmm9', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (37, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mjLNd8VMw972LYocqSowK5NHSxh49Dnpjj', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (38, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mpST1wKV8irYjU5g2w1qbx5tUkXjLmDh6u', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (39, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'msGZ7jEaJ2hahNTg25GfK7ZDxwEXi8fmH5', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (40, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'micwA4H4UU7FygAYmrN5iDYa6TvVnQT83v', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (41, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mzHJ57cVo8PmtkCNSkbKVgPxSRRpTZcfUa', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (42, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n4KtzqwX6xyN7QLngRT1DtB3vvkxByupt8', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (43, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mpCBMYhoncDjubYkzurd3XUVcnjcxPCVcJ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (44, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mw19g8XdZZux2UjJGvFHVPQ9Qg9xq79Rp5', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (45, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mkAMoUJzqnouUHRYhphvvnMAEdM7WjSH9Y', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (46, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mxRbfZBfHpa9QTaRuqASp8SPtUmkf1CCcY', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (47, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mgHsQdLatoKpvoKtQx85n3fx2yHEWkgVD8', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (48, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mnvDBABA7Pcz7bLzVA6yuvVnqGH7CvAogE', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (49, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mndEHFRNVssto6CfS6jVCzanFkUwUQX46n', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (50, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mfyyg2j3bMX7n3zHv2iK16KowFd2jGLMqW', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (51, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mgEGejyehu2QMz8qQTZy3naLxccGjR1jUG', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (52, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'miwcDkxBrx2HYzBNevA3jrHv28qVm5JyUB', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (53, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mnbVf3PSZsTeQe6pLLetYELxMNu8VwS2tt', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (54, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mru3T1PUmVbyF3tfTdFo1do9rM8EnLhYYk', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (55, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mvzk3b1LQqqq1iaNGYmDBTvZfsSVEwC3aa', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (56, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mgXGndMQivr8WxhKRULUeDD4xxSSQWNxUK', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (57, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'msgumHj8BheiAazeLLgCMD4G4yPhRwPXj8', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (58, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mwErkXTLDHX7ywm4wjHp2o2TmUphGFBiQb', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (59, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n4EnBc2cLX5GVzGZo2WcE5hNeMDLuBwDGS', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (60, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n2ekcSNgiu4AQVhDuSFPGpzePBTLuR2yXH', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (61, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mtUSWgYbiESBUUATHzxvpC7nS1695gocFe', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (62, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mxPtiqARmy6bbcfaiRxnNdtQTSLVGwacun', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (63, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mxtcw6Dz97BRc9nTuy8zDjQ2rdnjYnjc3u', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (64, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'msdgPjTH9BWg42CmTntupvdLKNh5NRaXwT', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (65, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mqPnXKGS217Gsxr5T9CtEBZtrMomhnodcV', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (66, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'my4yCoZPUpnoDeyx9gvuKY6N1xpTX7zkU5', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (67, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'moVc6JCM6S9pGkdGM3jbeVce4GuxcEo24r', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (68, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'msfF7c5ju6HdpRfymb4xqC8JC8yxDzes51', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (69, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mtyKREbAPJAJt6UnDtoKnFiKcNi8YMw9Re', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (70, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mtmyExMbvmodNou7oK8cv4UHmGHVC5XEoG', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (71, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mjqncbM2TRWnKyLveFpu6eBRANCAVuVyBV', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (72, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mseZWjGrMmfCgAsfZqkp7UcwNRXhW56w1D', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (73, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'muBAXksj9JKJHfCyJ5sBPcD5FrNp3D52Dm', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (74, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mv3ooJH7S6qzJbkKgmGGXmNtqfqnGsYFxe', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (75, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mse8jaTwWwH3Y1MAKvL8rqQnHDoqnJo16D', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (76, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mmTxTvd7kYJkAAQVzaWcwvCQbaKds2zgtj', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (77, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mnmhJ6K5aSE9aA7DMp8GcdMryprERTbKZ3', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (78, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mpHMCwQoJBR3oeiFVueaYmK7NUf9TaLEkG', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (79, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mi2LnVP66xX7dT5mkKUSkqTn31xj77BrCq', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (80, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'monV4gvm558rXb5ykHCsuMg6heYSsaQjbj', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (81, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mqECZyoWTc5QmKZhtZDMsvkPBdrdkY7GMZ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (82, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n2dagyeALYA2e6k1Ewt1nqN3Chpc4ZdFFr', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (83, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n3Z1TNNipwLfCMaNyn76BsY1Rw38sqTXgr', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (84, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mxQgZAjdApRZo7K3gQrvonEfJE2tQetKwt', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (85, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mqYjDymAe9wf3RcEuwq1q91FTNAoPe3Z8A', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (86, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mkLxCSfQzF3GoQRJfBgJR4jPDHiJbxw7PD', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (87, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n2QsAmVunpFEBiV7C6Pf9mhnTVU1T3KSxY', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (88, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mzbDkrdz7hrTRXs49HJyZraUSQ2fD4yeAE', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (89, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mvntG1bu9kiqdoAjbMZAtWRY6bnHbGQgC1', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (90, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mqUFfa8PBi88mpvQzfyVTagyNKMUt2iTxU', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (91, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mpdwE5Sqp1ECDPyf5ssXtkGQUcMxvzWw1o', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (92, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mpfQNftVCBLsfGGb4cakXV3Z7yzFHZmagM', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (93, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'n1hE734fhktkoTG74ctAauTzVprKPmLNnt', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (94, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mxxBn6GA83qajWE1LEA311zekp9FSeL3Pk', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (95, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mg4fM8wFVNwXqujW6CCpBJy7ZqtrPdeP1U', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (96, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mon76v1EpKFjR1UGduHUnPL2WmuBu3fH8m', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (97, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mvWLFQCUK8cXYbwXrgtCdEto9qmJqEsBtJ', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (98, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mk8hs8CmLWfGZQSjThKPdRUz8gcRFTrMbk', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (99, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mkp3MnxUrPa2VyKqVpSjhk1gdtzRQzrfLt', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55'),
  (100, NULL, 0, '0.00', '0.00', '0.00', 'new', 'not_sent', 'mygJRNboqiBVq8ad8kRY13ERqdztk2JHJc', '', '0000-00-00 00:00:00', '2018-10-07 11:48:55');

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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `md5_id`, `full_name`, `user_name`, `user_email`, `pwd`, `address`, `country`, `tel`, `fax`, `website`, `user_ip`, `sq`, `sa`, `approved`, `activation_code`, `agree`, `banned`, `account_date`) VALUES
  (1, '33e75ff09dd601bbe69f351039152189', 'Alexander Lisak', 'Alexander', 'alexlisak@hotmail.com', '8dc5983b8c4ef1d8fcd5f325f9a65511', '5 Mendip Walk', 'United Kingdom', '07531953527', 'da11', 'huy.com', '::1', 'qqq', 'Yes', 1, 8447, 1, 0, '2018-12-11 00:00:00');

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
