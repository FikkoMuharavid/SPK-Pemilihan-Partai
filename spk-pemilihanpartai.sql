-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 06:02 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk-pemilihanpartai`
--

-- --------------------------------------------------------

--
-- Table structure for table `saw_aplikasi`
--

CREATE TABLE `saw_aplikasi` (
  `nama` varchar(100) NOT NULL,
  `pengembang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saw_aplikasi`
--

INSERT INTO `saw_aplikasi` (`nama`, `pengembang`) VALUES
('Demokrat', 'Partai Demokrasi Masyarakat'),
('Gerindra', 'Partai Gerakan Indonesia Raya'),
('Golkar', 'Partai Golongan Karya'),
('Hanura', 'Partai Hati Nurani Rakyat'),
('NasDem', 'Partai Nasional Demokrat'),
('PAN', 'Partai Amanat Nasional'),
('PBB', 'Partai Bulan Bintang'),
('PDI-P', 'Partai Demokrasi Indonesia Perjuangan'),
('Perindo', 'Partai Perindo'),
('PKB', 'Partai Kebangkitan Bangsa'),
('PKS', 'Partai Keadilan Sejahtera'),
('PPP', 'Partai Persatuan Pembangunan');

-- --------------------------------------------------------

--
-- Table structure for table `saw_kriteria`
--

CREATE TABLE `saw_kriteria` (
  `no` int(11) NOT NULL,
  `peringkat` float NOT NULL,
  `ukuran` float NOT NULL,
  `unduhan` float NOT NULL,
  `aktif` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saw_kriteria`
--

INSERT INTO `saw_kriteria` (`no`, `peringkat`, `ukuran`, `unduhan`, `aktif`) VALUES
(14, 0.27, 0.2, 0.33, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `saw_penilaian`
--

CREATE TABLE `saw_penilaian` (
  `nama` varchar(100) NOT NULL,
  `peringkat` float NOT NULL,
  `ukuran` float NOT NULL,
  `unduhan` float NOT NULL,
  `aktif` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saw_penilaian`
--

INSERT INTO `saw_penilaian` (`nama`, `peringkat`, `ukuran`, `unduhan`, `aktif`) VALUES
('Gerindra', 22, 18, 62300000000, 6),
('Golkar', 59, 64, 280000000000, 13),
('Hanura', 17, 13, 8620000000, 8),
('NasDem', 12, 18, 224000000000, 9),
('PAN', 8, 28, 195000000000, 4),
('PBB', 24, 3, 1170000000, 1),
('PDI-P', 50, 66, 311000000000, 6),
('Perindo', 8, 1, 98000000, 6),
('PKB', 25, 18, 35800000000, 7),
('PKS', 25, 17, 97000000000, 2),
('PPP', 50, 19, 21800000000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `saw_perankingan`
--

CREATE TABLE `saw_perankingan` (
  `no` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai_akhir` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saw_perankingan`
--

INSERT INTO `saw_perankingan` (`no`, `nama`, `nilai_akhir`) VALUES
(1, 'Gerindra', 0.146),
(2, 'Golkar', 0.289),
(3, 'Hanura', 0.122),
(4, 'NasDem', 0.088),
(5, 'PAN', 0.094),
(6, 'PBB', 0.404),
(7, 'PDI-P', 0.265),
(8, 'Perindo', 0.6),
(9, 'PKB', 0.155),
(10, 'PKS', 0.227),
(11, 'PPP', 0.291);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saw_aplikasi`
--
ALTER TABLE `saw_aplikasi`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `saw_kriteria`
--
ALTER TABLE `saw_kriteria`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `saw_penilaian`
--
ALTER TABLE `saw_penilaian`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `saw_perankingan`
--
ALTER TABLE `saw_perankingan`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saw_kriteria`
--
ALTER TABLE `saw_kriteria`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `saw_perankingan`
--
ALTER TABLE `saw_perankingan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
