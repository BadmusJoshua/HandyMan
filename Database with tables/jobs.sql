-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 06:12 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
