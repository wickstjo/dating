-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 01:01 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `groupSize` int(2) NOT NULL,
  `slug` varchar(80) COLLATE utf8_bin NOT NULL,
  `descr` varchar(200) COLLATE utf8_bin NOT NULL,
  `starts` datetime NOT NULL,
  `ends` datetime NOT NULL,
  `comments` int(6) NOT NULL,
  `submissions` int(6) NOT NULL,
  `public` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `code`, `name`, `groupSize`, `slug`, `descr`, `starts`, `ends`, `comments`, `submissions`, `public`) VALUES
(1, 357563, 'function calculator', 4, 'function-calculator', 'Loerem ipsum', '2018-01-25 00:00:00', '2018-01-31 00:00:00', 536354, 954654, 1),
(4, 357563, 'testing again', 7, 'testing-again', 'dsfdsf', '2018-03-06 00:00:00', '2018-03-23 00:00:00', 570673, 0, 1),
(5, 749987, 'frontend assignment', 3, 'frontend-assignment', 'ssgsgfdf', '2018-03-19 00:00:00', '2018-03-31 00:00:00', 359190, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `code`, `username`) VALUES
(3, 196747, 'wickstjo');

-- --------------------------------------------------------

--
-- Table structure for table `attending`
--

CREATE TABLE `attending` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `code` int(6) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `attending`
--

