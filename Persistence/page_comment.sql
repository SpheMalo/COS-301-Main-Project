-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2015 at 04:52 PM
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
-- Table structure for table `page_comment`
--

CREATE TABLE IF NOT EXISTS `page_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `page_name` varchar(160) NOT NULL,
  `section_number` int(3) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `page_name` (`page_name`,`section_number`),
  KEY `section_number` (`section_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `page_comment`
--

INSERT INTO `page_comment` (`comment_id`, `comment`, `page_name`, `section_number`) VALUES
(5, 'commenting', 'Groceries', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `page_comment`
--
ALTER TABLE `page_comment`
  ADD CONSTRAINT `fk_section_number` FOREIGN KEY (`section_number`) REFERENCES `section_revisions` (`section_number`),
  ADD CONSTRAINT `fk_booktitle` FOREIGN KEY (`page_name`) REFERENCES `section_revisions` (`book_title`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
