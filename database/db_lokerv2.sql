-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 05, 2022 at 01:33 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lokerv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `kartu`
--

CREATE TABLE `kartu` (
  `id` int(11) NOT NULL,
  `kartu_uid` varchar(16) NOT NULL,
  `type` enum('normal','mastercard') NOT NULL DEFAULT 'normal',
  `loker_id` varchar(16) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartu`
--

INSERT INTO `kartu` (`id`, `kartu_uid`, `type`, `loker_id`, `created_at`, `updated_at`) VALUES
(1, 'd745b819', 'normal', 'A01', '2022-01-10 01:13:58', NULL),
(2, '57d85d9', 'normal', 'A02', '2022-01-10 01:13:58', NULL),
(3, '55fce42a', 'normal', 'A03', '2022-01-10 01:13:58', NULL),
(4, 'ht489a9v', 'normal', 'B01', '2022-01-10 03:51:19', NULL),
(5, '23y81f9', 'normal', 'B02', '2022-01-10 03:51:19', NULL),
(6, 'c67m1906', 'normal', 'B03', '2022-01-10 03:51:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `id` int(11) NOT NULL,
  `kode_loker` varchar(6) NOT NULL,
  `status` enum('kosong','dipakai') NOT NULL DEFAULT 'kosong',
  `berat` int(2) NOT NULL,
  `last_borrowed` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`id`, `kode_loker`, `status`, `berat`, `last_borrowed`, `created_at`, `updated_at`) VALUES
(1, 'A01', 'kosong', 1, '2022-06-05 10:48:18', '2022-01-10 01:16:13', NULL),
(2, 'A02', 'kosong', 0, '2022-06-05 10:46:00', '2022-01-10 01:16:13', NULL),
(3, 'A03', 'dipakai', 0, '2022-01-11 01:08:05', '2022-01-10 01:16:57', NULL),
(4, 'B01', 'dipakai', 0, '2022-06-03 16:27:09', '2022-01-10 01:16:57', NULL),
(5, 'B02', 'kosong', 0, '2022-01-09 22:59:24', '2022-01-10 01:16:57', NULL),
(6, 'B03', 'kosong', 0, NULL, '2022-01-10 01:16:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) NOT NULL,
  `nim` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `angkatan` year(4) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `prodi`, `angkatan`, `status`, `created_at`) VALUES
(1, '41288901', 'Ardy Armando', 'Teknik Informatika', 2022, 'aktif', '2022-01-10 01:29:36'),
(2, '41288902', 'Melina Witri', 'Teknik Informatika', 2022, 'aktif', '2022-01-10 01:29:36'),
(4, '4412550', 'Deva Rahmat Ladio', 'Teknik Informatika', 2022, 'aktif', '2022-01-11 02:45:49');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint(20) NOT NULL,
  `nim` varchar(16) NOT NULL,
  `kartu` varchar(16) NOT NULL,
  `loker` varchar(6) NOT NULL,
  `status` enum('dipakai','selesai') NOT NULL DEFAULT 'dipakai',
  `in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `out` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `nim`, `kartu`, `loker`, `status`, `in`, `out`, `created_at`) VALUES
(1, '41288901', 'd745b819', 'A01', 'selesai', '2022-01-10 04:37:33', '2022-01-10 06:59:21', '2022-01-10 04:37:33'),
(2, '41288902', '23y81f9', 'B02', 'selesai', '2022-01-10 04:59:24', '2022-01-10 09:13:09', '2022-01-10 04:59:24'),
(3, '41288902', '55fce42a', 'A03', 'dipakai', '2022-01-11 01:08:05', NULL, '2022-01-11 01:08:05'),
(4, '41288901', 'ht489a9v', 'B01', 'dipakai', '2022-06-03 16:27:09', NULL, '2022-06-03 16:27:09'),
(5, '4412550', 'd745b819', 'A01', 'selesai', '2022-06-05 10:45:04', '2022-06-05 10:47:38', '2022-06-05 10:45:04'),
(6, '41288901', '57d85d9', 'A02', 'selesai', '2022-06-05 10:46:00', '2022-06-05 10:51:37', '2022-06-05 10:46:00'),
(7, '4412550', 'd745b819', 'A01', 'selesai', '2022-06-05 10:48:18', '2022-06-05 10:51:52', '2022-06-05 10:48:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL DEFAULT 'default.png',
  `role` enum('staff','admin') NOT NULL DEFAULT 'staff',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `photo`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Rizky Putra', '$2a$12$2qBbm6krvA6ua6Qj73xxrOnP5K/hlASMeTmV84pFFlYkBOMyYZDiG', 'TzBpQWre73Nuj6XZ-11012022.jpg', 'admin', '2022-01-10 01:09:55', NULL),
(2, 'staff', 'Maulita Rizchita Putri', '$2a$12$Ty3qhQ3PQLQh2fQ/dxOCx.eNzMULczHP4od.SyBse/.fjaHwfK3K.', 'b2gE3Z5tki9OxwRC-11012022.jpg', 'staff', '2022-01-10 01:09:55', NULL),
(5, 'rizal', 'Rizal', '$2y$10$F/Z8T5yTjw/DwF9gbTDSGeIRv76mm516C8ZCBwVtZqkMoVsYZZyjm', 'default.png', 'staff', '2022-01-11 04:54:23', '2022-01-11 04:57:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kartu`
--
ALTER TABLE `kartu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kartu_uid` (`kartu_uid`);

--
-- Indexes for table `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_loker` (`kode_loker`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kartu`
--
ALTER TABLE `kartu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `loker`
--
ALTER TABLE `loker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
