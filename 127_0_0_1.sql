-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2016 at 01:03 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teachersdb`
--
CREATE DATABASE IF NOT EXISTS `teachersdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `teachersdb`;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `instrument` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `availbility` text,
  `image` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `gender`, `age`, `language`, `type`, `instrument`, `email`, `availbility`, `image`) VALUES
(1, 'Jarle Pitts', 'Male', 34, 'English, Norwegian', 'String', 'Guitar', 'JarlePittsMusic@gmail.com', 'Monday, Wednesday, Friday', 'images/profile/male.gif'),
(2, 'Thore Krebs', 'male', 41, 'English, German', 'Brass', 'Trombone', 'ThoreKrebsMusic@gmail.com', 'Friday, Saturday, Sunday', 'images/profile/male.gif'),
(3, 'Martha Ross', 'Female', 28, 'English', 'Keyboard', 'Piano', 'MarthaRossMusic@gmail.com', 'Monday, Tuesday, Wednesday, Thursday, Friday', 'images/profile/female.jpg'),
(4, 'Viktor Wu', 'Male', 24, 'English, Mandarin', 'String', 'Guitar', 'ViktorWuMusic@gmail.com', 'Thursday, Friday, Saturday, Sunday', 'images/profile/male.gif'),
(5, 'Miki Fukui', 'Female', 37, 'English, Japanese', 'String', 'Violin', 'MikiFukuiMusic@gmail.com', 'Monday, Tuesday, Wednesday, Friday, Saturday', 'images/profile/female.jpg\r\n'),
(6, 'Vanessa Leroy', 'Female', 26, 'English, French', 'Woodwind', 'Flute', 'VanessaLeroyMusic@gmail.com', 'Saturday, Sunday', 'images/profile/female.jpg'),
(7, 'Dae-Suk Park', 'Male', 31, 'English, Korean', 'Percussion', 'Drum', 'DaesukParkMusic@gmail.com', 'Friday, Saturday, Sunday', 'images/profile/male.gif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