INSERT INTO `attending` (`id`, `username`, `code`, `date`) VALUES
(1, 'wickstjo', 677979, '2018-01-24 00:00:00'),
(2, 'laaksoda', 677979, '2018-01-28 00:00:00'),
(3, 'wickstjo', 739181, '2018-03-03 00:00:00'),
(4, 'laaksoda', 739181, '2018-03-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `changelog`
--

CREATE TABLE `changelog` (
  `id` int(11) NOT NULL,
  `string` varchar(299) COLLATE utf8_bin NOT NULL,
  `submission` int(6) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `changelog`
--

INSERT INTO `changelog` (`id`, `string`, `submission`, `date`) VALUES
(1, 'Wickstjo has submitted a project.\r\n', 294355, '2018-03-08 00:00:00'),
(2, 'Karlsson has changed grade to 5.', 294355, '2018-03-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `author` varchar(50) COLLATE utf8_bin NOT NULL,
  `content` varchar(500) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `anon` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `code`, `author`, `content`, `date`, `anon`) VALUES
(1, 536354, 'wickstjo', 'This is a comment', '2018-03-02 00:00:00', 1),
(2, 536354, 'karlsson', 'Testing again', '2018-03-13 00:00:00', 0),
(16, 570673, 'wickstjo', 'h0h0h0', '2018-03-04 17:12:51', 0),
(21, 536354, 'wickstjo', 'testing', '2018-03-04 19:53:27', 0),
(23, 345435, 'wickstjo', 'Eyyyyyyyyyy', '2018-03-05 13:33:57', 0),
(24, 345435, 'wickstjo', 'WHADUP', '2018-03-05 13:34:03', 1),
(25, 536354, 'wickstjo', 'fdsfdsfdsf', '2018-03-05 16:54:13', 0),
(26, 547654, 'wickstjo', 'sadasdasd', '2018-03-08 12:25:46', 0),
(27, 547654, 'wickstjo', 'aaaaapapapap', '2018-03-08 12:26:14', 0),
(28, 547654, 'wickstjo', 'testt', '2018-03-08 12:28:59', 0),
(29, 547654, 'wickstjo', 'testt', '2018-03-08 12:29:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `slug` varchar(100) COLLATE utf8_bin NOT NULL,
  `descr` text COLLATE utf8_bin NOT NULL,
  `assignments` int(6) NOT NULL,
  `attending` int(6) NOT NULL,
  `lessons` int(6) NOT NULL,
  `author` varchar(50) COLLATE utf8_bin NOT NULL,
  `starts` datetime NOT NULL,
  `ends` datetime NOT NULL,
  `credits` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `descr`, `assignments`, `attending`, `lessons`, `author`, `starts`, `ends`, `credits`) VALUES
(1, 'Backend', 'backend', 'Sed imperdiet ipsum eget nisi luctus, in volutpat quam tincidunt. Pellentesque finibus diam at nibh ullamcorper viverra. Sed a sapien nec tellus scelerisque convallis id quis augue. Curabitur nec ultricies enim. Vestibulum interdum rhoncus molestie. Quisque a placerat erat. Donec eget leo justo. Donec quis condimentum sem, eget dignissim nulla. Curabitur vestibulum leo nec lorem luctus, ac varius nulla bibendum. Proin vulputate, tortor eu consequat finibus, diam libero posuere lacus, a pretium purus tellus ut justo. Duis eget est consequat, porta nunc laoreet, maximus libero. Vivamus eget luctus nisi.', 925461, 677979, 340693, 'scherbakov', '2018-01-22 00:00:00', '2018-03-07 00:00:00', 5),
(2, 'Nature of Code 2', 'nature-of-code-2', 'Pellentesque luctus metus a augue laoreet, eget gravida leo semper. Etiam pharetra sem suscipit fringilla efficitur. In a elit magna. Quisque ut dapibus purus. Suspendisse pulvinar nunc leo, et aliquam nunc condimentum vel. Ut fermentum lacus orci, ut laoreet sapien viverra et. Sed rutrum dapibus ex nec tincidunt. Aenean ac bibendum eros. Nam aliquam a quam posuere hendrerit. Suspendisse accumsan, eros eget euismod rutrum, nunc lacus finibus risus, eget mollis lorem dolor nec magna. Sed pellentesque nisl non justo viverra tempus. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 357563, 739181, 588354, 'karlsson', '2018-01-22 00:00:00', '2018-02-16 00:00:00', 5),
(37, 'frontend development', 'frontend-development', 'badass', 749987, 461326, 902452, 'wickstjo', '2018-03-13 00:00:00', '2018-03-28 00:00:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `slug` varchar(80) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `comments` int(6) NOT NULL,
  `attendance` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `code`, `name`, `slug`, `content`, `date`, `comments`, `attendance`) VALUES
(1, 588354, 'introduction to programming', 'introduction-to-programming', 'Mauris gravida ante vel libero varius, id ornare dui lobortis. Ut imperdiet orci vitae magna dignissim sollicitudin. Cras quis erat scelerisque, pretium turpis in, consectetur odio. Pellentesque non ultrices est, ac pretium lectus. Etiam ullamcorper ex ut erat laoreet convallis. Aliquam in sodales quam, vel pharetra arcu.', '2018-01-10 00:00:00', 345435, 196747),
(6, 902452, 'validation with javascript', 'validation-with-javascript', 'cool dude', '2018-03-13 00:00:00', 285178, 531737);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `grade` int(1) DEFAULT NULL,
  `assignment` int(6) NOT NULL,
  `comments` int(6) NOT NULL,
  `changelog` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `username`, `content`, `date`, `grade`, `assignment`, `comments`, `changelog`) VALUES
(1, 'wickstjo', 'sfgdfgfdgfdhdgh', '2018-03-05 00:00:00', 1, 954654, 547654, 294355),
(4, 'laaksoda', 'adsadasdsa', '2018-03-07 00:14:28', 5, 954654, 920213, 912352);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `status` varchar(20) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `status`, `date`) VALUES
(1, 'scherbakov', 'pass', 'something@random.com', 'Professor', '2018-01-15 00:00:00'),
(2, 'karlsson', 'pass', 'karlssojo@arcada.fi', 'Professor', '2018-01-04 00:00:00'),
(3, 'wickstjo', 'pass', 'jfwick@gmail.com', 'Student', '2018-01-24 00:00:00'),
(4, 'laaksoda', 'pass', 'asdf@yahoo.com', 'Student', '2018-01-09 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attending`
--
ALTER TABLE `attending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `changelog`
--
ALTER TABLE `changelog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attending`
--
ALTER TABLE `attending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `changelog`
--
ALTER TABLE `changelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
