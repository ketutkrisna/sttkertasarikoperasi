-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Okt 2020 pada 13.45
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id9662932_kertasari`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `foto_anggota` varchar(100) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `tlp_anggota` varchar(20) NOT NULL,
  `kelamin_anggota` varchar(50) NOT NULL,
  `jabatan_anggota` varchar(50) NOT NULL,
  `status_anggota` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `foto_anggota`, `nama_anggota`, `tlp_anggota`, `kelamin_anggota`, `jabatan_anggota`, `status_anggota`) VALUES
(23, '5cdc2a49633d2.jpg', 'ketut febri', '', 'laki-laki', 'anggota', 'non aktif'),
(24, '5cdc2b73c0706.jpg', 'wayan eka aditya', '0821', 'laki-laki', 'anggota', 'aktif'),
(25, '5cdf05e2c7abf.jpg', 'wayan rida', '', 'laki-laki', 'anggota', 'non aktif'),
(26, '5cdf0612985aa.gif', 'wayan karte', '081232323', 'laki-laki', 'anggota', 'aktif'),
(27, 'default.jpg', 'kadek gobeh', '', 'laki-laki', 'anggota', 'non aktif'),
(28, '5cdef428a649b.jpg', 'komang', '', 'laki-laki', 'anggota', 'aktif'),
(29, '5cdff5ab94cba.gif', 'wayan tole', '', 'laki-laki', 'anggota', 'aktif'),
(31, 'default.jpg', 'luh laras', '', 'perempuan', 'anggota', 'non aktif'),
(30, '5d8f3d5b7a90a.png', 'wayan handika yana', '', 'laki-laki', 'ketua', 'aktif'),
(32, 'default.jpg', 'putu santri', '', 'perempuan', 'anggota', 'non aktif'),
(33, 'default.jpg', 'komang oka prayogi', '', 'laki-laki', 'anggota', 'non aktif'),
(34, 'default.jpg', 'gede ratep', '', 'laki-laki', 'anggota', 'menikah'),
(35, 'default.jpg', 'ketut yasi', '', 'perempuan', 'anggota', 'menikah'),
(36, 'default.jpg', 'wayan widastre', '', 'laki-laki', 'humas', 'aktif'),
(37, 'default.jpg', 'wayan hardiante', '', 'laki-laki', 'anggota', 'non aktif'),
(38, 'default.jpg', 'wayan sadawi', '', 'laki-laki', 'anggota', 'non aktif'),
(39, 'default.jpg', 'wayan okta', '', 'laki-laki', 'anggota', 'non aktif'),
(40, 'default.jpg', 'ketut krisna sanjaya', '', 'laki-laki', 'humas', 'aktif'),
(41, 'default.jpg', 'wayan lestari', '', 'perempuan', 'anggota', 'non aktif'),
(42, 'default.jpg', 'wayan nopi', '', 'perempuan', 'anggota', 'menikah'),
(43, 'default.jpg', 'komang evan', '', 'laki-laki', 'anggota', 'non aktif'),
(44, 'default.jpg', 'kadek yama', '', 'laki-laki', 'anggota', 'non aktif'),
(45, 'default.jpg', 'wayan krisma', '', 'laki-laki', 'anggota', 'non aktif'),
(46, 'default.jpg', 'komang adi', '', 'laki-laki', 'anggota', 'non aktif'),
(47, 'default.jpg', 'ketut aditya', '', 'laki-laki', 'anggota', 'aktif'),
(48, 'default.jpg', 'wayan suel', '', 'laki-laki', 'anggota', 'aktif'),
(49, 'default.jpg', 'luh ratna', '', 'perempuan', 'anggota', 'non aktif'),
(50, 'default.jpg', 'rani maulina', '', 'perempuan', 'anggota', 'non aktif'),
(51, 'default.jpg', 'kadek yogi', '', 'laki-laki', 'anggota', 'aktif'),
(52, 'default.jpg', 'komang andi', '', 'laki-laki', 'anggota', 'aktif'),
(53, 'default.jpg', 'kadek dwija', '', 'perempuan', 'anggota', 'non aktif'),
(54, 'default.jpg', 'wayan mudi', '', 'laki-laki', 'anggota', 'aktif'),
(55, 'default.jpg', 'kadek sar', '', 'laki-laki', 'anggota', 'aktif'),
(56, 'default.jpg', 'kadek murdane', '', 'laki-laki', 'anggota', 'aktif'),
(57, 'default.jpg', 'kadek katak', '', 'laki-laki', 'anggota', 'drop out'),
(58, 'default.jpg', 'komang oki', '', 'perempuan', 'anggota', 'menikah'),
(59, 'default.jpg', 'kadek mitrayana', '', 'laki-laki', 'anggota', 'aktif'),
(60, 'default.jpg', 'ketut leni', '', 'perempuan', 'anggota', 'non aktif'),
(61, '5ceb9f0565676.jpg', 'kadek fff', '085287852147', 'laki-laki', 'anggota', 'aktif'),
(62, 'default.jpg', 'kadek kuduk', '', 'laki-laki', 'anggota', 'aktif'),
(63, 'default.jpg', 'wayan tari', '', 'perempuan', 'anggota', 'aktif'),
(64, 'default.jpg', 'komang ardike', '', 'laki-laki', 'anggota', 'aktif'),
(65, 'default.jpg', 'ketut ranti', '', 'perempuan', 'anggota', 'aktif'),
(66, 'default.jpg', 'ketut karteyase', '', 'laki-laki', 'bendahara', 'aktif'),
(67, 'default.jpg', 'wayan andiane', '', 'laki-laki', 'anggota', 'menikah'),
(68, 'default.jpg', 'komang sentol', '', 'laki-laki', 'anggota', 'menikah'),
(69, 'default.jpg', 'wayan robi', '', 'laki-laki', 'anggota', 'non aktif'),
(78, 'default.jpg', 'made lugre', '', 'laki-laki', 'anggota', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayardenda`
--

