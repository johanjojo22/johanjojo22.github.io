-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 12:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ruas_jalan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id_laporan` int(11) NOT NULL,
  `nama_kegiatan` varchar(254) NOT NULL,
  `lokasi_lap` varchar(254) NOT NULL,
  `sumber_dana` varchar(254) NOT NULL,
  `anggaran_kes` varchar(254) NOT NULL,
  `anggaran_fis` varchar(254) NOT NULL,
  `nilai_kontrak` varchar(254) NOT NULL,
  `realisasi` varchar(254) NOT NULL,
  `persenan` varchar(254) NOT NULL,
  `sisa_anggaran` varchar(254) NOT NULL,
  `sisa_tender` varchar(254) NOT NULL,
  `realisasi_fisik` varchar(254) NOT NULL,
  `denda` varchar(254) NOT NULL,
  `kontrak_pelaksana` varchar(254) NOT NULL,
  `tanggal_kontrak` varchar(254) NOT NULL,
  `tgl_spmk` varchar(254) NOT NULL,
  `tgl_selesai` varchar(254) NOT NULL,
  `keterangan` varchar(254) NOT NULL,
  `bulan_lap` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan_kegiatan`
--

INSERT INTO `laporan_kegiatan` (`id_laporan`, `nama_kegiatan`, `lokasi_lap`, `sumber_dana`, `anggaran_kes`, `anggaran_fis`, `nilai_kontrak`, `realisasi`, `persenan`, `sisa_anggaran`, `sisa_tender`, `realisasi_fisik`, `denda`, `kontrak_pelaksana`, `tanggal_kontrak`, `tgl_spmk`, `tgl_selesai`, `keterangan`, `bulan_lap`) VALUES
(1, 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'aa1', 'Oktober'),
(4, 'lala', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Februari');

-- --------------------------------------------------------

--
-- Table structure for table `ruas_jalan`
--

CREATE TABLE `ruas_jalan` (
  `id` int(11) NOT NULL,
  `no_ruas` varchar(254) NOT NULL,
  `nama_ruas` varchar(254) NOT NULL,
  `kecamatan` varchar(254) NOT NULL,
  `desa` varchar(254) NOT NULL,
  `panjang_ruas` varchar(254) NOT NULL,
  `status` varchar(254) NOT NULL,
  `baik` varchar(16) NOT NULL,
  `sedang` varchar(16) NOT NULL,
  `rusak_ringan` varchar(16) NOT NULL,
  `rusak_berat` varchar(16) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `tahun` varchar(16) NOT NULL,
  `gambar` varchar(254) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `added_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruas_jalan`
--

INSERT INTO `ruas_jalan` (`id`, `no_ruas`, `nama_ruas`, `kecamatan`, `desa`, `panjang_ruas`, `status`, `baik`, `sedang`, `rusak_ringan`, `rusak_berat`, `kondisi`, `tahun`, `gambar`, `link`, `added_at`) VALUES
(1, '69', 'Hayang diewe', 'Moniyan', 'Land of Dawn', '200', 'Sagne', '25', '35', '65', '45', 'Tidak Mantap', '2022', '647cb8a68c8cc.png,647cb8a68cc0a.png,647cb8a68ce6a.png,647cb8a68d211.png,647cb8a68d462.png,647cb8a68d696.png,647cb8a68d8ec.png,647cb8a68db73.png', 'https://www.instagram.com/?hl=id', '2023-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `level` varchar(2) NOT NULL,
  `added_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `added_at`) VALUES
(1, 'febryan', '$2y$10$EbxB.8MlWN8mwW2JzR3UEujIm.wke6lt3gItd3pUTEzbiTpOqANq2', '1', '2023-05-19'),
(2, 'wanwan', '$2y$10$TlnmhEgkqOusN1ebEi73te.4E8sOYpe46b.kpPBLS71M4kSv4PJGq', '2', '2023-06-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `ruas_jalan`
--
ALTER TABLE `ruas_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruas_jalan`
--
ALTER TABLE `ruas_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
