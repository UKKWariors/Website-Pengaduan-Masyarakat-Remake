-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 02:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `nik` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `verif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`nik`, `email`, `nama`, `username`, `password`, `telp`, `verif`) VALUES
('0912123912312323', 'aplessingo80@gmail.com', 'budi', 'budi', '202cb962ac59075b964b07152d234b70', '086612661232', 1),
('1231231231231231', 'mad@gmail.com', 'Mad', 'mad', '7538ebc37ad0917853e044b9b42bd8a4', '081234567891', 1),
('12313231', 'asduadug@gmail.com', 'aSsa', 'ASas', '202cb962ac59075b964b07152d234b70', '923938198', 0),
('12383828913', 'ferdiansyah140805@gmail.com', 'ferdi', 'ferdi', '202cb962ac59075b964b07152d234b70', '0816261261', 1),
('1376012310010005', 'aman@gmail.com', 'Aqil Rahman', 'masyarakat', 'd9a8c6c010a37fdc9850fe6d8c064880', '085364287180', 1),
('1421453264321642', 'bawahtangga4@gmail.com', 'Samid', 'dimas', '5a45b824c7b7803660b77dea0e1dacd2', '082301826966', 1),
('182312318', 'dwadw@gmail.com', 'awdaawdaw123', 'wadawdw1223', '202cb962ac59075b964b07152d234b70', '1232112323', 0),
('2727273819372839', 'samid@gmail.com', 'Samid', 'samid', '183302b157a276e7304caab75d9f45d2', '085964357965', 1),
('4615263849271263', 'mad@gmail.com', 'Samid', 'smid', '004de5367c3bb44ec830528e94aef40e', '085182349234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(5) NOT NULL,
  `tgl_pengaduan` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `judul` varchar(40) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('proses','selesai','ditolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nik`, `judul`, `isi_laporan`, `foto`, `status`) VALUES
(3, '2023-02-25', '1376012310010005', '', 'mamankkkkkkk', '250220234010kantor.jpg', 'selesai'),
(4, '2023-02-27', '1376012310010005', '', 'mamank', '270220231054team-image.jpg', 'selesai'),
(10, '2023-03-10', '1231231231231231', '', 'WOI', '100320230402noImage.png', 'selesai'),
(13, '2023-03-14', '12383828913', '132', '1231', '140320231732login.png', 'selesai'),
(14, '2023-03-14', '12383828913', '123123222', 'mmmm', '140320232706register.png', 'selesai'),
(16, '2023-03-16', '12383828913', '12311111111111111', '2222222222222', '160320232410download.jpg', 'selesai'),
(17, '2023-03-16', '1231231231231231', 'ck', 'cek', '160320233212login.png', 'ditolak');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(5) NOT NULL,
  `nama_petugas` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp_petugas` varchar(13) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `email`, `username`, `password`, `telp_petugas`, `level`) VALUES
(1, 'Aqil Rahman', 'admin@gmail.com', 'adminnnnn', '21232f297a57a5a743894a0e4a801fc3', '081215951492', 'petugas'),
(2, 'M Riski', 'petugas@gmail.com', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', '081215951492', 'petugas'),
(3, 'TheKingTermux', 'tkt@gmail.com', 'tkt', '7b57f31bea0ae2e9c8e2985a285b922d', '85964357965', 'admin'),
(6, 'Dam', 'dam@gmail.com', 'dam', '76ca1ef9eac7ebceeb9267daffd7fe48', '081232432356', 'petugas'),
(7, 'ferdian', 'ferwdaaw@gmail.com', 'ferdii', '202cb962ac59075b964b07152d234b70', '123', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(5) NOT NULL,
  `id_pengaduan` int(5) NOT NULL,
  `tgl_tanggapan` varchar(20) NOT NULL,
  `tanggapan` text NOT NULL,
  `bukti` varchar(255) NOT NULL,
  `id_petugas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `bukti`, `id_petugas`) VALUES
(3, 3, '2023-02-25', 'siap', '', 2),
(4, 4, '2023-03-01', 'siap mank', '', 3),
(5, 8, '2023-03-07', 'siap ditunggu', '', 3),
(12, 13, '2023-03-14', 'ok', '140320231815register.png', 3),
(13, 14, '2023-03-14', 'qSKQSKQks', '140320232733login.png', 3),
(15, 10, '2023-03-15', 'oke', 'noImage.png', 7),
(16, 16, '2023-03-16', '234569', 'noImage.png', 6),
(17, 17, '2023-03-16', 'ssssss', '160320235058140320230526register.png', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD UNIQUE KEY `isi_laporan` (`isi_laporan`) USING HASH;

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD UNIQUE KEY `id_pengaduan` (`id_pengaduan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
