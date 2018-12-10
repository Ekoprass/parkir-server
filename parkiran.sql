-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 07:11 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkiran`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(10) NOT NULL,
  `nama_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akses` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_user`, `nama_user`, `password`, `alamat`, `jenis_kelamin`, `akses`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '1'),
(2, 'Superadmin', '200ceb26807d6bf99fd6f4f0d1ca54d4', '', '', '2'),
(3, 'ekoprass', '69feb7e9fa8fe21696f2668374136e83', 'Jl. Panjaitan 20', 'Laki-laki', '2');

-- --------------------------------------------------------

--
-- Table structure for table `parkir`
--

CREATE TABLE `parkir` (
  `no_karcis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_masuk` datetime NOT NULL,
  `waktu_keluar` datetime NOT NULL,
  `plat_nomor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_parkiran` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkir`
--

INSERT INTO `parkir` (`no_karcis`, `waktu_masuk`, `waktu_keluar`, `plat_nomor`, `kode_parkiran`, `status`) VALUES
('S6761WS-20181024-123404', '2018-10-24 12:34:04', '0000-00-00 00:00:00', 'S6761WS', 'G-K1', 1),
('S6761WS-20181107-151959', '2018-11-07 15:19:59', '2018-11-07 15:20:48', 'S6761WS', 'G-A1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parkiran`
--

CREATE TABLE `parkiran` (
  `kode_parkiran` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_parkiran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkiran`
--

INSERT INTO `parkiran` (`kode_parkiran`, `nama_parkiran`, `kapasitas`) VALUES
('G-A1', 'Gedung A Lantai 1', 100),
('G-AA1', 'Gedung AA', 50),
('G-K1', 'Kantin Lantai 1', 150),
('G-SP1', 'Gedung Sipil Lantai 1', 200);

-- --------------------------------------------------------

--
-- Table structure for table `parkir_transaksi`
--

CREATE TABLE `parkir_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_karcis` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` int(10) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parkir_transaksi`
--

INSERT INTO `parkir_transaksi` (`id_transaksi`, `no_karcis`, `user`, `biaya`) VALUES
(1, 'S6761WS-20181107-151959', 1, 2000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `akses` (`akses`);

--
-- Indexes for table `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`no_karcis`),
  ADD KEY `plat_nomor` (`plat_nomor`),
  ADD KEY `kode_parkiran` (`kode_parkiran`);

--
-- Indexes for table `parkiran`
--
ALTER TABLE `parkiran`
  ADD PRIMARY KEY (`kode_parkiran`),
  ADD UNIQUE KEY `nama_parkiran` (`nama_parkiran`);

--
-- Indexes for table `parkir_transaksi`
--
ALTER TABLE `parkir_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `no_karcis` (`no_karcis`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parkir_transaksi`
--
ALTER TABLE `parkir_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parkir`
--
ALTER TABLE `parkir`
  ADD CONSTRAINT `parkir_ibfk_1` FOREIGN KEY (`kode_parkiran`) REFERENCES `parkiran` (`kode_parkiran`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parkir_transaksi`
--
ALTER TABLE `parkir_transaksi`
  ADD CONSTRAINT `parkir_transaksi_ibfk_1` FOREIGN KEY (`user`) REFERENCES `admin` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
