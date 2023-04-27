-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2023 at 11:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handyman`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int NOT NULL,
  `fullname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `phone` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `altphone` varchar(14) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `state` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `instagram` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `fullname`, `address`, `phone`, `altphone`, `username`, `email`, `state`, `city`, `twitter`, `facebook`, `instagram`, `linkedin`, `password`, `image`) VALUES
(1, 'jullie Ann', '123, Boulevard Avenue, Upstate Georgia', '1923445678', '', 'julliana', 'jullian@mail.com', '0', '', '', '', '', '', '', ''),
(2, 'Ogunsola Olasubomi', 'Mechanic Village, Ondo Road. ', '08164571816', '09876543234', 'suby', 'ogunsola.olasubomi@gmail.com', 'Ondo', 'Akure', 'https://twitter.com/asperOladey?t=nvO4L5HMbLdMUtFd7OQ2Nw&amp;s=09', 'https://www.facebook.com/ogunsola.subomi.1?mibextid=ZbWKwL', 'https://instagram.com/ogunsolaolasubomi?igshid=ZDdkNTZiNTM=', '', '12345', 'Smok3signals.png'),
(3, 'Olaoluwa Jeremiah', 'Bisi Balogun PG hostel', '08092330592', '09876543234', 'Oj', 'oj@gmail.com', 'Ekiti', 'Ado-Ekiti', 'https://twitter.com/asperOladey?t=nvO4L5HMbLdMUtFd7OQ2Nw&amp;s=09', 'https://www.facebook.com/ogunsola.subomi.1?mibextid=ZbWKwL', 'https://instagram.com/ogunsolaolasubomi?igshid=ZDdkNTZiNTM=', NULL, '12345', 'Smok3signals.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
