-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2017 at 11:28 PM
-- Server version: 5.6.32-78.1-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--

-- Database: `library`

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE IF NOT EXISTS `library` (
  `screen_id` int(10) unsigned NOT NULL,
  `screen_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `screen_number` int(11) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `screen_refs` varchar(255) NOT NULL,
  `screen_notes` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO `library` (`screen_id`, `screen_date`, `screen_number`, `screen_name`, `screen_refs`, `screen_notes`) VALUES
(1, '2017-01-03 06:50:35', 1, 'First Item', 'Example', 'this is an example for the file system'),
(2, '2017-01-03 06:52:53', 2, 'Second item', 'item 2', 'new item'),
(3, '2017-01-03 06:53:30', 3, 'item 3', 'third item', 'example 3'),
(4, '2017-01-03 06:54:18', 4, 'item 4', 'fourth', 'example 4'),
(5, '2017-01-04 05:08:57', 5, 'fifth', 'Fifth Example', 'This is example 5');

-- --------------------------------------------------------

--
-- Table structure for table `logon`
--

CREATE TABLE IF NOT EXISTS `logon` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(15) NOT NULL,
  `salt` int(10) unsigned NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- default user value is 'admin' + pwd 'logon' for table `logon`
--

INSERT INTO `logon` (`user_id`, `username`, `salt`, `password`) VALUES
(1, 'admin', 0, 'logon'),
(2, 'user', 0, 'logon'),
(3, 'admin', 11111111, 'logon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`screen_id`), ADD KEY `screen_name_2` (`screen_name`), ADD KEY `screen_name_6` (`screen_name`,`screen_refs`,`screen_notes`), ADD FULLTEXT KEY `screen_name` (`screen_name`), ADD FULLTEXT KEY `screen_refs` (`screen_refs`), ADD FULLTEXT KEY `screen_notes` (`screen_notes`), ADD FULLTEXT KEY `screen_name_3` (`screen_name`), ADD FULLTEXT KEY `screen_refs_2` (`screen_refs`), ADD FULLTEXT KEY `index_name` (`screen_name`), ADD FULLTEXT KEY `screen_name_4` (`screen_name`), ADD FULLTEXT KEY `screen_name_5` (`screen_name`,`screen_refs`,`screen_notes`);

--
-- Indexes for table `logon`
--
ALTER TABLE `logon`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `screen_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `logon`
--
ALTER TABLE `logon`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
