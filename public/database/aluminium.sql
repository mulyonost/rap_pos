-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 03:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rap_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `aluminium`
--

CREATE TABLE IF NOT EXISTS `aluminium` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `base_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finishing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat_maksimal` decimal(5,3) NOT NULL,
  `stok_awal` int(11) NOT NULL DEFAULT 0,
  `stok_minimum` int(11) NOT NULL DEFAULT 0,
  `stok_sekarang` int(11) NOT NULL,
  `berat_jual` decimal(5,3) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aluminium`
--

INSERT INTO `aluminium` (`id`, `base_name`, `nama`, `finishing`, `kategori`, `berat_maksimal`, `stok_awal`, `stok_minimum`, `stok_sekarang`, `berat_jual`, `harga_jual`, `foto`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'hollow-22-x-22-kotak', 'HOLLOW 22 X 22 KOTAK MF', 'MF', 'ALUMINIUM', '0.550', 0, 0, 0, '0.550', 30500, 'hollow-22-x-22-kotak-mf.jpg', NULL, '2021-10-24 17:28:01', '2021-10-24 17:28:01'),
(2, 'hollow-22-x-22-kotak', 'HOLLOW 22 X 22 KOTAK CA', 'CA', 'ALUMINIUM', '0.550', 0, 0, 0, '0.550', 30500, 'hollow-22-x-22-kotak-ca.jpg', NULL, '2021-10-24 17:29:07', '2021-10-24 17:29:07'),
(3, 'hollow-22-x-22-kotak', 'HOLLOW 22 X 22 KOTAK BR', 'BR', 'ALUMINIUM', '0.550', 0, 0, 0, '0.550', 34500, 'hollow-22-x-22-kotak-br.jpg', NULL, '2021-10-24 17:29:32', '2021-10-24 17:29:32'),
(4, 'hollow-22-x-22-oval', 'HOLLOW 22 X 22 OVAL MF', 'MF', 'ALUMINIUM', '0.500', 0, 0, 0, '0.550', 30000, 'hollow-22-x-22-oval-mf.jpg', NULL, '2021-10-24 17:32:57', '2021-10-24 17:32:57'),
(5, 'hollow-22-x-22-oval', 'HOLLOW 22 X 22 OVAL CA', 'CA', 'ALUMINIUM', '0.500', 0, 0, 0, '0.550', 30000, 'hollow-22-x-22-oval-ca.jpg', NULL, '2021-10-24 17:33:42', '2021-10-24 17:33:42'),
(6, 'hollow-22-x-22-oval', 'HOLLOW 22 X 22 OVAL BR', 'BR', 'ALUMINIUM', '0.550', 0, 0, 0, '0.550', 34000, 'hollow-22-x-22-oval-br.jpg', NULL, '2021-10-24 17:34:06', '2021-10-24 17:34:06'),
(7, 'openback-3', 'OPENBACK 3\" MF', 'MF', 'ALUMINIUM', '2.120', 0, 0, 0, '2.300', 110000, 'openback-3-mf.jpg', NULL, '2021-10-24 17:35:36', '2021-10-24 17:35:36'),
(8, 'openback-sakura', 'OPENBACK SAKURA MF', 'MF', 'ALUMINIUM', '1.160', 0, 0, 0, '1.200', 90000, 'openback-sakura-mf.jpg', NULL, '2021-10-24 17:40:27', '2021-10-24 17:40:27'),
(9, 'hollow-22-x-34', 'HOLLOW 22 X 34 MF', 'MF', 'ALUMINIUM', '0.710', 0, 0, 0, '0.750', 35000, NULL, NULL, '2021-10-24 17:42:01', '2021-10-24 17:42:01'),
(10, 'pipa-19mm', 'PIPA 19MM MF', 'MF', 'ALUMINIUM', '0.380', 0, 0, 0, '0.400', 22000, 'pipa-19mm-mf.jpg', NULL, '2021-10-24 17:43:41', '2021-10-24 17:43:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluminium`
--
ALTER TABLE `aluminium`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluminium`
--
ALTER TABLE `aluminium`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
