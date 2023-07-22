-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 10:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icloudems`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry_modes`
--

CREATE TABLE `entry_modes` (
  `id` bigint(20) NOT NULL,
  `entry_mode_name` varchar(265) NOT NULL,
  `entry_mode` int(22) NOT NULL,
  `crdr` varchar(265) NOT NULL,
  `additional_for_actInact` int(22) DEFAULT NULL,
  `additional_for_concessionct` int(22) DEFAULT NULL,
  `table_for_entry` varchar(265) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `entry_modes`
--

INSERT INTO `entry_modes` (`id`, `entry_mode_name`, `entry_mode`, `crdr`, `additional_for_actInact`, `additional_for_concessionct`, `table_for_entry`) VALUES
(1, 'CONCESSION', 15, 'C', NULL, 1, 'financial_trans'),
(2, 'DUE', 0, 'D', NULL, NULL, 'financial_trans'),
(3, 'REVDUE', 12, 'C', NULL, NULL, 'financial_trans'),
(4, 'REVCONCESSION', 16, 'D', NULL, NULL, 'financial_trans'),
(5, 'REVSCHOLARSHIP', 16, 'D', NULL, NULL, 'financial_trans'),
(6, 'SCHOLARSHIP', 15, 'C', NULL, 2, 'financial_trans'),
(7, 'RCPT', 0, 'C', 0, NULL, 'common_fee_collections'),
(8, 'REVRCPT', 0, 'D', NULL, NULL, 'common_fee_collections'),
(9, 'FUNDTRANSFER', 1, 'POSITIVE AND NEGATIVE', NULL, NULL, 'common_fee_collections'),
(10, 'PMT', 1, 'D', 0, NULL, 'common_fee_collections'),
(11, 'REVPMT', 1, 'C', 1, NULL, 'common_fee_collections'),
(12, 'JV', 14, 'C', 0, NULL, 'common_fee_collections'),
(13, 'REVJV', 14, 'D', 1, NULL, 'common_fee_collections');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entry_modes`
--
ALTER TABLE `entry_modes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entry_modes`
--
ALTER TABLE `entry_modes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
