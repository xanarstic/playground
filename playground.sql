-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 08:05 AM
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
(4, 1, '2025-01-16', '13:06:00', '13:08:00', 1, '10000.00', 'Berjalan', 'SDFGDFG', '546', 'GFJ', '2025-01-16 06:06:52', '2025-01-16 06:07:21'),
(5, 1, '2025-01-16', '13:09:00', '13:11:00', 1, '10000.00', 'Berjalan', 'sdg', '234234', 'rt', '2025-01-16 06:09:40', '2025-01-16 06:10:12'),
(6, 1, '2025-01-16', '13:12:00', '13:13:00', 1, '10000.00', 'Berjalan', 'qwe', '123123', 'ars', '2025-01-16 06:12:25', '2025-01-16 06:12:56'),
(7, 1, '2025-01-16', '13:50:00', '13:52:00', 1, '10000.00', 'Berjalan', 'dryt', '346', 'dfgh', '2025-01-16 06:50:37', '2025-01-16 06:51:34'),
(8, 1, '2025-01-16', '13:56:00', '13:59:00', 1, '10000.00', 'Berjalan', 'testsetset', '565656', 'asgtse', '2025-01-16 06:56:43', '2025-01-16 06:58:45');

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
  `id_penyewaan` int(11) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `bayar` varchar(255) DEFAULT NULL,
  `kembalian` varchar(255) DEFAULT NULL,
  `payment` enum('Cash','Transfer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `id_penyewaan`, `total`, `bayar`, `kembalian`, `payment`) VALUES
(1, 'TRX43A04873', 1, '10000', '10000', '0', 'Cash'),
(2, 'TRX94D98595', 2, '10000', '100000', '90000', 'Cash'),
(3, 'TRX14116E67', 3, '10000', '43634', '33634', 'Cash'),
(4, 'TRXA853CFE4', 4, '10000', '10001', '1', 'Cash'),
(5, 'TRXC7AE8F50', 5, '10000', '10000', '0', 'Cash'),
(6, 'TRXBBAA087E', 6, '10000', '10000', '0', 'Cash'),
(7, 'TRXC2205AD6', 7, '10000', '10000', '0', 'Transfer'),
(8, 'TRX1A12B3EC', 8, '10000', '10000', '0', 'Cash');

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
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
