-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2015 at 07:24 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_wiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_password_recovery_tokens`
--

CREATE TABLE IF NOT EXISTS `user_password_recovery_tokens` (
  `username` varchar(60) NOT NULL,
  `token` varchar(160) NOT NULL,
  `number_of_times_recovered` int(11) NOT NULL DEFAULT '0',
  `last_recovered_date` datetime NOT NULL,
  `token_expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_password_recovery_tokens`
--

INSERT INTO `user_password_recovery_tokens` (`username`, `token`, `number_of_times_recovered`, `last_recovered_date`, `token_expire_date`) VALUES
('Sphe', '456cc61e1709ed7236dc11fbabeb5a6e', 7, '2015-10-09 10:13:09', '2015-10-09 10:43:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_password_recovery_tokens`
--
ALTER TABLE `user_password_recovery_tokens`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
