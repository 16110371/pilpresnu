-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2026 at 03:17 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pilpres`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`username`, `password`) VALUES
('admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `tb_datapilketos`
--

CREATE TABLE `tb_datapilketos` (
  `id` int NOT NULL DEFAULT '1',
  `tapel` varchar(10) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_datapilketos`
--

INSERT INTO `tb_datapilketos` (`id`, `tapel`, `tgl`) VALUES
(1, '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_identitassekolah`
--

CREATE TABLE `tb_identitassekolah` (
  `npsn` varchar(15) NOT NULL,
  `nm_sekolah` varchar(32) NOT NULL,
  `jln` varchar(32) DEFAULT NULL,
  `desa` varchar(32) DEFAULT NULL,
  `kec` varchar(32) DEFAULT NULL,
  `kab` varchar(32) DEFAULT NULL,
  `kpl_sekolah` varchar(32) DEFAULT NULL,
  `nip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_identitassekolah`
--

INSERT INTO `tb_identitassekolah` (`npsn`, `nm_sekolah`, `jln`, `desa`, `kec`, `kab`, `kpl_sekolah`, `nip`) VALUES
('22556622', 'NAMA SEKOLAH', 'Jl. Alamat', 'Desa', 'Kecamatan', 'Kabupaten', 'Nama Kepala Sekolah', '102841204123809');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kd_kelas` int NOT NULL,
  `nm_kelas` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kd_kelas`, `nm_kelas`) VALUES
(1, 'OZZA'),
(2, 'PASYA'),
(3, 'QUDWA'),
(4, 'ALYAN'),
(5, 'BARIZAN'),
(6, 'LAITSI'),
(7, 'MADANI'),
(8, 'NAJMI'),
(9, 'CHISAN'),
(10, 'DAYYAN'),
(11, 'EIDLAN'),
(12, 'GURUSMK'),
(13, 'GURUSMP'),
(14, 'GURUMAD'),
(15, 'PENGURUS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pilih`
--

CREATE TABLE `tb_pilih` (
  `id_pilih` int NOT NULL,
  `nisn` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `jk_pilihan` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pilih`
--

INSERT INTO `tb_pilih` (`id_pilih`, `nisn`, `username`, `jk_pilihan`) VALUES
(1669, '1', '1001', 'L'),
(1670, '2', '1002', 'P'),
(1671, '1', '1234', 'L'),
(1672, '3', '1234', 'P'),
(1673, '1', '131', 'L'),
(1674, '4', '121', 'P'),
(1675, '1', '313', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pilihan`
--

CREATE TABLE `tb_pilihan` (
  `nisn` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `visimisi` text,
  `photo` varchar(32) NOT NULL,
  `no` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pilihan`
--

INSERT INTO `tb_pilihan` (`nisn`, `nama`, `jk`, `visimisi`, `photo`, `no`) VALUES
('1', '1', 'L', 'adsfasdf', '1.png', 1),
('2', 'Eka Ramadhani & Rusdi Adnanul A', 'P', 'Visi: Menjadi kedai kopi kekinian terkemuka yang menghadirkan cita rasa kopi autentik Indonesia.\r\n\r\nMisi: Menyediakan kopi berkualitas tinggi dari petani lokal, menciptakan tempat nyaman, dan mengedukasi pelanggan tentang jenis kopi.', '2.png', 2),
('3', 'FARAH AULIA & SHEILA ZUHRUFA', 'P', 'asdfasdfsadfsadfsadfsdafljsadkfjksdajfsakjfklasj', '3.png', 3),
('4', 'M Nur Syarif & Zaky Tri A', 'P', 'asdfasdf', '4.png', 4),
('5', 'Kedua', 'P', '', '5.png', 5),
('6', 'qqqqq', 'L', 'Visi: Menjadi penyedia teknologi inovatif yang mudah digunakan oleh semua orang.\r\nMisi: Mengembangkan solusi user-friendly dan berinovasi secara berkelanjutan untuk menghadirkan produk berkualitas.', '6.png', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nm_siswa` varchar(32) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `kd_kelas` int DEFAULT NULL,
  `hadir` varchar(12) NOT NULL DEFAULT 'Tidak Hadir',
  `role` enum('siswa','dpp') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'siswa'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`username`, `password`, `nm_siswa`, `jk`, `kd_kelas`, `hadir`, `role`) VALUES
('1001', '1001', 'Ahmad Ma\'ruf', 'L', 1, 'Hadir', 'siswa'),
('1002', '1002', 'Aisyah N', 'P', 2, 'Hadir', 'siswa'),
('121', '121', 'aaaa', 'P', 14, 'Hadir', 'siswa'),
('1234', '1234', 'Ustadz Fulan', 'L', 12, 'Hadir', 'dpp'),
('131', '131', 'Adnan', 'L', 7, 'Hadir', 'siswa'),
('313', '313', 'gggg', 'L', 8, 'Hadir', 'siswa'),
('SMK-111', 'SMK-111', 'AdnanNN', 'P', 5, 'Tidak Hadir', 'siswa'),
('SMK-123', 'SMK-123', 'Adnan', 'L', 1, 'Tidak Hadir', 'siswa');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_daftarhadir`
-- (See below for the actual view)
--
CREATE TABLE `view_daftarhadir` (
`NISN` varchar(32)
,`nm_kelas` varchar(32)
,`nm_siswa` varchar(32)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_vote`
-- (See below for the actual view)
--
CREATE TABLE `view_vote` (
`nama` varchar(32)
,`nisn` varchar(32)
,`no` int
,`photo` varchar(32)
,`username` varchar(32)
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_datapilketos`
--
ALTER TABLE `tb_datapilketos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_identitassekolah`
--
ALTER TABLE `tb_identitassekolah`
  ADD PRIMARY KEY (`npsn`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `tb_pilih`
--
ALTER TABLE `tb_pilih`
  ADD PRIMARY KEY (`id_pilih`);

--
-- Indexes for table `tb_pilihan`
--
ALTER TABLE `tb_pilihan`
  ADD PRIMARY KEY (`nisn`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `kd_kelas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_pilih`
--
ALTER TABLE `tb_pilih`
  MODIFY `id_pilih` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1676;

-- --------------------------------------------------------

--
-- Structure for view `view_daftarhadir`
--
DROP TABLE IF EXISTS `view_daftarhadir`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_daftarhadir`  AS SELECT `tb_siswa`.`username` AS `NISN`, `tb_siswa`.`nm_siswa` AS `nm_siswa`, `tb_kelas`.`nm_kelas` AS `nm_kelas` FROM ((`tb_siswa` join `tb_kelas` on((`tb_kelas`.`kd_kelas` = `tb_siswa`.`kd_kelas`))) join `tb_pilih` on((`tb_siswa`.`username` = `tb_pilih`.`username`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_vote`
--
DROP TABLE IF EXISTS `view_vote`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_vote`  AS SELECT `tb_pilihan`.`nisn` AS `nisn`, `tb_pilihan`.`nama` AS `nama`, `tb_pilihan`.`photo` AS `photo`, `tb_pilihan`.`no` AS `no`, `tb_siswa`.`username` AS `username` FROM ((`tb_pilih` join `tb_pilihan` on((`tb_pilihan`.`nisn` = `tb_pilih`.`nisn`))) join `tb_siswa` on((`tb_siswa`.`username` = `tb_pilih`.`username`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
