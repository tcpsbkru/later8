-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2019 at 12:07 AM
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
-- Table structure for table `transactions`
--

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

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `users_id`, `bitcoin`, `trans`, `expected_satoshis`, `expected_usd`, `actual_usd`, `sent`, `paytime`, `times`) VALUES
  (349, 1, 'mz6hq6XEzTiwqQqkZoJmZUMNj5GpESD9qf', 'confirmed', 29227, '1.00', '1.00', '1.00', '2019-02-05 21:58:36', '2019-01-21 23:37:07'),
  (350, 1, 'mgCgD3R9nP9Xvc7e5NHV73or19xhGRn3p2', 'confirmed', 58418, '2.00', '2.00', '2.00', '2019-02-05 22:29:17', '2019-01-21 23:37:07'),
  (351, 1, 'mszT3BdS2mYwUys7KeyDFYDxYUnTi9QhNN', 'confirmed', 175393, '6.00', '3.42', '0.00', '2019-02-05 22:32:28', '2019-01-21 23:37:07'),
  (352, 1, 'msWqfGk13JCrCt8ZLBDKdsbULxVWP2pKii', 'confirmed', 16959, '0.58', '0.58', '4.00', '2019-02-05 22:42:18', '2019-01-21 23:37:07'),
  (353, 1, 'mkYixjHHK3ezV32nU2ichZcRwZKL9cq57V', 'confirmed', 146108, '5.00', '5.00', '4.00', '2019-02-05 22:46:04', '2019-01-21 23:37:07'),
  (354, 1, 'ms7QQWz1VcSgzUW84BdyzX4bQYf87An2gV', 'confirmed', 87664, '3.00', '3.00', '8.00', '2019-02-05 22:47:04', '2019-01-21 23:37:07'),
  (355, 1, 'mrdssWu7hqrwuLvoAVdVg7heLDK8A18A7Z', 'confirmed', 116887, '4.00', '4.00', '0.00', '2019-02-05 22:50:56', '2019-01-21 23:37:07'),
  (356, 0, 'mrQccuZcHpk74nMxgZ2uP1YKoZohLAS7vn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (357, 0, 'moK7uZREHaxRMn1AtCG2gKSM9kaPmtWMzo', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (358, 0, 'n3xej4LUv6dy94QoPhydNuGiUHyUCaxtQS', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (359, 0, 'n37bvDNmmhfeSWxj6LgYFACgzZB4ESAYiJ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (360, 0, 'mqPfBaDgN82gAGDzqggqFmsjCzoNvmWAmy', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (361, 0, 'mgQ73MdF72FRexDbjwiPsukGRLWVfkW8Pf', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (362, 0, 'n4Npd9QckAg5W2uKx5nfSoTC3bhyxPGWUK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (363, 0, 'myML1qUy8W412jmk93LYe8jYMU1XXveX7M', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (364, 0, 'moKeY2qeYysSFhsZSfDEwYtkq4fegZBTnR', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (365, 0, 'mggp2HXVyqFSBpTs658whfN96RLkMGRhrD', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (366, 0, 'mpfw1jU3f4abAmLYX36rpmrAK2UhWiCKcd', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (367, 0, 'miWSLckaZvw52gzgTiL17F1vqASrGdmZDD', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (368, 0, 'mgift2iAknk2HUHnr6GRFJMN1Fs94ag7gS', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (369, 0, 'mreL9839tFfu2JFtoiS6qtCXGXFigFEKsE', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (370, 0, 'mo9bgZoXHPSwzTdRemtzY2t1rG5W4UAy1k', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (371, 0, 'n2wQgHjy87ypFZ7K5j1mD2Sr4xwFuP4raB', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (372, 0, 'mko5rd8aY4zZEXMgy3Fc2sYA6EXxvpcBoi', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (373, 0, 'ms9KGeLbVaKRgdWtLHuVCq5dgK82kMCpeb', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (374, 0, 'mvVAvZn2GRwuKjw494eAXPgkZJuYngh9xC', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (375, 0, 'myzjw67MK8QJGdBMhu7pYEH8jVYzfzHT1v', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (376, 0, 'n3y8uc8VYG6JFxUaa78bADhvM8FuKTU8r6', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (377, 0, 'moKDgjU9DFRWxUTXUsJAfzUKMnCx5daiiL', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (378, 0, 'mxK246tdZUqFECXyMnWxhVYMMbRSsEB8YY', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (379, 0, 'mmRCB1NbRfrqKoF2dzkgGcXtmJY4MNBk4s', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (380, 0, 'mvgnfEDKXZgojWQ54QqPQT7jfdCLeVKeJQ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (381, 0, 'mp1FcebLiXSb6pSjWdtauCW2MVtAN4Pj4P', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (382, 0, 'mvW1g7NmNocm8bqeJTGxGWc1g8a8zeZRZU', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (383, 0, 'mw6pyVSFUvmuryBt2dyLs1em3gPzNLGnUB', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (384, 0, 'n1J1sZCsbQuSbT6VtoTCvRZoaCbuFhQL31', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (385, 0, 'mkikTcgzmpq3pJYj6zz1vFLNreu3Urz7Ct', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (386, 0, 'mgh1MzEWJhaz5RcYd6yiGDtezwmfFW7G5u', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (387, 0, 'n1MF35Ag7B6LzknP2PVPhkxSTgmTUzfCZ1', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (388, 0, 'mjp233Tb8Lwear1U1t7aFDe1RTzGuG266A', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (389, 0, 'mvmo73VUDs2972U4j6gaaKT7HCjEg3difa', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (390, 0, 'mwszD4cBfyHhkP4heZzoEpeLLLEYgNaddi', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (391, 0, 'mmx5MkvNhmKxHouDKwKqUsgrfPR3sDcMem', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (392, 0, 'mjcoeDWxBgWiAu7hc2HQYrCC3GhznBrJqW', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (393, 0, 'mwMHcWUhHYTnvSevQoYWFTnnfUcWLTqzp3', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (394, 0, 'mtJXataqoQeQg4D6fTTCuqo8kUyvb8fbZq', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (395, 0, 'mjt25bxdkEfmQya55cNyR9G2caxU37gZNn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (396, 0, 'mtGHmrDG7CFUMrEzYqKesurUrRu3e5kLtK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (397, 0, 'moWMjmdCic763aE4L24VhBhdm3Euj6mykt', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (398, 0, 'mrtr4rkPDXQ7GjA9HHEd9rrbAcDenktbTR', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (399, 0, 'myyBMXy29MTainYTjSL9nhsVFnYrw2EE2B', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (400, 0, 'mgsEoTetFFTAtWGzqY62tetaEStdS35mmt', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (401, 0, 'midvNVSbn4xYiBnsFRNa5z2hLeyfzEZrnB', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (402, 0, 'mrDUojMbymnG91gYQh7mqAiXLVzzMWv62T', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (403, 0, 'mvBB6PLqfrGZ6E7i21QdhSCDwAmHbF6MKt', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (404, 0, 'mjNHPhgDZntPsvYS9y1tUncqgQh4kLmBSi', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (405, 0, 'mnwM5YmpYeKkpKwJ9jV3WcUTvTsh9ogWxi', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (406, 0, 'mh6995fv6U6rboLbrDQsuyfbGgPJMWkMB7', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (407, 0, 'n29R1YMVJRUCrrjGcgeMFh1FMFEa7EqWZS', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (408, 0, 'mqm29TaF4MbNVzSbguXhAQL83i3njUspTs', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (409, 0, 'mi9XyZAqawkZekb8pzXBqoSce3xsH5dFAT', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (410, 0, 'mm26whGrR7GTh9WzWuZCpWBwhNeyacj7Fg', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (411, 0, 'mzessY1dda666s3s82HRQKZrUXQKAms6Sd', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (412, 0, 'mqzF3fVR4gXQ1CvBrWjXGxv2zfgAGvAWfc', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (413, 0, 'mmsXVPXcFDc33x8gA2G5wFp3qi86yS7KMP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (414, 0, 'mgYM97qtJn9QYgFoc7MZDirp5qQ9DLiZ1E', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (415, 0, 'mffYobEAxSkpgrrQRLzbwEVf2DGe8LUMAB', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (416, 0, 'mhv3Sh8jJnHdZPahuvBuRSrpY69ByZnLFA', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (417, 0, 'mq9b6qf4RwbeBTamQV8pDGMe9F4Xx8RjpP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (418, 0, 'mgwpn68oVyEctCEGoEYwNrsDjaNwBTPexn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (419, 0, 'myNzkHSCSkS6gz92Bb8teHb4KdkqCmeCgb', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (420, 0, 'n4Woj5G3SZ5HWd3j42rcQaygtoaQd6Nnbr', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (421, 0, 'n1JEUxB7KiDFWMw5w9XbD1DhD2f5evZwDT', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (422, 0, 'n1AG6jW8PsEXpmTwFvioSjFTaWCocyJPrb', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (423, 0, 'n24joppQFsmJEWjqTjcZENJ6ctjHKTsRyv', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (424, 0, 'mwD1P1hcngELZZExogfhcmawoPVRpALSPK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (425, 0, 'mmAYEDCF7tyJiQPCCQjwZujD9duriHmznM', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (426, 0, 'mqkd9Zs5s6fZK7FWpPcw9rDBq11vZuUJqH', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (427, 0, 'n2vcsye4WsnaV28iCp12ZgGfAFEEexwLkC', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (428, 0, 'mnsgDZL8oXuDeyYHYSTW5zT5HDRa5FtbN5', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (429, 0, 'myM9sWrovVce5NY3FGyVkuxa63NktX8zYZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (430, 0, 'mqxpXRGEcUw8Jx1CZgdy9HhEQgWsA2LtoJ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (431, 0, 'n1g4JM6sbDz4rK81wjZaQs6aBfQ5kThaF2', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (432, 0, 'n4r7sPpnp2c8mot4qocTgJQyfMqfV5t4ho', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (433, 0, 'mw9yjkTfEZcK8tV4ne29iLPEZ5L6mnPhvV', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (434, 0, 'muF5TPWbb2Rgr1pNVyrCZePycMsHwY44F5', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (435, 0, 'mkCNm9UiyfTmHgncw49kuH8PZFdrg8SizZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (436, 0, 'mmWNGLkBzr7hCyGvuqasd8TpUAh9U3FvH9', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (437, 0, 'n23XA32X7x3UcKmXA89Vb5w8Vpp9PsxYmR', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (438, 0, 'n2bZVzKrzFvNwZ76wUmCJmVMDEdJHmU4GE', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (439, 0, 'mx6i6KQZ38jkG51Ywgs71YA2ayCWewNZg5', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (440, 0, 'muXu6DP1Tng8LVu21qMwHddSbyNQAmHeG5', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (441, 0, 'ms9HyrGsbTV8iyCZXzN7xi7ZKQBcLhBmNA', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (442, 0, 'n2haUqXQDqeWHcURoawYav7AWXD91FDdBD', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (443, 0, 'n2JrNGkALhWGq38UQqBvQXJseJY2ygrXdK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (444, 0, 'miDo2SeCw9t2FtwxEJYG2NqGysBLmrnVok', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (445, 0, 'mvXoD91keDPho27L1bvwCmgjCxSnkCKZzd', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (446, 0, 'mgRdGLS6uGwWzxXsqvarn82xyJz9NVpG28', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (447, 0, 'mspToV7kpsZ7nK5MQE7vhTz59fEDLPuqSN', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (448, 0, 'mj552Nwq1y3xWgR7CRoR2ijXyfMoDxm2aK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (449, 0, 'moYe8tMBkzR5CPj7xqZ5a1JHyGDY9EQNqT', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (450, 0, 'n3Zcqw1TM6WXTi2zqVdNiFaN4mZMrWrK8h', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (451, 0, 'mgjwobiWu2stDbbFHXYaUZPf6AYVo4R44i', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (452, 0, 'mgtuMJ61GZXFWTErjtUXZatpm85fBXVRYZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (453, 0, 'mqSBzFc3UJYNWzaLbdCtXHgh3Mncx8GSXh', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (454, 0, 'mpSXVJovB5dgEy176Eztpkz2QJo7SoLQXn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (455, 0, 'myfc3wFWPgbKXYkAY73KxtS53HRnqrqpSa', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (456, 0, 'mxbiKUoVL46f36SViRdWe4oeBmjrNueP52', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (457, 0, 'msm3mZQJ5mTzrs99RDK5Nj74X8svkr9xrz', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (458, 0, 'mifPhNMYDq792H8uD39V7zGAzDVCgCRMw6', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (459, 0, 'mpBKGnhDMDSMD7WabjG3zyuRmf86MSnebK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (460, 0, 'mfjtQwiZP4g7Jsh9Y7Lr44WwfJhkAAmZ42', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (461, 0, 'mgLZTh7fpmK1qDAqf8Tfu22XqmeMoRCqo6', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (462, 0, 'mgk954DRpkXp7tKdsCWsMLr6jb1jz6dq5m', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (463, 0, 'mjEDD9gBRmU8iEntNepcWRKArkGb3DaXtH', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (464, 0, 'mjbC8wSiWfqqxVKJNnFm4HUNKsRdXePYjs', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (465, 0, 'mm8PsHNUniAn8XuW9weoj2an99uQAV5Yzz', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (466, 0, 'muuML5gWaCE4MoQjxGKNf83oAXpnY9wMnY', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (467, 0, 'mq99er1pPoEZ2c9qj5LvBAztF7Z9yi3tv2', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (468, 0, 'mqNBcURDameHvfL4sZcdhwZqZMnZBZGJAB', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (469, 0, 'mk3DkNASa7f4iN9CKzNjUNTwGgA3emMMMM', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (470, 0, 'mg5KftsfviM9RGGWNuVs8Xy6Vv3jewW16Z', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (471, 0, 'muyw8D96H3ufevwtkYnuUGurwS7CturPAe', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (472, 0, 'mi4AeHwBVZQPS4aGuvXB8spZJEUUi1coog', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (473, 0, 'mw6Gg5ov5Vf4rF6s9Ggt4EioHYeeTcpYVU', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (474, 0, 'mygsdN7cBSPdKqmYWsLHKqBgeGQcSwMqFo', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (475, 0, 'mqVTsBBBGTAvghXxqzkRkmNE6XWyk1oaLo', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (476, 0, 'n165yAEZJB2GikxmXdvxWGazQ21eBycBqZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (477, 0, 'mz2924ZJB4aU6M1Puy4YdeEcgVwnCpu9kH', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (478, 0, 'mtt6qGAJuA86gWB3MXtnUw3Br7odHWZoSP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (479, 0, 'mj8zZgTBEFbwrJPtNEyBAxWY3b5eo9unJd', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (480, 0, 'mmXkw7i8ffM9HfbhMuhwmn1TYU1GpexzTx', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (481, 0, 'mttYoHjzykma61qFBDa7jgVhXk4ssXgKdZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (482, 0, 'mxVLNzoaJM2EGGPb4vcq1xov9LKoHJNFev', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (483, 0, 'n28jyRV3pAvDA8hQDaPJ8kTkRyrNj2kNeh', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (484, 0, 'mfgCx2g4PTghn7wvx99WdchoMS84aR7jxA', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (485, 0, 'my3DXB1hDkSRZwdsJ5WGogmjVvcw3S1nZn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (486, 0, 'mzmuSYEXgJwPPyaxUS1Z8hn9mBe2TFzT2E', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (487, 0, 'mvDwqdqNVLFkkZEbfGc2VxvGU4e6JkVYUu', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (488, 0, 'mxz7aKJR1KnUomszsxNiGgiu47t8JBg8Sc', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (489, 0, 'n3mk3R5SLmVSvChegZfD8tbgbfSXvmyux7', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (490, 0, 'mqcrv1TFQVSnhzsw2ZposByGpcqNJ9Ryv5', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (491, 0, 'mmaZxjxzDpq1mgUj4xK8d6GjtdFXZCHJJd', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (492, 0, 'muJkqALQebkNEU4ps9JcqRQDe3vt2CcNQx', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (493, 0, 'mibjLSccAiFCgZdGQQx8WF72fFJDpe7gao', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (494, 0, 'moLEt6gZKvMDQcuMby9JNPVrXBkdApCna6', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (495, 0, 'mpDwRXhbmLiB9oXTJFFekvVmBXPXZyFVQt', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (496, 0, 'mzRmZcLfLCQT8myyjKe69ks5QcyAjVRDdz', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (497, 0, 'mjepPs9R5ZZPJEqWdVB2Lo5yoL2srGGBrp', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (498, 0, 'mnggZuZaow7ZSLy4UneQHY9VYzftKjRCTG', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (499, 0, 'muoLJGLNQxyCsE5qybZ1aQ43X5tChvNHjD', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (500, 0, 'mvfiP4mpMzUZ4Tg6eaSxMBMYX4yRxaZYeP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (501, 0, 'mihGuxx7Uk7iUpTFPiTUsaNuG7Zu43Fe8r', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (502, 0, 'mpFSNvVjswe6i5SuUchBjFvsVbVLMtqmAv', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (503, 0, 'mnK8pvFkTVJNXJzbqha1ordP187oMJikGn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (504, 0, 'msM489ZEweGCJsYCmnJeZGHnsbtnQtFbgK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (505, 0, 'mznU18VXVUPmpwwZm4zBbnd7ExnYRi8igg', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:07'),
  (506, 0, 'mrcM2w4GQ67C3GxyvZsDzCD3kALkDg6df4', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (507, 0, 'mhVcbkK82YecFPxXtT5Q8WtAARwkn5c7Ly', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (508, 0, 'mkzg6WaSRQ6VS8oUnVGhuz8k4rUitwGLQd', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (509, 0, 'mxgJLAbqbfAokQX6ZAzeBAWBwqX6YHSR5g', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (510, 0, 'mjLu6nEv5z97pQaA4a4fsqX9LweW9WrHzN', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (511, 0, 'miXhMw4mGFGdGwEhjW6cWUEihB3bBZ8Pp4', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (512, 0, 'mosE8nmNdf6Hh3pervJD3ccXhA7GodyUgP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (513, 0, 'mfa8anYz3wdQqQmi23xBcSBfZBaHGHsVgP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (514, 0, 'mp5Qvn45ym7eHhMgpm94T6GENKsuM1eaRK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (515, 0, 'msRmzyG3RCeYGGptP2v96RwQgKjezeyf7H', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (516, 0, 'mpbLKsmkqjHqVF4Z6Eb8P7pXgWAb4e6haW', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (517, 0, 'ms7NdaV6JwCumcKzaxFug8xZwGEyr2naMn', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (518, 0, 'mvaaKtmU7boqcEQJ8PrBUPjxM8mKkdj5Jx', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (519, 0, 'msq3RpXA1SpHfSeJBtbgo42zPdivmEeykK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (520, 0, 'mxq8X1aAE9UwPaMxuSUiTS6AE9oSagrLjS', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (521, 0, 'n1LSKmUHC1hFgzQAacavUrkE11wrBUKxov', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (522, 0, 'mx8rqMDNq1pyiKssp4WWZiY8v1hJJRJXo1', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (523, 0, 'mmBCpbwfneGw6VkkoyjLJE2EbV6g5xnY95', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (524, 0, 'mqC5YdoUaR4JES1EGYZC1C7aFFB6nhFWoU', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (525, 0, 'mgGcBN4qy2sXDr2tbfT1NdMk5ktFKq9Qv4', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (526, 0, 'n2yBv62N7KDDHzTzj2eTYMHfk4ENAssLTB', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (527, 0, 'mjotLCSKC9QQkYarAkUMKNRJcLresQibgF', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (528, 0, 'mnSM4QS5iCoQgVGu6WT3EFhrvUb24pfCxv', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (529, 0, 'mzGGN7ZuKBh5GNfYa2KzBt7N1S4HSBDjZ9', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (530, 0, 'n4egkhvtoPHmk8pYUjBYUfDLTRFvbnXS9h', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (531, 0, 'mrKhnaFZTGG6F5bXxhMaLRGQoNVaghRhxm', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (532, 0, 'mxdDRmihomAcooAP7YhtjrPtCsbF7zsxam', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (533, 0, 'n37LGEpGRtsg3i8crh7gwP4kXNwMn17fPu', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (534, 0, 'mgnZzeaSwA18kMRYTzNmE7ruyWLMcbov4Y', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (535, 0, 'mqQo4xgn7isbbMoDqAFnhC3CfqF9zR1phY', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (536, 0, 'mn4wQcjteg8GSg9VQ1EDNYL4L4aepzt2Nq', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (537, 0, 'mgWVqbuDX5iEvQVxBXhadAvqXuNMgE6PBo', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (538, 0, 'mjbFxS4LM3Vf3RVkue3iVTwiohyPmZjc4P', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (539, 0, 'midtrYK8LcMMezTf5dFhrRoXtbcwQJgEW7', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (540, 0, 'myZPjmmexVVq8mnHCoZJkZFRi23D6uhWGC', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (541, 0, 'moqmk3Zp5PEnSFBmeHAv9P8UjwiL3osAEy', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (542, 0, 'mrPaYtwWiKfaPNsMdHEdtMc96CahxAydrZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (543, 0, 'moP5Caa3jEL2YrpTDdsMRJySXQUbZApnyK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (544, 0, 'mnCQ7yXjxXyrr3hifmKKNUUFcUFRGqXCm3', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (545, 0, 'ms5Q2gUFAzppYgy3vgzGCeEqoB92Uk7QpS', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (546, 0, 'n1EdNVdqgaLcBRCJD7CQCgk28iJPsjoXqH', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (547, 0, 'mndu4HmioWQiPnQtaRewb8NYuDsg8kEqx5', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (548, 0, 'mwHW54uzTjrkAZovq5NBWnSY2CfiZMWedY', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (549, 0, 'myDjhJxsDrx8ZKfkx2rV2RkY1NKSby9VLk', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (550, 0, 'mkVYgL1rDKe7N7xCd5LAs6u6ugAgb8obvL', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (551, 0, 'mmKSXUYWRdnWsVZt6c7Gt3trjCN3mJkj9x', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (552, 0, 'mrc2C8hrTiTbhvfop3m4c5HNSeYDp4uShh', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (553, 0, 'mqB1n3ByThpPTntmk8GZ7SipXBhF2gW21M', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (554, 0, 'muntwKvjCev4cr2sd5wtqifwTctcpcAbLh', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (555, 0, 'n4FD5BdpSzWAKxncPRQKAjkZaNUi1CYGCN', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (556, 0, 'mt6q24js5cpxA8dJLcb71Z3XW2XrL5wymE', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (557, 0, 'msh7UWJ3kqkxNZuRF3gqWa3c38ECpVt4z3', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (558, 0, 'mwQDetMXSqBbsdmjaz3XLNBivtY7fSqdrw', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (559, 0, 'n3SB8p76yaHn8unsKoqYFzupBpptRZrCo8', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (560, 0, 'mhSFWPPBkCxd31WnD72WkFWKhWTmwdfi2U', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (561, 0, 'mgrn1oVAfJEfsxMMSfdFqL8gjuwQ2kQkq8', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (562, 0, 'mgPERXNwRazjFpZfqJ9i348fwEhN9XiUpz', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (563, 0, 'mtAvxgpkmN1qmFkNJa5pVLRjmmqGUkdMgm', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (564, 0, 'mzys8yEQ4JpSYA2D7PHuq5nqavD4hY8j1W', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (565, 0, 'mhbT4Ur88Hk5XZ9jbwt5UuhuCg8cW8jS1s', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (566, 0, 'mw2jQRC4GAX4K2VgmQZnWSVMCaC6XbLBgK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (567, 0, 'mm1AzMNVPL6tY5HXFeKDkg82Ub9NX7kCFM', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (568, 0, 'n3JRzhX6Tbk6knDJEXj4pgcaV24FgVyhQq', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (569, 0, 'mvGDZpJji69rrDJdTyWHwA4mCfkjbKkPfZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (570, 0, 'mwPrcYSqfvgXX7JR26B6ejRCSnUaH55qTP', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (571, 0, 'mtpCa448troeNS9Mo6cWcAmZdtQVCUWHsM', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (572, 0, 'mfmk52UYBXD6H1dU8XepXE9kb9QcAyzAne', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (573, 0, 'mo4EcbAPfBjWbBDTnJKhrhLZ37SnV6CNpr', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (574, 0, 'mr7LtZgXa6UZR2haiiW277gawfNZwD7RBC', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (575, 0, 'mx3x8PxEkHFqNCgvHaYYLuLVa5EnDN6AvX', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (576, 0, 'mouzedJCqH1KQTj2SctTE1zGBbX7miHL8b', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (577, 0, 'mvvZrmNuMkVDyaQuiRK8E9qfF6HzAVpcnG', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (578, 0, 'n2cqtBn2msqcTk14kq51iKondLMjJVP4td', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (579, 0, 'msHPdD7cqvXoHomj6zxqbCrmmaJph146NZ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (580, 0, 'mwdSL5LHqjmwxMVZz9ojgEuo9HoZFJFf7J', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (581, 0, 'mpVxebtzbtyHZnJFJRtbp1B4R9edsEjgKK', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (582, 0, 'mzMtaU9fMQ3JSdA9FkeP52FrQiUvHCBGCA', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (583, 0, 'mxcdd8X8EihoJYcr5FmMjAUyGLL97nRBeL', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (584, 0, 'mupDQrWYDH3aGpM6octE3GD5oHoixELKAq', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (585, 0, 'mv7QbgZn83LjUF9M7wrAfGXJuJ7CxYUT68', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (586, 0, 'n3goo3rRoWkk6k92RrxcGkuFhmus4vS9wG', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (587, 0, 'mpiHcWxmTyHaHyLr2yrfbdw2P94qX1pnZL', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08'),
  (588, 0, 'minUX1SWqJfTR9iLEkBnNDe6gRpRurmMvJ', 'new', 0, '0.00', '0.00', '0.00', '0000-00-00 00:00:00', '2019-01-21 23:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usd`, `send`, `eth`, `full_name`, `user_name`, `user_email`, `pwd`, `address`, `country`, `tel`, `fax`, `website`, `user_ip`, `sq`, `sa`, `approved`, `activation_code`, `agree`, `banned`, `md5_id`, `account_date`) VALUES
  (1, '19.00', '0.00', 'snsnsnsnsnsnsnnssnsnsnsnsnssnsnsnsnsn', 'Alexander Lisak', 'durik', 'alexlisak@hotmail.com', 'e11170b8cbd2d74102651cb967fa28e5', '5 Mendip Walk', 'United Kingdom', '07531953527', '', '', '::1', 'da', 'Yes', 1, 1803, 1, 0, 'c4ca4238a0b923820dcc509a6f75849b', '2019-01-17 07:22:47'),
  (2, '0.00', '0.00', 'hdshhs', 'hshshs edhdhhd', 'Alexander', 'tcps@bk.ru', 'e11170b8cbd2d74102651cb967fa28e5', 'hdshhs', 'United Kingdom', '', '', '', '::1', '2ertyui', 'qqgggg', 0, 1144, 1, 0, '', '2019-01-17 20:26:15');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
