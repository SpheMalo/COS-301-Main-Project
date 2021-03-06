-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2015 at 12:29 PM
-- Server version: 5.6.19-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

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
-- Table structure for table `section_revisions`
--

CREATE TABLE IF NOT EXISTS `section_revisions` (
  `book_title` varchar(160) NOT NULL,
  `section_number` int(3) NOT NULL,
  `last_edited_by` varchar(40) NOT NULL,
  `date_last_edited` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `section_content` longblob,
  KEY `book_title` (`book_title`,`section_number`),
  KEY `section_number` (`section_number`)
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
('Between Brothers', 1, 'Edm', '2015-07-23 08:44:07.000000', 0x537175617265203120627275682e2e0a0a48656c6c6f2074686572652062726f210a0a4e657720534156454040404040212121210a0a57616e74207370616365732076656c650a0a416464206d79206368616e6765730a6c6c6c0a0a736466617364660a0a736164660a6c6c6c0a0a),
('Hello Love', 1, 'Thatomatjax', '2015-08-20 08:33:59.000000', ''),
('An', 1, 'Thatomatjax', '2015-08-20 08:25:52.000000', NULL),
('Hello Love', 2, 'Thatomatjax', '2015-08-20 08:33:59.000000', ''),
('ATest', 1, 'Thatomatjax', '2015-08-20 08:34:54.000000', ''),
('Fixed', 1, 'Thatomatjax', '2015-08-20 08:45:25.000000', NULL),
('Finally New', 1, 'Jimmypeleha', '2015-08-20 18:24:56.000000', 0x3c703e412073686f72742070726566616365206973206e6565646564206e6f77206a696d6d792070656c656861206a6a6a6a6a6b68666a797466793c62723e3c2f703e3c703e3c62723e3c2f703e),
('Comment Test', 1, 'Jimmypeleha', '2015-09-09 15:43:30.000000', 0x3c703e456174207468617420626f6f7479206c696b652067726f6365726965733c2f703e),
('K-book', 1, 'Jimmypeleha', '2015-09-02 11:20:58.000000', 0x3c703e48657070792052657669736564206e6f773c62723e3c2f703e),
('Comment Test', 2, 'Jimmypeleha', '2015-09-09 15:43:30.000000', 0x3c703e456174207468617420626f6f7479206c696b652067726f6365726965733c2f703e),
('Comment Test', 3, 'Jimmypeleha', '2015-09-09 15:43:30.000000', 0x3c703e456174207468617420626f6f7479206c696b652067726f6365726965733c2f703e),
('', 1, 'Fakopeleha', '2015-09-18 06:29:32.000000', 0x3c703e536976696c655965626f20796573743c62723e3c2f703e);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
