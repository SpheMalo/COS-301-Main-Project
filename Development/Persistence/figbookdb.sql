-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2015 at 03:15 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12
use figbookdb;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `figbookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE IF NOT EXISTS `useraccount` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EmailAddress` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` int(11) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`,`EmailAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------


--
-- Table structure for table `letter`
--

CREATE TABLE IF NOT EXISTS `letter` (
  `LetterID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Body` longblob NOT NULL,
  `LetterType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`LetterID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `UserRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PermissionLevel` int(11) NOT NULL,
  PRIMARY KEY (`UserRoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Table structure for table `manuscript`
--

CREATE TABLE IF NOT EXISTS `manuscript` (
  `ManuscriptID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `ISBN` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Body` longblob NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Genre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ManuscriptID`),
  FOREIGN KEY (`UserID`) REFERENCES userrole(`UserRoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `AuthorID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ManuscriptID` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  PRIMARY KEY (`AuthorID`),
  FOREIGN KEY (UserID) REFERENCES useraccount(UserID),
  FOREIGN KEY (ManuscriptID) REFERENCES manuscript(ManuscriptID),
  FOREIGN KEY (UserRoleID) REFERENCES userrole(UserRoleID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` int(11) NOT NULL,
  `Body` longblob NOT NULL,
  `UserID` int(11) NOT NULL,
  `ManuscriptID` int(11) NOT NULL,
  PRIMARY KEY (`CommentID`),
  FOREIGN KEY (`ManuscriptID`) REFERENCES manuscript(`ManuscriptID`),
  FOREIGN KEY (`UserID`) REFERENCES userrole(`UserRoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------