CREATE TABLE `bayardenda` (
  `id_bayardenda` int(11) NOT NULL,
  `id_denda` int(100) NOT NULL,
  `tanggal_bayardenda` date NOT NULL,
  `jumlah_bayardenda` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bayardenda`
--

INSERT INTO `bayardenda` (`id_bayardenda`, `id_denda`, `tanggal_bayardenda`, `jumlah_bayardenda`) VALUES
(4, 8, '2019-08-16', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bungapinjaman`
--

CREATE TABLE `bungapinjaman` (
  `id_bunga` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tanggal_bunga` date NOT NULL,
  `jumlah_bunga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `bungapinjaman`
--

INSERT INTO `bungapinjaman` (`id_bunga`, `id_pinjaman`, `tanggal_bunga`, `jumlah_bunga`) VALUES
(1, 6, '2019-09-07', 10000),
(2, 9, '2019-09-08', 5000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftarisiuud`
--

CREATE TABLE `daftarisiuud` (
  `id_isi` int(11) NOT NULL,
  `id_uud` int(11) NOT NULL,
  `isi` longtext COLLATE utf8_unicode_ci NOT NULL,
  `update_isi` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `daftarisiuud`
--

INSERT INTO `daftarisiuud` (`id_isi`, `id_uud`, `isi`, `update_isi`) VALUES
(1, 1, 'Pembahasan tentang revisi UU Perkawinan oleh pemerintah hanya berfokus pada Pasal 7 Ayat (1) yang menyebutkan perkawinan hanya diizinkan bila pria sudah berumur 5 tahun dan wanita', '1569388247'),
(2, 1, 'Artikel adalah karangan faktual secara lengkap dengan panjang tertentu yang dibuat untuk dipublikasikan di media online maupun cetak (melalui koran, majalah, buletin, dsb) dan bertujuan menyampaikan gagasan dan fakta yang dapat meyakinkan, mendidik, dan menghibur. Anjing', '1569649731'),
(3, 1, 'Narasi adalah salah satu jenis pengembangan paragraf dalam sebuah tulisan yang rangkaian peristiwa dari waktu ke waktu dijabarkan dengan urutan awal, tengah, dan akhir.', '1570360192'),
(7, 2, 'Ok percobaan pertama', '1571221795');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftaruud`
--

CREATE TABLE `daftaruud` (
  `id_uud` int(11) NOT NULL,
  `nama_uud` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_uud` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `daftaruud`
--

INSERT INTO `daftaruud` (`id_uud`, `nama_uud`, `tgl_uud`) VALUES
(1, 'RULES NON AKTIF', '1569175543'),
(2, 'COBALAH', '1569195367');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_anggota` int(100) NOT NULL,
  `keterangan_denda` varchar(100) NOT NULL,
  `tanggal_denda` date NOT NULL,
  `jumlah_denda` int(100) NOT NULL,
  `status_denda` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `denda`
--

INSERT INTO `denda` (`id_denda`, `id_anggota`, `keterangan_denda`, `tanggal_denda`, `jumlah_denda`, `status_denda`) VALUES
(8, 61, 'absen', '2019-08-15', 10000, 'lunas'),
(10, 30, 'Absen', '2019-08-19', 10000, 'belum bayar'),
(11, 78, 'Absen', '2019-09-07', 10000, 'belum bayar'),
(12, 51, 'absen', '2020-01-19', 5000, 'belum bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `keterangan_pemasukan` varchar(100) NOT NULL,
  `tanggal_pemasukan` date NOT NULL,
  `jumlah_pemasukan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `keterangan_pemasukan`, `tanggal_pemasukan`, `jumlah_pemasukan`) VALUES
(6, 'pkasdasdasd adIuran wajib anjay lah taik anjing babi asu monyet sampe bisa scroll pk', '2019-05-27', '300000'),
(10, 'masukan', '2019-09-10', '150000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pinjaman` int(100) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_pembayaran` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pinjaman`, `tanggal_pembayaran`, `jumlah_pembayaran`) VALUES
(16, 6, '2019-09-08', 200000),
(12, 5, '2019-05-27', 100000),
(11, 5, '2019-05-26', 100000),
(14, 5, '2019-05-27', 100000),
(17, 10, '2019-09-08', 100000),
(18, 10, '2019-10-15', 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `keterangan_pengeluaran` varchar(100) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jumlah_pengeluaran` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `keterangan_pengeluaran`, `tanggal_pengeluaran`, `jumlah_pengeluaran`) VALUES
(4, 'cari bambu', '2019-08-16', '20000'),
(5, 'gorengan', '2019-08-16', '15000'),
(6, 'Sumbang dana untuk anjing dan kucing kepanasaan', '2019-08-17', '1000000'),
(8, 'Lomba PUBG', '2019-08-18', '100000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id_pinjaman` int(11) NOT NULL,
  `id_anggota` int(100) NOT NULL,
  `tanggal_pinjaman` date NOT NULL,
  `jumlah_pinjaman` varchar(100) NOT NULL,
  `status_pinjaman` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id_pinjaman`, `id_anggota`, `tanggal_pinjaman`, `jumlah_pinjaman`, `status_pinjaman`) VALUES
(6, 61, '2019-05-27', '500000', 'belum lunas'),
(5, 66, '2019-05-21', '300000', 'lunas'),
(7, 23, '2019-08-16', '300000', 'belum lunas'),
(9, 78, '2019-09-07', '200000', 'belum lunas'),
(10, 78, '2019-09-08', '500000', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `jumlah_saldo` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `jumlah_saldo`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumbangan`
--

CREATE TABLE `sumbangan` (
  `id_sumbangan` int(11) NOT NULL,
  `nama_sumbangan` varchar(100) NOT NULL,
  `tanggal_sumbangan` date NOT NULL,
  `jumlah_sumbangan` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sumbangan`
--

INSERT INTO `sumbangan` (`id_sumbangan`, `nama_sumbangan`, `tanggal_sumbangan`, `jumlah_sumbangan`) VALUES
(3, 'lurah', '2019-05-20', 2000000),
(5, 'Pak dewan', '2019-08-19', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'anggota', 'anggota', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `bayardenda`
--
ALTER TABLE `bayardenda`
  ADD PRIMARY KEY (`id_bayardenda`);

--
-- Indeks untuk tabel `bungapinjaman`
--
ALTER TABLE `bungapinjaman`
  ADD PRIMARY KEY (`id_bunga`);

--
-- Indeks untuk tabel `daftarisiuud`
--
ALTER TABLE `daftarisiuud`
  ADD PRIMARY KEY (`id_isi`);

--
-- Indeks untuk tabel `daftaruud`
--
ALTER TABLE `daftaruud`
  ADD PRIMARY KEY (`id_uud`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `sumbangan`
--
ALTER TABLE `sumbangan`
  ADD PRIMARY KEY (`id_sumbangan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `bayardenda`
--
ALTER TABLE `bayardenda`
  MODIFY `id_bayardenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bungapinjaman`
--
ALTER TABLE `bungapinjaman`
  MODIFY `id_bunga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `daftarisiuud`
--
ALTER TABLE `daftarisiuud`
  MODIFY `id_isi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `daftaruud`
--
ALTER TABLE `daftaruud`
  MODIFY `id_uud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id_pinjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sumbangan`
--
ALTER TABLE `sumbangan`
  MODIFY `id_sumbangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
