-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2015 at 09:36 AM
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
-- Table structure for table `personal_details`
--

use my_wiki;

CREATE TABLE IF NOT EXISTS `personal_details` (
  `username` varchar(25) NOT NULL,
  `first_name` varchar(25) DEFAULT 'Enter First name...',
  `last_name` varchar(25) DEFAULT 'Enter Last Name...',
  `about_me` varchar(160) DEFAULT 'Tell us about yourself in 160 characters...',
  `genres_of_interest` varchar(160) DEFAULT 'No genres entered...',
  `cell` varchar(25) DEFAULT 'NA',
  `home` varchar(25) DEFAULT 'NA',
  `work` varchar(25) DEFAULT 'NA',
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_details`
--

INSERT INTO `personal_details` (`username`, `first_name`, `last_name`, `about_me`, `genres_of_interest`, `cell`, `home`, `work`, `email`) VALUES
('Alex', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'Alex@gmail.com'),
('Brady', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'Brad@gmail.com'),
('Cat', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'd@d'),
('DED', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', ''),
('Derfd', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', ''),
('Dof', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 's@s'),
('Dref', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'ssmalo2@gmail.com'),
('Edf', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', ''),
('Edm', 'Sphelele', 'Malo', 'My new bio. Hope u like it.', 'Thriller,Comedy,nErotic Novels', '0749794141', 'NA', 'NA', 'Spelzm@gmail.com'),
('Fredd', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', ''),
('Jimmy', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'N/A', 'N/A', 'N/A', 'Jimmy@gmail.com'),
('Lol', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'lol@lol'),
('SSphe', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'ssmalo2@gmail.com'),
('Ver', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', ''),
('Verd', 'Enter First name...', 'Enter Last Name...', 'Tell us about yourself in 160 characters...', 'No genres entered...', 'NA', 'NA', 'NA', 'ss@ss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personal_details`
--
ALTER TABLE `personal_details`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
