-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Apr 2017 pada 11.55
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
('C1', 'asd', '2017-04-07');

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
(1, 'Barang', 'Jenis Pengajuan, berupa jenis barang yang akan di ajukan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `pengajuan` varchar(225) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_pengajuan` varchar(225) NOT NULL,
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

INSERT INTO `pengajuan` (`id_pengajuan`, `pengajuan`, `id_user`, `jenis_pengajuan`, `tanggal_pengajuan`, `gambar`, `biaya`, `alasan`, `keterangan`, `jadwal_pelaksanaan`, `catatan`, `status`, `update_pengajuan`) VALUES
(1, 'Pengajuan Pembelian Terminal Listrik', 6, 'barang', '2017-03-31', 'tes.png', 50000, 'Saya mengajukan ini, karena saya merasa disini kita kekurangan terminal listrik sebanyak 2 dengan 5 stopkontak/terminal', '', '2017-04-07', 'tes', 'proses', '2017-04-06'),
(4, 'Pengajuan Meja', 6, 'barang', '2017-04-05', '', 300000, 'Kita sepertinya kekurangan meja buat kerja', '', '0000-00-00', '', 'menunggu', '2017-04-05'),
(5, 'Pengajuan Kursi', 6, 'barang', '2017-04-06', 'kursi.jpg', 500000, 'Di belakang kita kekurangan Kursi', '', '0000-00-00', 'Kursi Udah banyak ', 'selesai', '2017-04-06'),
(10, 'halo tes', 6, 'Barang', '2017-04-12', '12042017113600247bb2c1dfe6d85ac68ce2f74b51eac8.jpg', 50000, 'tes ubah', 'tes ubah', '0000-00-00', '', 'menunggu', '2017-04-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `kegiatan` varchar(225) NOT NULL,
  `kegiatan2` varchar(225) NOT NULL,
  `kegiatan3` varchar(225) NOT NULL,
  `jenis_riwayat` varchar(225) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `notifikasi` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `kegiatan`, `kegiatan2`, `kegiatan3`, `jenis_riwayat`, `id_pengajuan`, `tanggal_kegiatan`, `notifikasi`) VALUES
(6, 'Telah Melakukan Menerima Pengajuan', 'Pengajuan diterima', 'Pengajuan Anda Telah DiTerima Oleh Pihak Manajemen', 'Penerimaan', 1, '2017-04-06', '1'),
(7, 'Telah Melakukan Menolak Pengajuan', 'Pengajuan Ditolak', 'Pengajuan Anda Telah DiTolak Oleh Pihak Manajemen', 'Penolakan', 5, '2017-04-06', '1'),
(9, 'Telah Melakukan Perubahan Pengajuan', 'Pengajuan Diubah', 'Pengajuan Anda Telah Diubah Oleh Pihak Manajemen', 'Pengubahan', 1, '2017-04-06', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `nama_depan` varchar(225) NOT NULL,
  `nama_belakang` varchar(225) NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('manajemen','tim') NOT NULL,
  `pembuatan_akun` datetime NOT NULL,
  `update_akun` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `nama_depan`, `nama_belakang`, `jk`, `no_hp`, `alamat`, `role`, `pembuatan_akun`, `update_akun`) VALUES
(4, 'bagus unik', 'bagus@gmail.com', '17b38fc02fd7e92f3edeb6318e3066d8', 'bagus', 'andhika', 'laki-laki', '086735463721323', 'Prum Bumi Asri J-15', 'manajemen', '2017-04-06 10:07:32', '2017-04-07 09:44:24'),
(6, 'bambang57', 'bambang57@gmail.com', 'a9711cbb2e3c2d5fc97a63e45bbe5076', 'bambang', 'susilo', 'laki-laki', '09738456327812', 'rumha dusun ringa no 56', 'tim', '2017-04-06 10:14:47', '2017-04-10 11:31:16');

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
  MODIFY `id_jenis_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
