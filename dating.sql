-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2018 at 06:34 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `ref` int(6) NOT NULL,
  `author` varchar(50) COLLATE utf8_bin NOT NULL,
  `comment` varchar(300) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ref`, `author`, `comment`, `date`) VALUES
(1, 655413, 'wickstjo', 'Eyy lmao', '2018-04-15 17:44:49'),
(3, 655413, 'wickstjo', 'Daaaamn daniel', '2018-04-15 18:21:53'),
(4, 655413, 'fuckyou', 'Whadupppp boiii', '2018-04-15 18:22:14'),
(5, 460391, 'eyylmao', 'm8888888', '2018-04-15 18:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `person1` varchar(50) COLLATE utf8_bin NOT NULL,
  `person2` varchar(50) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`id`, `code`, `person1`, `person2`, `date`) VALUES
(1, 655413, 'wickstjo', 'fuckyou', '2018-04-15 13:27:58'),
(2, 460391, 'eyylmao', 'fuckyou', '2018-04-15 18:23:51');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(1000) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `zip` varchar(6) COLLATE utf8_bin NOT NULL,
  `income` int(100) NOT NULL,
  `descr` varchar(500) COLLATE utf8_bin NOT NULL,
  `seeks` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `username`, `name`, `password`, `email`, `zip`, `income`, `descr`, `seeks`) VALUES
(1, 'wickstjo', 'john wickstrom', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', 'wickstjo@arcada.fi', '02400', 1000000, 'CASH MONEY', 'female'),
(2, 'datboi', 'urho kekkonen', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', 'datboi@geocities.com', '00820', 95000, 'god tier memer.', 'other'),
(4, 'eyylmao', 'eyy lmao', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', 'eyy@lmao.com', '565465', 500000, 'DOPE AT WOW', 'male'),
(5, 'fuckyou', 'fuck you', 'd74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1', 'fuck@you.com', '02400', 1000000000, 'fuck you fuck you', 'bitches');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `fromUser` varchar(50) COLLATE utf8_bin NOT NULL,
  `toUser` varchar(50) COLLATE utf8_bin NOT NULL,
  `msg` varchar(40) COLLATE utf8_bin NOT NULL,
  `status` varchar(20) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
