-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 24, 2023 at 12:13 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `findPenggunaByUsernameAndPassword` (IN `in_username` VARCHAR(100), IN `in_password` VARCHAR(255))   BEGIN 
	SELECT * FROM pengguna WHERE username = in_username AND password = in_password;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `storePengguna` (IN `in_username` VARCHAR(100), IN `in_password` VARCHAR(255), IN `in_role` INT(11))   BEGIN 
	INSERT INTO pengguna (username, password, role) VALUES (in_username, in_password, in_role);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePenggunaById` (IN `in_username` VARCHAR(100), IN `in_password` VARCHAR(255), IN `in_role` INT(11), IN `in_id_pengguna` BIGINT)   BEGIN 
	UPDATE pengguna SET username = in_username,password = in_password,role = in_role WHERE id_pengguna = in_id_pengguna;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint NOT NULL,
  `nama_kelas` varchar(30) NOT NULL,
  `kompetensi_keahlian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(1, 'XII RPL2', 'Rekayasa Perangkat Lunak'),
(2, 'XII RPL1', 'Rekayasa Perangkat Lunak'),
(3, 'XII RPL3', 'Rekayasa Perangkat Lunak'),
(5, 'XII TKJ1', 'Teknik Komputer dan Jaringan'),
(6, 'XII MM2', 'MultiMedia'),
(7, 'XII TAV1', 'Teknik Speaker'),
(11, 'XI RPL2', 'Rekayasa Perangkat Lunak');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` bigint NOT NULL,
  `nominal` int NOT NULL,
  `tahun_ajaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nominal`, `tahun_ajaran`) VALUES
(1, 200000, 2020),
(2, 200000, 2021),
(3, 275000, 2022);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pembayaran_transaksi_siswa_view`
-- (See below for the actual view)
--
CREATE TABLE `pembayaran_transaksi_siswa_view` (
`alamat` varchar(255)
,`angkatan` int
,`bulan_dibayar` int
,`id_kelas` bigint
,`id_pembayaran` bigint
,`id_pengguna` bigint
,`id_petugas` bigint
,`id_siswa` bigint
,`nama` varchar(100)
,`nis` varchar(255)
,`nisn` varchar(255)
,`nominal` int
,`tahun_ajaran` int
,`tahun_dibayar` int
,`tanggal_bayar` date
,`telepon` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` bigint NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `role`) VALUES
(25, 'admin', 'admin', 1),
(26, '28875', '12345678', 3),
(28, '34200', '12345678', 3),
(29, '<h4 class=\"text-danger\">Hello World</h4>', '12345', 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna_petugas_view`
-- (See below for the actual view)
--
CREATE TABLE `pengguna_petugas_view` (
`id_pengguna` bigint
,`id_petugas` bigint
,`nama_petugas` varchar(100)
,`password` varchar(255)
,`username` varchar(70)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pengguna_siswa_view`
-- (See below for the actual view)
--
CREATE TABLE `pengguna_siswa_view` (
`alamat` varchar(255)
,`id_kelas` bigint
,`id_pembayaran` bigint
,`id_pengguna` bigint
,`id_siswa` bigint
,`nama` varchar(100)
,`nis` varchar(255)
,`nisn` varchar(255)
,`password` varchar(255)
,`telepon` varchar(15)
,`username` varchar(70)
);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` bigint NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `id_pengguna` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `id_pengguna`) VALUES
(13, 'Administrator Sistem', 25),
(14, 'konen', 29);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nisn` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `angkatan` int NOT NULL,
  `id_pengguna` bigint NOT NULL,
  `id_kelas` bigint NOT NULL,
  `id_pembayaran` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nisn`, `nama`, `alamat`, `telepon`, `angkatan`, `id_pengguna`, `id_kelas`, `id_pembayaran`) VALUES
