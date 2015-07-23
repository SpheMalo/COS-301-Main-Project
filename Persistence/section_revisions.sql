-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2015 at 10:53 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

use my_wiki;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_wiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `section_revisions`
--

CREATE TABLE IF NOT EXISTS `section_revisions` (
  `book_title` varchar(160) NOT NULL,
  `section_number` int(3) NOT NULL,
  `last_edited_by` varchar(40) NOT NULL,
  `date_last_edited` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `section_content` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_revisions`
--

INSERT INTO `section_revisions` (`book_title`, `section_number`, `last_edited_by`, `date_last_edited`, `section_content`) VALUES
('Groceries', 1, 'Edm', '2015-07-22 18:17:55.000000', 0x4368617074657220616464696e6720737475666620616e6420737475666621210a0a4d6f7265200a0a5468697320697320676f6f64),
('Groceries', 4, 'Edm', '2015-07-22 18:17:55.000000', 0x4368617074657220616464696e6720737475666620616e6420737475666621210a0a4d6f7265200a0a5468697320697320676f6f64),
('Groceries', 3, 'Edm', '2015-07-22 18:17:55.000000', 0x4368617074657220616464696e6720737475666620616e6420737475666621210a0a4d6f7265200a0a5468697320697320676f6f64),
('Groceries', 2, 'Edm', '2015-07-22 18:17:55.000000', 0x4368617074657220616464696e6720737475666620616e6420737475666621210a0a4d6f7265200a0a5468697320697320676f6f64),
('Between Brothers', 2, 'Edm', '2015-07-23 08:44:07.000000', 0x537175617265203120627275682e2e0a0a48656c6c6f2074686572652062726f210a0a4e657720534156454040404040212121210a0a57616e74207370616365732076656c650a0a416464206d79206368616e6765730a6c6c6c0a0a736466617364660a0a736164660a6c6c6c0a0a),
('Between Brothers', 1, 'Edm', '2015-07-23 08:44:07.000000', 0x537175617265203120627275682e2e0a0a48656c6c6f2074686572652062726f210a0a4e657720534156454040404040212121210a0a57616e74207370616365732076656c650a0a416464206d79206368616e6765730a6c6c6c0a0a736466617364660a0a736164660a6c6c6c0a0a);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
