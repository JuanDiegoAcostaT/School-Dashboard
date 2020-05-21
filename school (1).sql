-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 01:45 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `name` varchar(25) COLLATE utf8_bin NOT NULL,
  `creating_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `name`, `creating_date`, `created_by`) VALUES
(1, '4. TG', '2020-05-10 18:47:07', 2),
(2, '3. RT', '2020-05-10 18:48:37', 3);

-- --------------------------------------------------------

--
-- Table structure for table `classmates`
--

CREATE TABLE `classmates` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `classmates`
--

INSERT INTO `classmates` (`class_id`, `student_id`) VALUES
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `details` text COLLATE utf8_bin NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `date`, `details`, `class`) VALUES
(3, '2020-05-29', 'OwO', 2),
(4, '2020-05-26', '-_-', 2),
(7, '2020-05-24', 'Noooooooooooooooooooooooooo', 0),
(10, '2020-05-21', 'School ceremony', 0),
(11, '2020-05-04', 'Event from past', 0),
(12, '2020-05-01', 'First Friday in May :)', 0),
(15, '2020-05-15', 'Exam - Internet of Things', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `publishedBy` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `editedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `publishedBy`, `date`, `editedBy`) VALUES
(1, 'First news', 'Lorem Ipsum je jednostavno probni tekst koji se koristi u tiskarskoj i slovoslagarskoj industriji. Lorem Ipsum postoji kao industrijski standard još od 16-og stoljeća, kada je nepoznati tiskar uzeo tiskarsku galiju slova i posložio ih da bi napravio knjigu s uzorkom tiska.', 3, '2020-05-01 07:16:41', 3),
(2, 'Second news', 'Taj je tekst ne samo preživio pet stoljeća, već se i vinuo u svijet elektronskog slovoslagarstva, ostajući u suštini nepromijenjen. Postao je popularan tijekom 1960-ih s pojavom Letraset listova s odlomcima Lorem Ipsum-a, a u skorije vrijeme sa software-om za stolno izdavaštvo kao što je Aldus PageMaker koji također sadrži varijante Lorem Ipsum-a.', 3, '2020-05-03 05:02:29', 3),
(3, 'Old students', 'ashdbhsjhabshbsa', 2, '2020-05-04 16:17:22', 2),
(5, 'Novosti iz forme', 'Ovo je uspjesno dodana novost iz forme sa malih ekrana.', 2, '2020-05-18 23:50:27', 2),
(6, 'Novosti iz forme 2', 'Ovo je uspjesno dodana novost iz forme sa malih ekrana. Vijest 2', 2, '2020-05-18 23:51:22', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(60) COLLATE utf8_bin NOT NULL,
  `username` varchar(60) COLLATE utf8_bin NOT NULL,
  `password` varchar(60) COLLATE utf8_bin NOT NULL,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `surname` varchar(60) COLLATE utf8_bin NOT NULL,
  `user_type` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT 'unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `name`, `surname`, `user_type`) VALUES
(1, 'teacher1@school.com', 'teacher_01', 'd9c97cc6917353678bf1deb90a0c766c', 'T_name01', 'T_surename01', 'teacher'),
(2, 'super@admin.com', 'superadmin', '0b5ecc7d210806a5a95531c4e0204b25', 'Super', 'Admin', 'superadmin'),
(3, 'admin@admin.com', 'admin', 'ba73637a27dfcb35a5d4310a1ef995f3', 'Admin', 'Regular', 'admin'),
(4, 'leon@skole.hr', 'leon', '45292ff6d8743ab790997ad50dbd8b99', '', '', 'unknown'),
(6, 'ivica@gmail.com', 'ivica', '3d36fe60e683ab466132a503b2417204', 'Ivica', 'Roškarić', 'student'),
(7, 'marica@gmail.com', 'marica', '5e2d76ceff4b11b635dafa5a912659bb', '', '', 'teacher'),
(8, 'novak@skole.hr', 'novak', '5ae1c0c69644cd3545af1f4be5f4f5e3', 'Marko', 'Novak', 'student'),
(10, 'admin2@admin.com', 'admin2', 'ba73637a27dfcb35a5d4310a1ef995f3', '', '', 'admin'),
(11, 'znida@gmail.com', 'znida', '5e17bf2dcf94fd2e8d8888df2a1ea346', '', '', 'student'),
(12, 'spicar@gmail.com', 'spicko', '2b2b01c5bef09b1bb218d6625062dc1c', '', '', 'unknown');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
