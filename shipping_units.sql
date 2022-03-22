-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 10:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bai1`
--

-- --------------------------------------------------------

--
-- Table structure for table `shipping_units`
--

CREATE TABLE `shipping_units` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `dateStopContact` date DEFAULT NULL,
  `bankName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankAddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_units`
--

INSERT INTO `shipping_units` (`id`, `name`, `shortName`, `phoneNumber`, `taxId`, `status_id`, `dateStopContact`, `bankName`, `bankNumber`, `bankAddress`, `address`, `contact`, `note`, `created_at`, `updated_at`) VALUES
(1, 'sadadas', 'sadadas', NULL, 'sadadas', 1, NULL, 'sadadas', NULL, NULL, 'sadadas', 'sadadas', 'sadadas', '2022-03-21 01:54:10', '2022-03-21 01:54:10'),
(2, 'sadadas', 'sadadas', NULL, 'sadadas', 1, '2022-03-08', 'sadadas', NULL, 'sadadas', 'sadadas', 'sadadas', 'sadadas', '2022-03-21 01:54:35', '2022-03-21 01:54:35'),
(3, 'ádfsdfsdfa', 'ádfsdfsdfa', NULL, 'ádfsdfsdfa', 1, '2022-03-09', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', '2022-03-21 01:56:37', '2022-03-21 01:56:37'),
(4, 'ádfsdfsdfa', 'ádfsdfsdfa', NULL, 'ádfsdfsdfa', 1, '2022-03-15', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', 'ádfsdfsdfa', '2022-03-21 01:57:25', '2022-03-21 01:57:25'),
(5, 'weqweqwe', 'qweqweqweqwe', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-21 02:58:36', '2022-03-21 02:58:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipping_units`
--
ALTER TABLE `shipping_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_units_status_id_foreign` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipping_units`
--
ALTER TABLE `shipping_units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipping_units`
--
ALTER TABLE `shipping_units`
  ADD CONSTRAINT `shipping_units_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status_shipping_units` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
