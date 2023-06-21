-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2018 at 01:01 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empty_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ballot`
--

CREATE TABLE `ballot` (
  `id` int(11) NOT NULL,
  `settlement_id` text,
  `ballot_id` varchar(11) DEFAULT NULL,
  `street_name` text,
  `home_num` text,
  `home_letter` text,
  `neighborhood` text,
  `regional_id` text,
  `geographical_id` text,
  `empty_field` text,
  `place_details` longtext,
  `empty_field2` text,
  `settlement_name` text,
  `settlement_type` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `delegate`
--

CREATE TABLE `delegate` (
  `id` int(11) NOT NULL,
  `full_name` text,
  `iden` text,
  `phone` text,
  `cell` text,
  `email` text,
  `city` text,
  `table` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `electors`
--

CREATE TABLE `electors` (
  `id` int(11) NOT NULL,
  `IDNumber` int(11) DEFAULT NULL,
  `FamilyName` varchar(255) DEFAULT NULL,
  `originalFamilyName` varchar(255) DEFAULT NULL,
  `PersonalName` varchar(255) DEFAULT NULL,
  `FatherName` varchar(255) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `birthYear` int(11) DEFAULT NULL,
  `BoxAddCode` int(11) DEFAULT NULL,
  `AddCode` int(11) DEFAULT NULL,
  `Zip` int(11) DEFAULT NULL,
  `AddCode2` int(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `StCode` int(11) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `HomeNo` int(11) DEFAULT NULL,
  `Enterance` varchar(255) DEFAULT NULL,
  `Flat` int(11) DEFAULT NULL,
  `Letter` varchar(255) DEFAULT NULL,
  `Serial` int(11) DEFAULT NULL,
  `list` text,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `voted` int(11) DEFAULT NULL,
  `support_list` int(11) DEFAULT NULL,
  `support_dele` int(11) DEFAULT NULL,
  `couple` int(11) DEFAULT NULL,
  `tel` text,
  `cell` text,
  `email` text,
  `man` text,
  `root` text,
  `manid` int(11) DEFAULT NULL,
  `rootid` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `mayor` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kalfy`
--

CREATE TABLE `kalfy` (
  `id` int(11) NOT NULL,
  `settlement_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `settlement_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ballot_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mayors`
--

CREATE TABLE `mayors` (
  `id` int(11) NOT NULL,
  `full_name` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` text,
  `hash` text NOT NULL,
  `type` int(11) DEFAULT NULL,
  `name` text,
  `addedby` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personal_list`
--

CREATE TABLE `personal_list` (
  `id` int(11) NOT NULL,
  `full_name` text,
  `iden` text,
  `phone` text,
  `cell` text,
  `email` text,
  `city` text,
  `counter` int(11) DEFAULT NULL,
  `table` text,
  `under` int(11) DEFAULT NULL,
  `old_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` text,
  `data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ballot`
--
ALTER TABLE `ballot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delegate`
--
ALTER TABLE `delegate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electors`
--
ALTER TABLE `electors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `IDNumber_2` (`IDNumber`),
  ADD KEY `IDNumber` (`IDNumber`),
  ADD KEY `couple` (`couple`),
  ADD KEY `mother_id` (`mother_id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `Serial` (`Serial`),
  ADD FULLTEXT KEY `FamilyName` (`FamilyName`,`PersonalName`,`FatherName`);
ALTER TABLE `electors`
  ADD FULLTEXT KEY `FamilyName_2` (`FamilyName`,`PersonalName`);
ALTER TABLE `electors`
  ADD FULLTEXT KEY `PersonalName` (`PersonalName`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kalfy`
--
ALTER TABLE `kalfy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mayors`
--
ALTER TABLE `mayors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_list`
--
ALTER TABLE `personal_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ballot`
--
ALTER TABLE `ballot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delegate`
--
ALTER TABLE `delegate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `electors`
--
ALTER TABLE `electors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kalfy`
--
ALTER TABLE `kalfy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mayors`
--
ALTER TABLE `mayors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_list`
--
ALTER TABLE `personal_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
