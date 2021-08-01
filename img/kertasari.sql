-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 02:40 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kertasari`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `foto_anggota` varchar(100) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `tlp_anggota` varchar(20) NOT NULL,
  `kelamin_anggota` varchar(50) NOT NULL,
  `jabatan_anggota` varchar(50) NOT NULL,
  `status_anggota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `foto_anggota`, `nama_anggota`, `tlp_anggota`, `kelamin_anggota`, `jabatan_anggota`, `status_anggota`) VALUES
(23, '5cdc2a49633d2.jpg', 'valak', '08213234251', 'perempuan', 'anggota', 'aktif'),
(24, '5cdc2b73c0706.jpg', 'the nun', '08212232', 'perempuan', 'wakil', 'aktif'),
(25, '5cdf05e2c7abf.jpg', 'iron mans', '08123213', 'laki-laki', 'anggota', 'aktif'),
(26, '5cdf0612985aa.gif', 'thor', '081232323', 'laki-laki', 'humas', 'aktif'),
(27, 'default.jpg', 'hulkaads', '0812312323', 'laki-laki', 'anggota', 'non aktif'),
(28, '5cdef428a649b.jpg', 'black panteran', '0812312', 'perempuan', 'ketua', 'aktif'),
(29, '5cdff5ab94cba.gif', 'tom raider', '0891232321', 'perempuan', 'bendahara', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `bayardenda`
--

CREATE TABLE `bayardenda` (
  `id_bayardenda` int(11) NOT NULL,
  `id_denda` int(100) NOT NULL,
  `tanggal_bayardenda` date NOT NULL,
  `jumlah_bayardenda` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayardenda`
--

INSERT INTO `bayardenda` (`id_bayardenda`, `id_denda`, `tanggal_bayardenda`, `jumlah_bayardenda`) VALUES
(1, 1, '2019-05-17', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_anggota` int(100) NOT NULL,
  `keterangan_denda` varchar(100) NOT NULL,
  `tanggal_denda` date NOT NULL,
  `jumlah_denda` int(100) NOT NULL,
  `status_denda` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `id_anggota`, `keterangan_denda`, `tanggal_denda`, `jumlah_denda`, `status_denda`) VALUES
(1, 25, 'absen', '2019-05-17', 5000, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `keterangan_pemasukan` varchar(100) NOT NULL,
  `tanggal_pemasukan` date NOT NULL,
  `jumlah_pemasukan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `keterangan_pemasukan`, `tanggal_pemasukan`, `jumlah_pemasukan`) VALUES
(1, 'apa aja', '2019-05-17', '50000'),
(2, 'add', '2019-05-18', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pinjaman` int(100) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_pembayaran` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pinjaman`, `tanggal_pembayaran`, `jumlah_pembayaran`) VALUES
(2, 1, '2019-05-17', 200),
(3, 1, '2019-05-17', 800);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `keterangan_pengeluaran` varchar(100) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jumlah_pengeluaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `keterangan_pengeluaran`, `tanggal_pengeluaran`, `jumlah_pengeluaran`) VALUES
(1, 'basing', '2019-05-17', '20000'),
(2, 'auk', '2019-05-18', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_anggota` int(100) NOT NULL,
  `tanggal_pinjaman` date NOT NULL,
  `jumlah_pinjaman` varchar(100) NOT NULL,
  `status_pinjaman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_anggota`, `tanggal_pinjaman`, `jumlah_pinjaman`, `status_pinjaman`) VALUES
(1, 27, '2019-05-17', '1000', 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `jumlah_saldo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `jumlah_saldo`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sumbangan`
--

CREATE TABLE `sumbangan` (
  `id_sumbangan` int(11) NOT NULL,
  `nama_sumbangan` varchar(100) NOT NULL,
  `tanggal_sumbangan` date NOT NULL,
  `jumlah_sumbangan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sumbangan`
--

INSERT INTO `sumbangan` (`id_sumbangan`, `nama_sumbangan`, `tanggal_sumbangan`, `jumlah_sumbangan`) VALUES
(1, 'au', '2019-05-17', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'anggota', 'anggota', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `bayardenda`
--
ALTER TABLE `bayardenda`
  ADD PRIMARY KEY (`id_bayardenda`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `sumbangan`
--
ALTER TABLE `sumbangan`
  ADD PRIMARY KEY (`id_sumbangan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `bayardenda`
--
ALTER TABLE `bayardenda`
  MODIFY `id_bayardenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sumbangan`
--
ALTER TABLE `sumbangan`
  MODIFY `id_sumbangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
