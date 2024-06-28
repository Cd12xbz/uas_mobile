-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 10:07 AM
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
-- Database: `apus`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-06-28-003938', 'App\\Database\\Migrations\\Siswa', 'default', 'App', 1719538271, 1),
(2, '2024-06-28-013153', 'App\\Database\\Migrations\\Pembayaran', 'default', 'App', 1719539100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(5) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `nis_siswa` varchar(20) NOT NULL,
  `nominal` int(5) NOT NULL,
  `berita` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `tanggal`, `nis_siswa`, `nominal`, `berita`, `created_at`, `updated_at`) VALUES
(1, '2024-06-28 08:47:13', '2113030108', 250000, 'Uang Pemakalah', '2024-06-28 08:47:13', '2024-06-28 08:47:13'),
(2, '2024-06-28 08:47:13', '2030101008', 150000, 'Uang Laboratorium', '2024-06-28 08:47:13', '2024-06-28 08:47:13'),
(4, '2024-06-28 11:06:20', '2030101008', 600000, 'Heregrestrasi GNP 2023/2024', '2024-06-28 04:06:20', '2024-06-28 04:06:20'),
(5, '2024-06-28 11:13:27', '2030101008', 1000000, 'Wisuda', '2024-06-28 04:13:27', '2024-06-28 04:13:27'),
(6, '2024-06-28 11:13:32', '2113030108', 75000, 'Pendaftaran Workshop Excel', '2024-06-28 04:13:32', '2024-06-28 05:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `kelas`) VALUES
('2030101008', 'Melianningrum', 'XII-IPA 2'),
('2113030108', 'Theo Krisna Amarya', 'XII-IPA 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_nis_siswa_foreign` (`nis_siswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_nis_siswa_foreign` FOREIGN KEY (`nis_siswa`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
