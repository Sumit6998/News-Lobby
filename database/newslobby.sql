-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 06:23 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newslobby`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_channel`
--

CREATE TABLE `news_channel` (
  `channel_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_channel`
--

INSERT INTO `news_channel` (`channel_name`) VALUES
('abc-news'),
('bbc-news'),
('bbc-sports'),
('bloomberg'),
('business-insider'),
('cnn'),
('espn'),
('financial-post'),
('focus'),
('fox-news'),
('google-news-in'),
('hacker-news'),
('ign'),
('national-geographic'),
('tech-crunch'),
('techradar'),
('the-economist'),
('the-hindu'),
('the-next-web'),
('the-times-of-india'),
('the-verge'),
('the-wall-street-journal'),
('wired');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`username`, `email`, `password`) VALUES
('barry', 'barry@gmail.com', 'zxcxzcz'),
('batman', 'batman@gmail.com', 'zxc'),
('bruce', 'br2uce2@gmail.com', 'zxc'),
('bruce', 'bruce2@gmail.com', 'Ddada'),
('bruce', 'bruce@gmail.com', 'asd'),
('chintan', 'chintan@gmail.com', 'zxcv'),
('lak', 'lakhinsu@gmail.com', 'asd'),
('prakshal', 'pra2kshal@gmail.com', '123'),
('prakshal', 'prakshal@gmail.com', 'zxczxc'),
('viraj47', 'viraj47@gmail.com', 'zxcvbnm');

-- --------------------------------------------------------

--
-- Table structure for table `user_to_channel`
--

CREATE TABLE `user_to_channel` (
  `user_email` varchar(60) NOT NULL,
  `channel_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_to_channel`
--

INSERT INTO `user_to_channel` (`user_email`, `channel_name`) VALUES
('chintan@gmail.com', 'business-insider'),
('chintan@gmail.com', 'focus'),
('chintan@gmail.com', 'financial-post'),
('chintan@gmail.com', 'espn'),
('batman@gmail.com', 'business-insider'),
('batman@gmail.com', 'wired'),
('batman@gmail.com', 'the-wall-street-journal'),
('prakshal@gmail.com', 'the-economist'),
('prakshal@gmail.com', 'the-hindu'),
('pra2kshal@gmail.com', 'the-next-web'),
('pra2kshal@gmail.com', 'the-times-of-india'),
('bruce@gmail.com', 'bbc-sports'),
('bruce@gmail.com', 'financial-post'),
('br2uce2@gmail.com', 'espn'),
('br2uce2@gmail.com', 'financial-post'),
('barry@gmail.com', 'espn'),
('barry@gmail.com', 'financial-post'),
('viraj47@gmail.com', 'bbc-news'),
('viraj47@gmail.com', 'cnn'),
('viraj47@gmail.com', 'financial-post'),
('viraj47@gmail.com', 'focus'),
('viraj47@gmail.com', 'national-geographic'),
('viraj47@gmail.com', 'ign'),
('viraj47@gmail.com', 'the-times-of-india'),
('viraj47@gmail.com', 'the-verge'),
('viraj47@gmail.com', 'tech-crunch'),
('lakhinsu@gmail.com', 'espn'),
('lakhinsu@gmail.com', 'bbc-news'),
('lakhinsu@gmail.com', 'bloomberg'),
('lakhinsu@gmail.com', 'cnn'),
('lakhinsu@gmail.com', 'the-times-of-india'),
('lakhinsu@gmail.com', 'the-wall-street-journal'),
('lakhinsu@gmail.com', 'ign');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_channel`
--
ALTER TABLE `news_channel`
  ADD PRIMARY KEY (`channel_name`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_to_channel`
--
ALTER TABLE `user_to_channel`
  ADD KEY `user_email` (`user_email`),
  ADD KEY `channel_name` (`channel_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_to_channel`
--
ALTER TABLE `user_to_channel`
  ADD CONSTRAINT `user_to_channel_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `user_info` (`email`),
  ADD CONSTRAINT `user_to_channel_ibfk_2` FOREIGN KEY (`channel_name`) REFERENCES `news_channel` (`channel_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
