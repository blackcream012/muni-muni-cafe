-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2025 at 12:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muni_muni_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `user` varchar(100) NOT NULL,
  `order_type` enum('pickup','delivery') NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `payment_ref` varchar(50) DEFAULT NULL,
  `cart` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user`, `order_type`, `full_name`, `address`, `contact`, `email`, `payment_ref`, `cart`, `total`, `created_at`) VALUES
(6, 'ORD4328', 'Arnold De Leon', 'delivery', 'mark draiy javier', 'M.JOSE', '09635025598', 'Phbooster51@gmail.com', 'asdsa', '[{\"name\":\"Muni Executive Latt\\u00e9\",\"price\":\"140\",\"image\":\"images\\/cup2.png\",\"temp\":\"Hot\",\"sugar\":\"50%\",\"quantity\":1}]', 140.00, '2025-11-12 22:35:22'),
(7, 'ORD8559', 'Arnold De Leon', 'delivery', 'mark draiy javier', 'M.JOSE', '09635025598', 'Phbooster51@gmail.com', 'asdasd', '[{\"name\":\"Triple Muni Jelly\",\"price\":\"120\",\"image\":\"images\\/cup4.png\",\"temp\":\"Hot\",\"sugar\":\"50%\",\"quantity\":1}]', 120.00, '2025-11-12 22:43:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
