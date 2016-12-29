-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2016 at 01:11 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppw4655`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `id_following` int(11) NOT NULL,
  `id_followers` int(11) NOT NULL,
  `datefriend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`id`, `id_following`, `id_followers`, `datefriend`) VALUES
(1, 1, 4, '2016-05-18 21:59:11'),
(2, 1, 6, '2016-05-18 21:59:11'),
(4, 4, 1, '2016-05-18 22:35:53'),
(14, 2, 1, '2016-05-19 15:00:40'),
(15, 6, 1, '2016-05-19 15:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `liked` int(11) NOT NULL DEFAULT '0',
  `disliked` int(11) NOT NULL DEFAULT '0',
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `urlfile` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipe` varchar(25) COLLATE utf8_unicode_ci DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `id`, `content`, `liked`, `disliked`, `dateposted`, `urlfile`, `tipe`) VALUES
(1, 4, 'Selamat Datang di Sahabat Sosial!', 0, 0, '2016-04-26 02:12:33', NULL, 'text'),
(2, 4, 'is it good to be bad?', 0, 0, '2016-04-26 03:30:25', NULL, 'text'),
(5, 2, 'try new social media', 0, 0, '2016-04-26 13:04:34', NULL, 'text'),
(6, 2, 'Defeated The Lord of The Ring', 0, 0, '2016-04-26 13:12:07', NULL, 'text'),
(7, 3, 'Where is my Ring?', 1, 0, '2016-04-26 13:22:47', NULL, 'text'),
(8, 3, 'Hello Master', 0, 0, '2016-04-26 13:24:31', NULL, 'text'),
(9, 1, 'Hello Users', 0, 0, '2016-04-26 13:44:55', NULL, 'text'),
(10, 2, 'What are you Waiting for?', 3, 0, '2016-04-26 14:10:17', NULL, 'text'),
(11, 1, 'nice try!', 2, 0, '2016-04-26 15:53:46', NULL, 'text'),
(12, 1, 'responsible', 2, 0, '2016-05-17 13:20:55', NULL, 'text'),
(13, 4, 'avada kedavra', 1, 0, '2016-05-17 13:21:24', NULL, 'text'),
(14, 2, 'the hobbit and battle of 5 armies', 1, 1, '2016-05-17 14:51:15', NULL, 'text'),
(15, 4, 'kenapa?', 1, 1, '2016-05-18 14:18:24', NULL, 'text'),
(16, 7, 'Challenge Accepted', 0, 0, '2016-05-19 00:57:48', NULL, 'text'),
(17, 1, 'sdgsdgsd', 0, 0, '2016-05-19 14:41:07', NULL, 'text'),
(18, 6, 'saya ingin gendut', 0, 0, '2016-05-19 15:05:07', NULL, 'text'),
(19, 2, 'masa sih?', 0, 0, '2016-05-19 15:33:25', NULL, 'text'),
(20, 6, 'test', 0, 0, '2016-05-19 16:23:39', NULL, 'text'),
(21, 6, 'Masih Banyak Error', 0, 0, '2016-05-19 16:25:35', NULL, 'text'),
(22, 4, 'Wrong enemy', 0, 0, '2016-05-19 16:29:48', NULL, 'text');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `fullname` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `city` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hobby` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `education` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profpict` text COLLATE utf8_unicode_ci,
  `about` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `fullname`, `birthday`, `city`, `country`, `phone`, `hobby`, `sex`, `education`, `job`, `company`, `profpict`, `about`) VALUES
(1, 'Admin Nih Yee', '1994-04-19', 'Depok', 'Indonesia', '083890326660', 'Sleep', 'male', 'UI', 'Jobless', 'FTUI', 'media/uploaded/admin.jpg', 'Computer Eng.'),
(2, 'Frodo Baggins', '1294-04-01', NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL),
(3, 'Smeagol', '1280-09-30', NULL, NULL, NULL, NULL, 'male?', NULL, NULL, NULL, NULL, NULL),
(4, 'Harry Potter', '1980-07-31', NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL),
(6, 'Aldi Burhanhamali', '1994-04-19', NULL, NULL, NULL, NULL, 'male', NULL, NULL, NULL, 'media/uploaded/aldialbu.jpg', NULL),
(7, 'Challenge Accepted', '2016-05-31', NULL, NULL, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `reg_date`) VALUES
(1, 'admin@sahabatsosial.id', 'admin', 'adminganteng', '2016-03-06 01:01:16.676331'),
(2, 'frodb@ggins.shire', 'fbaggins', 'ringBearer', '2016-04-25 00:00:00.000000'),
(3, 'master@rings.lord', 'gsmeagol', 'myPrecious', '2016-04-26 00:00:00.000000'),
(4, 'myenemy@youknow.who', 'hpotter', 'boyWhoLived', '2016-04-01 00:00:00.000000'),
(6, 'aldialbu@gmail.com', 'aldialbu', 'aldialbu', '2016-05-17 22:33:26.821668'),
(7, 'challenge@ccepted.id', 'challenge', 'challenge', '2016-05-19 00:40:50.133812');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_followers` (`id_followers`),
  ADD KEY `id_following` (`id_following`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `friend_ibfk_1` FOREIGN KEY (`id_followers`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `friend_ibfk_2` FOREIGN KEY (`id_following`) REFERENCES `user` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
