-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2020 at 03:01 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mareta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_detail`
--

CREATE TABLE `tabel_detail` (
  `id` int(5) NOT NULL,
  `nomor_pendaftaran` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_detail`
--

INSERT INTO `tabel_detail` (`id`, `nomor_pendaftaran`, `id_kriteria`, `nilai`) VALUES
(1, '1', 1, 87),
(2, '1', 2, 60),
(3, '1', 3, 57),
(4, '1', 4, 60),
(5, '1', 5, 36.67),
(6, '1', 6, 50),
(7, '1', 7, 75),
(8, '1', 8, 85),
(9, '1', 9, 62),
(10, '1', 10, 57.5),
(11, '1', 11, 50),
(12, '1', 12, 86),
(13, '1', 13, 78),
(40, '4', 1, 87),
(41, '4', 2, 80),
(42, '4', 3, 90),
(43, '4', 4, 90),
(44, '4', 5, 88),
(45, '4', 6, 68),
(46, '4', 7, 66.67),
(47, '4', 8, 73),
(48, '4', 9, 73),
(49, '4', 10, 60),
(50, '4', 11, 67),
(51, '4', 12, 86),
(52, '4', 13, 86),
(53, '5', 1, 88),
(54, '5', 2, 62),
(55, '5', 3, 37),
(56, '5', 4, 37),
(57, '5', 5, 36.67),
(58, '5', 6, 37),
(59, '5', 7, 56.67),
(60, '5', 8, 63),
(61, '5', 9, 67),
(62, '5', 10, 35),
(63, '5', 11, 55),
(64, '5', 12, 76),
(65, '5', 13, 65),
(79, '3', 1, 87),
(80, '3', 2, 80),
(81, '3', 3, 97),
(82, '3', 4, 72),
(83, '3', 5, 85),
(84, '3', 6, 85),
(85, '3', 7, 73.33),
(86, '3', 8, 73),
(87, '3', 9, 60),
(88, '3', 10, 77.5),
(89, '3', 11, 87.5),
(90, '3', 12, 86),
(91, '3', 13, 80),
(131, '6', 13, 1),
(132, '6', 12, 2),
(133, '6', 11, 3),
(134, '6', 10, 4),
(135, '6', 9, 5),
(136, '6', 8, 6),
(137, '6', 7, 7),
(138, '6', 6, 8.9),
(139, '6', 5, 9),
(140, '6', 4, 10),
(141, '6', 3, 11),
(142, '6', 2, 12),
(143, '6', 1, 13),
(144, '2', 13, 42),
(145, '2', 12, 56),
(146, '2', 11, 55),
(147, '2', 10, 45),
(148, '2', 9, 65),
(149, '2', 8, 62),
(150, '2', 7, 61.67),
(151, '2', 6, 40),
(152, '2', 5, 30),
(153, '2', 4, 43),
(154, '2', 3, 40),
(155, '2', 2, 57),
(156, '2', 1, 87);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_hasil`
--

CREATE TABLE `tabel_hasil` (
  `nomor_pendaftaran` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_jurusan` int(5) NOT NULL,
  `net_flow` double NOT NULL,
  `entering_flow` double NOT NULL,
  `leaving_flow` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_hasil`
--

INSERT INTO `tabel_hasil` (`nomor_pendaftaran`, `id_jurusan`, `net_flow`, `entering_flow`, `leaving_flow`) VALUES
('1', 2, 0.23790507364975, 0.087692307692308, 0.32559738134206),
('2', 2, -0.21103109656301, 0.26432078559738, 0.05328968903437),
('3', 2, 0.0078972461396143, 0.16138618088664, 0.16928342702626),
('4', 2, 0.1988956094784, 0.080371450935743, 0.27926706041415),
('5', 2, -0.23366683270476, 0.30089091297232, 0.067224080267559),
('6', 3, 0, 0, 0),
('1', 1, -0.15028752726855, 0.24949777514129, 0.099210247872734),
('2', 1, -0.3558698432138, 0.3741138313751, 0.018243988161302),
('3', 1, 0.5246408600916, 0.015653871177619, 0.54029473126922),
('4', 1, 0.3889396277444, 0.042794117647059, 0.43173374539146),
('5', 1, -0.40742311735364, 0.41535645068698, 0.0079333333333333),
('1', 3, -0.049953886693017, 0.10345849802372, 0.053504611330698),
('2', 3, -0.25459815546772, 0.25459815546772, 0),
('3', 3, 0.10676548089592, 0.037727272727273, 0.14449275362319),
('4', 3, 0.12040184453228, 0.035, 0.15540184453228),
('5', 3, 0.077384716732543, 0.097055335968379, 0.17444005270092);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_jurusan`
--

CREATE TABLE `tabel_jurusan` (
  `id_jurusan` int(5) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_jurusan`
--

INSERT INTO `tabel_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'IPA'),
(2, 'IPS'),
(3, 'Bahasa');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kriteria`
--

CREATE TABLE `tabel_kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `jenis` varchar(15) NOT NULL DEFAULT 'Benefit',
  `id_jurusan` int(5) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_kriteria`
--

INSERT INTO `tabel_kriteria` (`id_kriteria`, `nama_kriteria`, `jenis`, `id_jurusan`, `bobot`) VALUES
(1, 'Nilai Test Bhs Indonesia', 'Benefit', 3, 0.07),
(2, 'Nilai Test Bhs Inggris', 'Benefit', 3, 0.07),
(3, 'Nilai Test Matematika', 'Benefit', 1, 0.08),
(4, 'Nilai Test Fisika', 'Benefit', 1, 0.08),
(5, 'Nilai Kimia', 'Benefit', 1, 0.08),
(6, 'Nilai Biologi', 'Benefit', 1, 0.08),
(7, 'Nilai Geografi ', 'Benefit', 2, 0.12),
(8, 'Nilai Ekonomi', 'Benefit', 2, 0.12),
(9, 'Nilai Sejarah', 'Benefit', 2, 0.12),
(10, 'UN Matematika', 'Benefit', 1, 0.05),
(11, 'UN IPA', 'Benefit', 1, 0.05),
(12, 'UN Bhs Indonesia', 'Benefit', 3, 0.04),
(13, 'UN Bhs Inggris', 'Benefit', 3, 0.04);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_login`
--

CREATE TABLE `tabel_login` (
  `id` int(5) NOT NULL,
  `username` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tabel_login`
--

INSERT INTO `tabel_login` (`id`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin'),
(10, 'staf', '7b8a17c3f48d4453fde0fd74b4fa9212', 'Agus Setiawan', 'staf'),
(11, 'kepsek', '8561863b55faf85b9ad67c52b3b851ac', 'Fajar Nugroho', 'kepsek');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_siswa`
--

CREATE TABLE `tabel_siswa` (
  `nomor_pendaftaran` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tahun_angkatan` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_siswa`
--

INSERT INTO `tabel_siswa` (`nomor_pendaftaran`, `nama_siswa`, `tahun_angkatan`) VALUES
('1', 'A1', 2000),
('2', 'A2', 2000),
('3', 'A3', 2000),
('4', 'A4', 2000),
('5', 'A5', 2000),
('6', 'Tes Peserta', 2001);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_detail`
--
ALTER TABLE `tabel_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tabel_kriteria`
--
ALTER TABLE `tabel_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tabel_login`
--
ALTER TABLE `tabel_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  ADD PRIMARY KEY (`nomor_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_detail`
--
ALTER TABLE `tabel_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  MODIFY `id_jurusan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tabel_kriteria`
--
ALTER TABLE `tabel_kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tabel_login`
--
ALTER TABLE `tabel_login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
