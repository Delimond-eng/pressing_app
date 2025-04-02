-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 01:28 AM
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
  `montant_paie` double NOT NULL,
  `remise` int(11) NOT NULL DEFAULT 0,
  `devise` varchar(10) NOT NULL DEFAULT 'CDF',
  `client_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`facture_id`, `montant`, `montant_paie`, `remise`, `devise`, `client_id`, `status`, `user_id`, `created_at`) VALUES
(1, 26, 26, 0, 'USD', 1, 'pending', 1, '2025-03-15 19:38:11'),
(2, 30, 30, 0, 'USD', 2, 'pending', 1, '2025-03-15 19:47:43'),
(3, 13500, 13500, 0, 'CDF', 2, 'pending', 1, '2025-04-02 23:17:24'),
(4, 52000, 0, 0, 'CDF', 2, 'pending', 2, '2025-04-02 23:25:46');

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
(4, 'Smooking', 10, 1, 2, 1, '2025-03-15 19:47:43'),
(5, 'Chemise', 13500, 1, 3, 1, '2025-04-02 23:17:24'),
(6, 'Veste 2 Pièces', 25000, 1, 4, 2, '2025-04-02 23:25:46'),
(7, 'Chemise', 13500, 2, 4, 2, '2025-04-02 23:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `paiements`
--

CREATE TABLE `paiements` (
  `paie_id` int(11) NOT NULL,
  `paie_amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `client_id` int(11) NOT NULL,
  `facture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `paie_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiements`
--

INSERT INTO `paiements` (`paie_id`, `paie_amount`, `due_amount`, `client_id`, `facture_id`, `user_id`, `paie_date`) VALUES
(1, 26, 26, 1, 1, 1, '2025-04-02 23:17:37'),
(2, 13500, 13500, 2, 3, 1, '2025-04-02 23:17:56'),
(3, 30, 30, 2, 2, 1, '2025-04-02 23:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_libelle` varchar(255) NOT NULL,
  `prod_pu` double NOT NULL,
  `prod_devise` varchar(10) NOT NULL DEFAULT 'CDF',
  `status` varchar(25) NOT NULL DEFAULT 'actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_libelle`, `prod_pu`, `prod_devise`, `status`) VALUES
(1, 'Pantalon', 12500, 'CDF', 'actif'),
(2, 'Chemise', 13500, 'CDF', 'actif'),
(3, 'Veste 2 Pi&egrave;ces', 25000, 'CDF', 'actif'),
(4, 'Veste 3 Pi&egrave;ces', 30000, 'CDF', 'actif');

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
-- Indexes for table `paiements`
--
ALTER TABLE `paiements`
  ADD PRIMARY KEY (`paie_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

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
  MODIFY `facture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facture_details`
--
ALTER TABLE `facture_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paiements`
--
ALTER TABLE `paiements`
  MODIFY `paie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
