-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2020 at 04:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `si_cucian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_paket`
--

CREATE TABLE IF NOT EXISTS `tb_paket` (
`id_paket` int(10) NOT NULL,
  `paket` varchar(100) NOT NULL,
  `biaya` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `paket`, `biaya`) VALUES
(1, 'Cuci Mobil', 30000),
(2, 'Salon Mobil', 40000),
(4, 'Cuci Mobil Besar', 50000),
(5, 'Salon Mobil Besar', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tb_pelanggan` (
  `kode_pelanggan` char(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `tipe_mobil` varchar(50) NOT NULL,
  `nopol` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kode_pelanggan`, `nama`, `alamat`, `telepon`, `tipe_mobil`, `nopol`, `created_at`) VALUES
('PLG-0001', 'Ricky Syahputra', 'Pandau garis keras', '085336014459', 'BMW', 'BM 7557 NI', '2020-08-18 14:23:48'),
('PLG-0002', 'Doni', 'Pandau jaya', '081234314314', 'Avanza', 'BM 2782 NB', '2020-08-18 14:23:48'),
('PLG-0003', 'Jimmy', 'Taluk', '09213785531', 'Xenia', 'BM 7287 HJ', '2020-08-18 14:23:48'),
('PLG-0004', 'Ripan', 'Tasik serai', '082312123254', 'BMW', 'BM 7287 HJ', '2020-08-18 14:23:48'),
('PLG-0005', 'Tama', 'Duri', '082312858375', 'Xenia', 'BM 2782 NB', '2020-08-18 14:23:48'),
('PLG-0006', 'Peb', 'Perawang', '082312858375', 'Xenia', 'BM 7287 HJ', '2020-08-18 14:23:48'),
('PLG-0007', 'Naldi', 'Kos', '081234314312', 'Fortuner', 'BM 7287 HJ', '2020-08-18 14:50:37'),
('PLG-0008', 'Ucok', 'Gading', '087654224262', 'Pajero', 'BM 7287 HJ', '2020-08-18 14:23:48'),
('PLG-0009', 'aan', 'hgjgjh', '0988667', 'L300', 'BM 7287 HJ', '2020-08-18 14:23:48'),
('PLG-0010', 'Doni123', 'Gading', '087654326352', 'Alphard', 'BM 7287 HJ', '2020-08-18 14:23:48'),
('PLG-0011', 'ssnmns', 'nmmnsms', '2892829', 'Innova', 'BM 7287 HJ', '2020-08-18 14:35:52'),
('PLG-0012', 'Iqbal', 'Jl. Sukajadi', '0829829289', 'Sedan', 'BM 123 NI', '2020-08-18 15:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi` (
`id_transaksi` int(10) NOT NULL,
  `kode_pelanggan` char(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipe_mobil` varchar(50) NOT NULL,
  `nopol` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `kode_pelanggan`, `id_user`, `tipe_mobil`, `nopol`, `tanggal`, `created_at`) VALUES
(1, 'PLG-0002', 1, 'Avanza', 'BM 2782 NB', '2020-08-20', '2020-08-20 09:21:56'),
(3, 'PLG-0012', 1, 'Sedan', 'BM 123 NI', '2020-08-20', '2020-08-20 16:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi_detail`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_detail` (
`id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi_detail`
--

INSERT INTO `tb_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_paket`, `bayar`, `kembali`, `created_at`) VALUES
(1, 1, 1, 100000, 30000, '2020-08-20 09:28:27'),
(2, 1, 2, 100000, 30000, '2020-08-20 09:28:27'),
(4, 3, 4, 100000, 50000, '2020-08-20 16:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('Administrator','Kasir') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama_user`, `password`, `level`, `status`) VALUES
(1, 'ricky', 'Ricky', '$2y$10$agLpqjDcNd90RXLFFgVZcu0uYlMYTEc5uxc916dXVEExBwq2m85ye', 'Administrator', 'Aktif'),
(3, 'jimmy', 'Jimmy', '$2y$10$6CN3NXpTdE7KdqjlyDGClO.gEefPd8ws80WbjdzwR2B7HRvlF4DqW', 'Kasir', 'Aktif'),
(4, 'Ayu', 'Dwi Ayu Febrinasari', '$2y$10$FQYBJPuMLlKGe6PtdNyjmuQPthv0PrNWA4wHl8YTOOXcOJJw4Rnty', 'Kasir', 'Aktif');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi`
--
CREATE TABLE IF NOT EXISTS `view_transaksi` (
`id_transaksi` int(10)
,`kode_pelanggan` char(10)
,`nama_pelanggan` varchar(100)
,`id_user` int(11)
,`tipe_mobil` varchar(50)
,`nopol` varchar(50)
,`nama_user` varchar(100)
,`tanggal` date
,`created_at` timestamp
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi_detail`
--
CREATE TABLE IF NOT EXISTS `view_transaksi_detail` (
`id_transaksi_detail` int(11)
,`id_transaksi` int(10)
,`id_paket` int(10)
,`nama_paket` varchar(100)
,`harga_paket` int(10)
,`bayar` int(11)
,`kembali` int(11)
,`created_at` timestamp
);
-- --------------------------------------------------------

--
-- Structure for view `view_transaksi`
--
DROP TABLE IF EXISTS `view_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi` AS select `a1`.`id_transaksi` AS `id_transaksi`,`a2`.`kode_pelanggan` AS `kode_pelanggan`,`a2`.`nama` AS `nama_pelanggan`,`a3`.`id_user` AS `id_user`,`a1`.`tipe_mobil` AS `tipe_mobil`,`a1`.`nopol` AS `nopol`,`a3`.`nama_user` AS `nama_user`,`a1`.`tanggal` AS `tanggal`,`a1`.`created_at` AS `created_at` from ((`tb_transaksi` `a1` join `tb_pelanggan` `a2` on((`a1`.`kode_pelanggan` = `a2`.`kode_pelanggan`))) join `tb_user` `a3` on((`a1`.`id_user` = `a3`.`id_user`)));

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi_detail`
--
DROP TABLE IF EXISTS `view_transaksi_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi_detail` AS select `a1`.`id_transaksi_detail` AS `id_transaksi_detail`,`a2`.`id_transaksi` AS `id_transaksi`,`a3`.`id_paket` AS `id_paket`,`a3`.`paket` AS `nama_paket`,`a3`.`biaya` AS `harga_paket`,`a1`.`bayar` AS `bayar`,`a1`.`kembali` AS `kembali`,`a1`.`created_at` AS `created_at` from ((`tb_transaksi_detail` `a1` join `tb_transaksi` `a2` on((`a1`.`id_transaksi` = `a2`.`id_transaksi`))) join `tb_paket` `a3` on((`a1`.`id_paket` = `a3`.`id_paket`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_paket`
--
ALTER TABLE `tb_paket`
 ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
 ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
 ADD PRIMARY KEY (`id_transaksi`), ADD KEY `kode_pelanggan` (`kode_pelanggan`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
 ADD PRIMARY KEY (`id_transaksi_detail`), ADD KEY `id_transaksi` (`id_transaksi`,`id_paket`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_paket`
--
ALTER TABLE `tb_paket`
MODIFY `id_paket` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_transaksi_detail`
--
ALTER TABLE `tb_transaksi_detail`
MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
