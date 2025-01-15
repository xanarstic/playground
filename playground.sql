-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 06:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playground`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_user`, `activity`, `time`) VALUES
(1, 1, 'Login', '2025-01-13 12:19:46'),
(2, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:19:46'),
(3, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:21:27'),
(4, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:23:30'),
(5, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:25:03'),
(6, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:27:02'),
(7, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:29:06'),
(8, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:29:33'),
(9, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:29:48'),
(10, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:31:57'),
(11, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:32:32'),
(12, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:34:24'),
(13, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:34:55'),
(14, NULL, 'Masuk Menu Setting', '2025-01-13 12:34:58'),
(15, NULL, 'Masuk Menu Setting', '2025-01-13 12:35:55'),
(16, NULL, 'Masuk Menu Setting', '2025-01-13 12:36:15'),
(17, NULL, 'Masuk Menu Setting', '2025-01-13 12:38:35'),
(18, NULL, 'Masuk Menu Setting', '2025-01-13 12:39:10'),
(19, NULL, 'Masuk Menu Setting', '2025-01-13 12:39:32'),
(20, NULL, 'Masuk Menu Setting', '2025-01-13 12:42:30'),
(21, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:42:49'),
(22, 1, 'Login', '2025-01-13 12:52:22'),
(23, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:52:23'),
(24, NULL, 'Masuk Menu Dashboard', '2025-01-13 12:55:15'),
(25, 1, 'Login', '2025-01-13 13:12:44'),
(26, NULL, 'Masuk Menu Dashboard', '2025-01-13 13:12:44'),
(27, NULL, 'Masuk Menu Dashboard', '2025-01-13 13:14:20'),
(28, NULL, 'Masuk Menu Dashboard', '2025-01-13 13:14:41');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `id_wahana` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_mulai` time DEFAULT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `durasi` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Berjalan','Selesai') DEFAULT 'Pending',
  `nama_ortu` varchar(255) DEFAULT NULL,
  `nohp` varchar(255) DEFAULT NULL,
  `nama_anak` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `id_wahana`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `durasi`, `total`, `status`, `nama_ortu`, `nohp`, `nama_anak`, `created_at`, `updated_at`) VALUES
(8, 1, '2025-01-15', '11:33:00', '13:33:00', 2, '20000.00', 'Pending', 'tes', '081363613838', 'rsttset', '2025-01-15 04:33:25', '2025-01-15 04:33:25'),
(9, 1, '2025-01-15', '11:35:00', '14:35:00', 3, '30000.00', 'Pending', 'tes', '12314', '52asd', '2025-01-15 04:36:03', '2025-01-15 04:36:03'),
(10, 1, '2025-01-15', '11:59:00', '14:59:00', 3, '30000.00', 'Pending', 'res', '2333', 'yyus', '2025-01-15 05:00:03', '2025-01-15 05:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `namawebsite` varchar(255) DEFAULT NULL,
  `icontab` varchar(255) DEFAULT NULL,
  `iconlogin` varchar(255) DEFAULT NULL,
  `iconmenu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `namawebsite`, `icontab`, `iconlogin`, `iconmenu`) VALUES
(1, 'Aplikasi Playground', 'logo_sph (1).png', 'sigma.jpg', 'logo_sph (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_transaksi` varchar(255) DEFAULT NULL,
  `id_penyewaan` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `bayar` varchar(255) DEFAULT NULL,
  `kembalian` varchar(255) DEFAULT NULL,
  `payment` enum('Cash','Transfer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `id_penyewaan`, `total`, `bayar`, `kembalian`, `payment`) VALUES
(1, 'TRXE9D760BF', '', '30000', '50000', '20000', 'Transfer'),
(2, 'TRX12CBD43C', '', '30000', '30000', '0', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_level` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `level` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_level`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`, `level`) VALUES
(2, NULL, '2', 'c81e728d9d4c2f636f067f89cc14862c', '2025-01-14 10:13:20', '2025-01-14 10:13:20', NULL, 'Admin'),
(3, NULL, '1', 'c4ca4238a0b923820dcc509a6f75849b', '2025-01-14 10:13:33', '2025-01-14 10:13:33', NULL, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `wahana`
--

CREATE TABLE `wahana` (
  `id_wahana` int(11) NOT NULL,
  `nama_wahana` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `kapasitas` varchar(255) DEFAULT NULL,
  `status` enum('Tersedia','Tidak Tersedia') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `wahana`
--

INSERT INTO `wahana` (`id_wahana`, `nama_wahana`, `harga`, `kapasitas`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'kuda epan', '10000', '100', 'Tersedia', '2025-01-14 21:46:36', '2025-01-14 21:46:36', NULL),
(2, 'lig gang guling', '5000', '5', 'Tersedia', '2025-01-14 21:46:50', '2025-01-14 21:46:50', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`) USING BTREE;

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`) USING BTREE;

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- Indexes for table `wahana`
--
ALTER TABLE `wahana`
  ADD PRIMARY KEY (`id_wahana`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wahana`
--
ALTER TABLE `wahana`
  MODIFY `id_wahana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
