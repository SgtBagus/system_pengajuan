-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Mei 2017 pada 14.58
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system_pengajuan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` varchar(5) NOT NULL,
  `catatan` text NOT NULL,
  `update_catatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`id_catatan`, `catatan`, `update_catatan`) VALUES
('C1', 'Tanggal 14 Mei besok sampai 16 Mei besok pengajuan mungkin tidak akan di lihat oleh pihat manajemen ', '2017-05-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_pengajuan`
--

CREATE TABLE `jenis_pengajuan` (
  `id_jenis_pengajuan` int(11) NOT NULL,
  `jenis_pengajuan` varchar(25) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_pengajuan`
--

INSERT INTO `jenis_pengajuan` (`id_jenis_pengajuan`, `jenis_pengajuan`, `deskripsi`) VALUES
(1, 'Barang', 'Jenis Pengajuan, berupa jenis barang yang akan di ajukan'),
(3, 'Training', 'untuk pengajuan pelatihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `pengajuan` varchar(225) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_jenis_pengajuan` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `biaya` int(225) NOT NULL,
  `alasan` text NOT NULL,
  `keterangan` text NOT NULL,
  `jadwal_pelaksanaan` date NOT NULL,
  `catatan` text NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL,
  `update_pengajuan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `pengajuan`, `id_user`, `id_jenis_pengajuan`, `tanggal_pengajuan`, `gambar`, `biaya`, `alasan`, `keterangan`, `jadwal_pelaksanaan`, `catatan`, `status`, `update_pengajuan`) VALUES
(4, 'Pengajuan Termial Listrik', 14, 1, '2017-05-08', '', 150000, 'Kita sepertinya kekurangan terminal listrik', '-', '2017-05-22', 'jadwal saya undur', 'proses', '2017-05-19'),
(5, 'Pengajuan meja', 14, 1, '2017-05-09', '', 50000, 'Kita kekuangan meja', '- ', '0000-00-00', 'kita udah kebanyakan meja', 'selesai', '2017-05-09'),
(6, 'Pengajuan MAC', 15, 1, '2017-05-09', '', 5000, 'kita kekurangan mac untuk kantor', '-', '2017-05-12', 'Pengajuan ini saya terima', 'selesai', '2017-05-19'),
(7, 'Tes', 14, 1, '2017-05-10', '100520171007096357286795706858631912471428_1-krabby-patty.png', 10000, '-', '-', '0000-00-00', 'tes', 'selesai', '2017-05-10'),
(8, 'tes ubah', 14, 1, '2017-05-12', '120520171307131219800149560579432soldier aiming.svg.hi.png', 15000, 'tes2', '-', '0000-00-00', 'pengajuan ini terlalu baik buat ku ', 'selesai', '2017-05-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `kegiatan` varchar(225) NOT NULL,
  `kegiatan2` varchar(225) NOT NULL,
  `kegiatan3` varchar(225) NOT NULL,
  `catatan` text NOT NULL,
  `jenis_riwayat` varchar(225) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `notifikasi` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `kegiatan`, `kegiatan2`, `kegiatan3`, `catatan`, `jenis_riwayat`, `id_pengajuan`, `tanggal_kegiatan`, `notifikasi`) VALUES
(4, 'Telah Melakukan Menerima Pengajuan', 'Pengajuan diterima', 'Pengajuan Anda Telah DiTerima Oleh Pihak Manajemen', 'tes', 'Penerimaan', 4, '2017-05-08', '0'),
(6, 'Telah Melakukan Penolakan Pengajuan', 'Pengajuan Ditolak', 'Pengajuan Anda Telah DiTolak Oleh Pihak Manajemen', 'kita udah kebanyakan meja', 'Penolakan', 5, '2017-05-09', '1'),
(7, 'Telah Melakukan Penolakan Pengajuan', 'Pengajuan Ditolak', 'Pengajuan Anda Telah DiTolak Oleh Pihak Manajemen', 'tes', 'Penolakan', 7, '2017-05-10', '1'),
(8, 'Telah Melakukan Menerima Pengajuan', 'Pengajuan diterima', 'Pengajuan Anda Telah DiTerima Oleh Pihak Manajemen', 'Pengajuan ini saya terima\r\n', 'Penerimaan', 6, '2017-05-11', '0'),
(10, 'Telah Melakukan Penolakan Pengajuan', 'Pengajuan Ditolak', 'Pengajuan Anda Telah DiTolak Oleh Pihak Manajemen', 'pengajuan ini terlalu baik buat ku', 'Penolakan', 8, '2017-05-16', '0'),
(15, 'Telah Melakukan Perubahan Pengajuan', 'Pengajuan Diubah', 'Pengajuan Anda Telah Diubah Oleh Pihak Manajemen', 'jadwal saya undur', 'Pengubahan', 4, '2017-05-19', '1'),
(16, 'Telah Melakukan Menyelesaian Pengajuan', 'Pengajuan Diselesaikan', 'Pengajuan Anda Telah Diselesaikan Oleh Pihak Manajemen', '', 'Penyelesaian', 6, '2017-05-19', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_depan` varchar(225) NOT NULL,
  `nama_belakang` varchar(225) NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('manajemen','tim') NOT NULL,
  `pembuatan_akun` date NOT NULL,
  `update_akun` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `nama_depan`, `nama_belakang`, `jk`, `no_hp`, `alamat`, `role`, `pembuatan_akun`, `update_akun`) VALUES
(13, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'manajemen', 'laki-laki', '45809767', 'Rumah admin', 'manajemen', '2017-04-27', '2017-05-16'),
(14, 'user57', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'tim', 'laki-laki', '346572931', 'rumah tim', 'tim', '2017-04-27', '2017-05-16'),
(15, 'bagus', 'bagus@gmail.com', '17b38fc02fd7e92f3edeb6318e3066d8', 'bagus', 'andhika', 'laki-laki', '63743829', 'Perumahan bumi asri j-15', 'tim', '2017-05-09', '2017-05-09'),
(16, 'andhika', 'andhikab57@yahoo.com', '6ef95621c960af17372d1145d69af6c8', 'andhika', 'andhika', 'laki-laki', '12398039810293123', 'andhika', 'manajemen', '2017-05-14', '2017-05-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indexes for table `jenis_pengajuan`
--
ALTER TABLE `jenis_pengajuan`
  ADD PRIMARY KEY (`id_jenis_pengajuan`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pengajuan`
--
ALTER TABLE `jenis_pengajuan`
  MODIFY `id_jenis_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
