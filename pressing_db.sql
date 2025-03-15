-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2025 at 09:38 PM
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
-- Database: `pressing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `phone`, `created_at`, `user_id`) VALUES
(1, 'Gaston delimond', '0813524422', '2025-03-15 19:38:11', 1),
(2, 'Christian matand', '0852347788', '2025-03-15 19:47:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `facture_id` int(11) NOT NULL,
  `montant` double NOT NULL,
  `devise` varchar(10) NOT NULL DEFAULT 'CDF',
  `client_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`facture_id`, `montant`, `devise`, `client_id`, `status`, `user_id`, `created_at`) VALUES
(1, 26, 'USD', 1, 'pending', 1, '2025-03-15 19:38:11'),
(2, 30, 'USD', 2, 'pending', 1, '2025-03-15 19:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `facture_details`
--

CREATE TABLE `facture_details` (
  `detail_id` int(11) NOT NULL,
  `libelle` varchar(250) NOT NULL,
  `pu` double NOT NULL,
  `qte` int(11) NOT NULL,
  `facture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facture_details`
--

INSERT INTO `facture_details` (`detail_id`, `libelle`, `pu`, `qte`, `facture_id`, `user_id`, `created_at`) VALUES
(1, 'Pantalon Jeans', 5, 2, 1, 1, '2025-03-15 19:38:11'),
(2, 'Trico blanche', 8, 2, 1, 1, '2025-03-15 19:38:11'),
(3, 'Veste de mariage', 10, 2, 2, 1, '2025-03-15 19:47:43'),
(4, 'Smooking', 10, 1, 2, 1, '2025-03-15 19:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pwd` text NOT NULL,
  `role` varchar(25) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `role`) VALUES
(1, 'Gaston', '$2y$10$IkpiQE2Oie8AXOlxG5r8uusJRsIrI8bsR7l5mY1vlAvdtCtQsewmm', 'admin'),
(2, 'Miz', '$2y$10$Khc/6gTmvIpzZtHPuxlwe.zm2uPAsx/nT7Cx4J2hS6NATJ/RVpPNa', 'caissier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`facture_id`);

--
-- Indexes for table `facture_details`
--
ALTER TABLE `facture_details`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `facture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facture_details`
--
ALTER TABLE `facture_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
