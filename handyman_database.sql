-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 05:20 AM
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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `phoneNumber` varchar(14) NOT NULL,
  `country` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `address`, `phoneNumber`, `country`, `username`, `email`) VALUES
(1, 'jullie Ann', '123, Boulevard Avenue, Upstate Georgia', '1923445678', 'usa', 'julliana', 'jullian@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `subject`, `message`, `user_id`, `created`) VALUES
(1, 'Badmus Joshua', 'joshuabadmus574@gmail.com', 'ELECTRICITY COMPLAINT', 'This is to notify you about the irregular supply of electricity', 5, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `service` text NOT NULL,
  `price` int(10) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `completed` int(1) NOT NULL DEFAULT '0',
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `customer`, `service`, `price`, `duration`, `seller_id`, `completed`, `created`) VALUES
(1, 'Mr Bright Daniel', 'Fixing of faulty Inverter', 800, '1 Day', 5, 4, '2023-03-21'),
(2, 'Miss Evelyn Dako', 'General Maintenance of lighting system', 150, '2 Day s', 5, 2, '2023-03-01'),
(3, 'Mr Bright Daniel', 'Clearing of inventory', 130, '2 Week s', 5, 4, '2023-03-31'),
(4, 'Mr Bright Daniel', 'jhjhuug', 560, '2 Day s', 5, 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `personalities` varchar(20) NOT NULL,
  `venue` text NOT NULL,
  `reminder_minutes` int(20) NOT NULL,
  `reminder` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `owner_id`, `date`, `start`, `end`, `personalities`, `venue`, `reminder_minutes`, `reminder`) VALUES
(12, 5, '2023-02-26', '01:34:00', '01:40:00', 'Roommate', '', 0, 0),
(16, 5, '2023-04-21', '20:40:00', '21:25:00', 'ISRAEL', '1k cap', 10, 1),
(17, 5, '2023-04-21', '21:50:00', '21:50:00', 'charles', 'no man\'s land lodge', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(8, 5, 'Your meeting with ISRAEL at 1k capwill start in 10 . Don\'t forget ', 1, '2023-04-21 21:50:22.520496'),
(9, 5, 'Your meeting with charles at no man\'s land lodgewill start in 10 . Don\'t forget ', 1, '2023-04-21 21:50:22.560491'),
(10, 5, 'Your meeting with ISRAEL at 1k capwill start in 10 . Don\'t forget ', 1, '2023-04-21 21:50:59.519247'),
(11, 5, 'Your meeting with charles at no man\'s land lodgewill start in 10 . Don\'t forget ', 1, '2023-04-21 21:50:59.583259'),
(12, 5, 'lets hope it works', 0, '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `remember_me_tokens`
--

CREATE TABLE `remember_me_tokens` (
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` datetime(6) NOT NULL,
  `created` datetime(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remember_me_tokens`
--

INSERT INTO `remember_me_tokens` (`user_id`, `token`, `expires`, `created`) VALUES
(0, '', '0000-00-00 00:00:00.000000', '2023-04-11 08:43:51.736783'),
(0, '', '0000-00-00 00:00:00.000000', '2023-04-11 08:43:51.736783'),
(0, '', '0000-00-00 00:00:00.000000', '2023-04-11 08:43:51.736783'),
(5, '2edfc58daa02076ce497401fd4b3e388', '2023-05-11 10:06:36.000000', '2023-04-11 10:06:36.767691'),
(5, '61ed61fa3799d7f3e0e327c507c2142a', '2023-05-21 16:14:29.000000', '2023-04-21 16:14:29.066440');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_image` varchar(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `rating` int(1) NOT NULL,
  `technician_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `client_name`, `client_image`, `client_id`, `message`, `rating`, `technician_id`, `created`) VALUES
(1, 'Opeyemi', '', 8, 'I would recommend Joshua any day, his services are very professional  ', 4, 5, '2023-04-10 19:18:37'),
(2, 'Opeyemi', '', 8, 'A better service from Joshua, keep it up', 5, 5, '2023-04-10 22:46:35');

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
