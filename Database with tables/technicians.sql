-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 06:17 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` int(11) NOT NULL,
  `image` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(14) NOT NULL,
  `username` varchar(20) NOT NULL,
  `rating` float NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `about` varchar(200) NOT NULL,
  `company` varchar(30) NOT NULL,
  `job` varchar(30) NOT NULL,
  `country` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) NOT NULL,
  `password_reset_expires_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `image`, `name`, `email`, `phoneNumber`, `username`, `rating`, `created`, `password`, `updated`, `about`, `company`, `job`, `country`, `address`, `twitter`, `facebook`, `instagram`, `password_reset_token`, `password_reset_expires_at`) VALUES
(5, 'class.jpg', 'Badmus Joshua', 'joshuabadmus574@gmail.com', '08035818535', 'joshie', 4.5, '2023-04-11 00:00:00', '$2y$10$heU8QNty2ST.2O.RugDY8ebPhohbS8mDUt.CLD3KtgEWnNpFqHPb6', '2023-04-11 02:47:25', 'Software development just becomes soft work as you let us handle your projects.', 'Top techies ', 'Software Developer', 'Nigeria', '6, Road 7, Futa satellite estate, Futa southgate, Akure, Ondo State', 'https://twitter.com/fiery_josh18', 'https://facebook.com/badmusjoshua92', 'https://instagram.com/joshie114', '', '0000-00-00 00:00:00.000000'),
(6, '', 'Jullie Fox', 'ferocious@gmail.com', '12345678909', 'jullie', 0, '0000-00-00 00:00:00', '$2y$10$dijr71ClYBGfdaLdhP.8pufKbNNe4tQ2PN0iJw/RSIsBcRoqbeHCi', '2023-04-09 21:48:56', '', '', '', '', '', '', '', '', '824564bce341f2326581dc729d2e2f405b7a9a025224c8d2c0294cb8a5e77045', '2023-04-09 22:03:56.000000'),
(7, '', 'Francis', 'jerry67@gmail.com', '12345678909', 'franko', 0, '2023-04-08 04:24:46', '$2y$10$.viLSXWjvFoWGuW8PPytkerX5MsHjjTmKVHuQrhkO6krYWDSuMZbe', '2023-04-08 04:27:20', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00.000000'),
(8, '', 'Opeyemi', 'horpeyhemi18@gmail.com', '12345678909', 'opeyemi18', 0, '2023-04-08 04:31:55', '$2y$10$YhTQiSCB1bh6drxw7ew6ueIdDz.YQINGEow7VAJ1zqA3SgtpdqaoW', '2023-04-08 04:32:18', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