(6, '28875', '192381389213', 'Addy Konen', 'Jalan Padang Padang', '0895342572499', 2020, 26, 1, 3),
(7, '34200', '1929232232121', 'I Putu Made', 'Jalan Ubung 22', '0877332211', 2021, 28, 11, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `siswa_kelas_view`
-- (See below for the actual view)
--
CREATE TABLE `siswa_kelas_view` (
`alamat` varchar(255)
,`angkatan` int
,`id_kelas` bigint
,`id_pengguna` bigint
,`id_siswa` bigint
,`kompetensi_keahlian` varchar(100)
,`nama` varchar(100)
,`nama_kelas` varchar(30)
,`nis` varchar(255)
,`nisn` varchar(255)
,`telepon` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bulan_dibayar` int NOT NULL,
  `tahun_dibayar` int NOT NULL,
  `id_petugas` bigint NOT NULL,
  `id_siswa` bigint NOT NULL,
  `id_pembayaran` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_petugas`, `id_siswa`, `id_pembayaran`) VALUES
(8, '2023-02-23', 1, 2020, 13, 6, 1),
(9, '2023-02-23', 2, 2020, 13, 6, 1),
(10, '2023-02-23', 3, 2020, 13, 6, 1),
(11, '2023-02-23', 4, 2020, 13, 6, 1),
(12, '2023-02-23', 5, 2020, 13, 6, 1),
(13, '2023-02-23', 6, 2020, 13, 6, 1),
(14, '2023-02-23', 7, 2020, 13, 6, 1),
(15, '2023-02-23', 8, 2020, 13, 6, 1),
(16, '2023-02-23', 9, 2020, 13, 6, 1),
(17, '2023-02-23', 10, 2020, 13, 6, 1),
(25, '2023-02-23', 1, 2021, 13, 7, 2),
(26, '2023-02-23', 11, 2020, 13, 6, 1),
(27, '2023-02-23', 12, 2020, 13, 6, 1),
(28, '2023-02-23', 1, 2021, 13, 6, 2),
(29, '2023-02-23', 2, 2021, 13, 6, 2),
(30, '2023-02-23', 4, 2021, 13, 6, 2),
(31, '2023-02-23', 3, 2021, 13, 6, 2),
(32, '2023-02-23', 5, 2021, 13, 6, 2),
(33, '2023-02-23', 6, 2021, 13, 6, 2),
(34, '2023-02-23', 7, 2021, 13, 6, 2),
(35, '2023-02-23', 8, 2021, 13, 6, 2),
(36, '2023-02-23', 9, 2021, 13, 6, 2),
(37, '2023-02-23', 10, 2021, 13, 6, 2),
(38, '2023-02-23', 11, 2021, 13, 6, 2),
(39, '2023-02-23', 12, 2021, 13, 6, 2),
(40, '2023-02-23', 1, 2022, 13, 6, 3),
(41, '2023-02-23', 2, 2022, 13, 6, 3),
(42, '2023-02-23', 3, 2021, 13, 7, 2),
(43, '2023-02-23', 4, 2021, 13, 7, 2),
(44, '2023-02-23', 3, 2022, 13, 6, 3);

-- --------------------------------------------------------

--
-- Structure for view `pembayaran_transaksi_siswa_view`
--
DROP TABLE IF EXISTS `pembayaran_transaksi_siswa_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pembayaran_transaksi_siswa_view`  AS SELECT `siswa`.`id_siswa` AS `id_siswa`, `siswa`.`angkatan` AS `angkatan`, `siswa`.`nis` AS `nis`, `siswa`.`nisn` AS `nisn`, `siswa`.`nama` AS `nama`, `siswa`.`alamat` AS `alamat`, `siswa`.`telepon` AS `telepon`, `siswa`.`id_pengguna` AS `id_pengguna`, `siswa`.`id_kelas` AS `id_kelas`, `transaksi`.`bulan_dibayar` AS `bulan_dibayar`, `transaksi`.`tahun_dibayar` AS `tahun_dibayar`, `transaksi`.`tanggal_bayar` AS `tanggal_bayar`, `transaksi`.`id_petugas` AS `id_petugas`, `pembayaran`.`id_pembayaran` AS `id_pembayaran`, `pembayaran`.`nominal` AS `nominal`, `pembayaran`.`tahun_ajaran` AS `tahun_ajaran` FROM ((`pembayaran` join `transaksi` on((`transaksi`.`id_pembayaran` = `pembayaran`.`id_pembayaran`))) join `siswa` on((`transaksi`.`id_siswa` = `siswa`.`id_siswa`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `pengguna_petugas_view`
--
DROP TABLE IF EXISTS `pengguna_petugas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna_petugas_view`  AS SELECT `pengguna`.`username` AS `username`, `pengguna`.`password` AS `password`, `petugas`.`id_petugas` AS `id_petugas`, `petugas`.`nama_petugas` AS `nama_petugas`, `petugas`.`id_pengguna` AS `id_pengguna` FROM (`pengguna` join `petugas` on((`pengguna`.`id_pengguna` = `petugas`.`id_pengguna`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `pengguna_siswa_view`
--
DROP TABLE IF EXISTS `pengguna_siswa_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pengguna_siswa_view`  AS SELECT `pengguna`.`username` AS `username`, `pengguna`.`password` AS `password`, `siswa`.`id_siswa` AS `id_siswa`, `siswa`.`nis` AS `nis`, `siswa`.`nisn` AS `nisn`, `siswa`.`nama` AS `nama`, `siswa`.`id_kelas` AS `id_kelas`, `siswa`.`id_pembayaran` AS `id_pembayaran`, `siswa`.`alamat` AS `alamat`, `siswa`.`telepon` AS `telepon`, `siswa`.`id_pengguna` AS `id_pengguna` FROM (`pengguna` join `siswa` on((`pengguna`.`id_pengguna` = `siswa`.`id_pengguna`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `siswa_kelas_view`
--
DROP TABLE IF EXISTS `siswa_kelas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `siswa_kelas_view`  AS SELECT `siswa`.`id_siswa` AS `id_siswa`, `siswa`.`angkatan` AS `angkatan`, `siswa`.`nis` AS `nis`, `siswa`.`nisn` AS `nisn`, `siswa`.`nama` AS `nama`, `siswa`.`alamat` AS `alamat`, `siswa`.`telepon` AS `telepon`, `siswa`.`id_pengguna` AS `id_pengguna`, `siswa`.`id_kelas` AS `id_kelas`, `kelas`.`nama_kelas` AS `nama_kelas`, `kelas`.`kompetensi_keahlian` AS `kompetensi_keahlian` FROM (`siswa` join `kelas` on((`siswa`.`id_kelas` = `kelas`.`id_kelas`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `tahun_ajaran` (`tahun_ajaran`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nis` (`nis`,`nisn`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `siswa_ibfk_5` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
