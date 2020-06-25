-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2020 at 12:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quantox_school_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `grade`) VALUES
(1, 1, 6),
(2, 1, 9),
(3, 1, 8),
(4, 2, 7),
(5, 2, 8),
(6, 3, 7),
(7, 3, 9),
(8, 4, 6),
(9, 4, 7),
(10, 5, 6),
(11, 5, 6),
(12, 6, 9),
(13, 6, 10),
(14, 7, 10),
(15, 7, 10),
(16, 8, 7),
(17, 8, 6),
(18, 9, 8),
(19, 9, 8),
(20, 9, 9),
(21, 9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `school_boards`
--

CREATE TABLE `school_boards` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `school_boards`
--

INSERT INTO `school_boards` (`id`, `title`) VALUES
(1, 'CSM'),
(2, 'CSMB');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `school_board_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `school_board_id`) VALUES
(1, 'Miloš Dojčinović', 1),
(2, 'Vladimir Pretrović', 2),
(3, 'Dalibor Simić', 1),
(4, 'Jelena Nedeljković', 1),
(5, 'Miroslav Mirković', 2),
(6, 'Marija Petrović', 2),
(7, 'Milena Simić', 1),
(8, 'Vesna Tasić', 2),
(9, 'Goran Eraković', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `school_boards`
--
ALTER TABLE `school_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_board_id` (`school_board_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `school_boards`
--
ALTER TABLE `school_boards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `student_grades` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `school_board` FOREIGN KEY (`school_board_id`) REFERENCES `school_boards` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
