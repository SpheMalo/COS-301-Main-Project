-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2015 at 11:14 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

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
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `AuthorID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ManuscriptID` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  PRIMARY KEY (`AuthorID`),
  KEY `AuthorID` (`AuthorID`),
  KEY `UserID` (`UserID`),
  KEY `ManuscriptID` (`ManuscriptID`),
  KEY `UserRoleID` (`UserRoleID`)
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
  KEY `UserID` (`UserID`),
  KEY `ManuscriptID` (`ManuscriptID`)
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
-- Table structure for table `letterlist`
--

CREATE TABLE IF NOT EXISTS `letterlist` (
  `LetterListID` int(11) NOT NULL AUTO_INCREMENT,
  `FromUserID` int(11) NOT NULL,
  `ToUserID` int(11) NOT NULL,
  `LetterID` int(11) NOT NULL,
  `ManuscriptID` int(11) NOT NULL,
  PRIMARY KEY (`LetterListID`),
  KEY `FromUserID` (`FromUserID`,`ToUserID`,`LetterID`,`ManuscriptID`),
  KEY `ToUserID` (`ToUserID`),
  KEY `LetterID` (`LetterID`),
  KEY `ManuscriptID` (`ManuscriptID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

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
-- Table structure for table `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `UserRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PermissionLevel` int(11) NOT NULL,
  PRIMARY KEY (`UserRoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `AuthorUserRoleID` FOREIGN KEY (`UserRoleID`) REFERENCES `userrole` (`UserRoleID`),
  ADD CONSTRAINT `AuthorManuscriptID` FOREIGN KEY (`ManuscriptID`) REFERENCES `manuscript` (`ManuscriptID`),
  ADD CONSTRAINT `AuthorUserID` FOREIGN KEY (`UserID`) REFERENCES `useraccount` (`UserID`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `CommentManuscriptID` FOREIGN KEY (`ManuscriptID`) REFERENCES `manuscript` (`ManuscriptID`),
  ADD CONSTRAINT `CommentUserID` FOREIGN KEY (`UserID`) REFERENCES `useraccount` (`UserID`);

--
-- Constraints for table `letterlist`
--
ALTER TABLE `letterlist`
  ADD CONSTRAINT `LetterListManuscriptID` FOREIGN KEY (`ManuscriptID`) REFERENCES `manuscript` (`ManuscriptID`),
  ADD CONSTRAINT `LetterListFromUserID` FOREIGN KEY (`FromUserID`) REFERENCES `useraccount` (`UserID`),
  ADD CONSTRAINT `LetterListLetterID` FOREIGN KEY (`LetterID`) REFERENCES `letter` (`LetterID`),
  ADD CONSTRAINT `LetterListtoUserID` FOREIGN KEY (`ToUserID`) REFERENCES `useraccount` (`UserID`);

--
-- Constraints for table `manuscript`
--
ALTER TABLE `manuscript`
  ADD CONSTRAINT `ManuscriptUserID` FOREIGN KEY (`UserID`) REFERENCES `useraccount` (`UserID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
