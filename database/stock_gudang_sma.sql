-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2023 pada 06.30
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_gudang_sma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_akun`
--

CREATE TABLE `t_akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_akun`
--

INSERT INTO `t_akun` (`id_akun`, `username`, `password`, `level`) VALUES
(5, 'staff', '$2y$10$6aIOPTZYA/PiKhj7aO6OX.yvgBC5bKX29BsP7ehB0HWlIab7Jzzay', 'admin'),
(6, 'admin', '$2y$10$UDRNcMxV5beFHStgWeUsuuv5c8RZDmatPK1XudeHjocN4KWZ4b6qq', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_barang`
--

CREATE TABLE `t_barang` (
  `id` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_barang` varchar(200) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `inventory_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_barang`
--

INSERT INTO `t_barang` (`id`, `id_sumber`, `id_satuan`, `nama_barang`, `stok`, `harga`, `tgl_masuk`, `inventory_value`) VALUES
(19, 1, 7, 'Lembar Raport A4 80gr 1 Warna per rim', 0, 150000, '2022-09-30', 0),
(20, 1, 1, 'Setip Stadler', 4, 2500, '2022-09-30', 10000),
(21, 1, 1, 'Buku Sidu isi 58', 20, 5000, '2022-09-30', 100000),
(22, 1, 1, 'Lem stick Greebel 8gr', 0, 7700, '2022-09-30', 0),
(23, 1, 2, 'Clip ZRM no 3', 0, 2200, '2022-09-30', 0),
(24, 1, 1, 'Tisue Nice 250', 40, 17050, '2022-09-30', 682000),
(25, 1, 1, 'Sunlight refill', 0, 20000, '2022-09-30', 0),
(26, 1, 1, 'Tisue Nice Pop Kecil', 50, 9900, '2022-09-30', 495000),
(27, 1, 1, 'Refill Hand Soap 5 Liter', 3, 150000, '2022-09-30', 450000),
(28, 1, 1, 'Handsoap', 6, 25000, '2022-09-30', 150000),
(29, 1, 1, 'Refill Handsanitizer cair 5 liter', 8, 250000, '2022-09-30', 2000000),
(30, 1, 8, 'Lakban 2 Inch Merah', 0, 25300, '2022-09-30', 0),
(31, 1, 3, 'Tinta Printer EPSON RED', 6, 240000, '2022-09-30', 1440000),
(32, 1, 3, 'Tinta Printer EPSON Yellow', 2, 240000, '2022-09-30', 480000),
(33, 1, 3, 'Tinta Printer EPSON Blue', 5, 240000, '2022-09-30', 1200000),
(34, 1, 3, 'Toner Printer EPSON 664 Black', 7, 84000, '2022-09-30', 588000),
(35, 1, 3, 'Toner Printer EPSON 664 Color', 48, 86500, '2022-09-30', 4152000),
(36, 1, 1, 'Drawing Pen 0.1', 0, 20000, '2022-09-30', 0),
(37, 1, 1, 'Drawing Pen 0.2', 0, 20000, '2022-09-30', 0),
(38, 1, 1, 'Sikat Kamar mandi', 11, 40000, '2022-09-30', 440000),
(39, 1, 1, 'Sapu Lidi', 4, 15000, '2022-09-30', 60000),
(40, 1, 1, 'Pengki-serok sampah', 6, 20000, '2022-09-30', 120000),
(41, 1, 1, 'Sapu Lantai', 0, 25000, '2022-09-30', 0),
(42, 1, 1, 'Lampu LED Philips 20 w Outdoor', 0, 160000, '2022-09-30', 0),
(43, 1, 1, 'Lampu Philips Tornado T3 15w/CD/WW', 15, 45900, '2022-09-30', 688500),
(44, 1, 1, 'Lampu Philips Tornado T3 8W/CD/WW', 11, 41800, '2022-09-30', 459800),
(45, 1, 1, 'Lampu Philips Essential 18w/CD/WW', 0, 45808, '2022-09-30', 0),
(46, 2, 1, 'agenda Mengajar', 0, 27500, '2022-09-30', 0),
(47, 2, 1, 'Cetak Amplop Dinas Kecil', 0, 1500, '2022-09-30', 0),
(48, 2, 1, 'Isolasi kran', 7, 10000, '2022-09-30', 70000),
(49, 2, 1, 'Kain pel', 0, 20000, '2022-09-30', 0),
(50, 2, 1, 'Stop kontak T', 0, 25000, '2022-09-30', 0),
(51, 2, 2, 'Klem Kabel U.12', 0, 9000, '2022-09-30', 0),
(52, 2, 2, 'Bolpoint X-data Lorek', 0, 10000, '2022-09-30', 0),
(53, 2, 7, 'HVS F4', 0, 59000, '2022-09-30', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_masuk_barang`
--

CREATE TABLE `t_masuk_barang` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_masuk_barang`
--

INSERT INTO `t_masuk_barang` (`id_masuk`, `id_barang`, `tgl_masuk`, `jumlah`, `keterangan`) VALUES
(28, 19, '2022-09-30', 40, 'add'),
(29, 20, '2022-09-30', 10, 'add'),
(30, 21, '2022-09-30', 24, 'add'),
(31, 22, '2022-09-30', 10, 'add'),
(32, 23, '2022-09-30', 12, 'add'),
(33, 24, '2022-09-30', 98, 'add'),
(34, 25, '2022-09-30', 6, 'add'),
(35, 26, '2022-09-30', 64, 'add'),
(36, 27, '2022-09-30', 4, 'add'),
(37, 28, '2022-09-30', 12, 'add'),
(38, 29, '2022-09-30', 10, 'add'),
(39, 30, '2022-09-30', 6, 'add'),
(40, 31, '2022-09-30', 11, 'add'),
(41, 32, '2022-09-30', 10, 'add'),
(42, 33, '2022-09-30', 11, 'add'),
(43, 34, '2022-09-30', 7, 'add'),
(44, 35, '2022-09-30', 48, 'add'),
(45, 36, '2022-09-30', 18, 'add'),
(46, 37, '2022-09-30', 17, 'add'),
(47, 38, '2022-09-30', 17, 'add'),
(48, 39, '2022-09-30', 8, 'add'),
(49, 40, '2022-09-30', 11, 'add'),
(50, 41, '2022-09-30', 5, 'add'),
(51, 42, '2022-09-30', 10, 'add'),
(52, 43, '2022-09-30', 18, 'add'),
(53, 44, '2022-09-30', 18, 'add'),
(54, 45, '2022-09-30', 3, 'add'),
(55, 46, '2022-09-30', 25, 'add'),
(56, 47, '2022-09-30', 270, 'add'),
(57, 48, '2022-09-30', 10, 'add'),
(58, 49, '2022-09-30', 5, 'add'),
(59, 50, '2022-09-30', 2, 'add'),
(60, 51, '2022-09-30', 5, 'add'),
(61, 52, '2022-09-30', 7, 'add'),
(62, 53, '2022-09-30', 14, 'add'),
(63, 24, '2022-12-20', 2, 'restore'),
(64, 42, '2022-12-23', 1, 'restore');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengambilan`
--

CREATE TABLE `t_pengambilan` (
  `id_pengambilan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_pengambilan` date NOT NULL,
  `nama_pengambil` varchar(200) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_pengambilan`
--

INSERT INTO `t_pengambilan` (`id_pengambilan`, `id_barang`, `tgl_pengambilan`, `nama_pengambil`, `jumlah`, `keterangan`) VALUES
(28, 53, '2022-10-12', 'Taryono ari', 1, 'Ruang Guru'),
(29, 53, '2022-10-11', 'Muryati', 1, 'Ruang Guru'),
(30, 53, '2022-10-19', 'Anggita', 1, 'TU'),
(31, 53, '2022-10-26', 'Nurhayati', 2, 'Ruang Guru'),
(32, 53, '2022-10-27', 'Nia', 1, 'BK'),
(33, 53, '2022-10-27', 'Hajid', 1, 'Lab TIK'),
(34, 53, '2022-11-30', 'Muryati', 2, 'Ruang Guru'),
(35, 53, '2022-10-05', 'Suliyem', 1, 'TU'),
(36, 53, '2022-10-26', 'Adnan', 1, 'Ruang Guru'),
(37, 53, '2022-10-31', 'Agustin', 1, 'TU'),
(38, 53, '2022-10-03', 'Sri Purwanta', 1, 'Ruang Waka'),
(39, 53, '2022-10-07', 'Ermi', 1, 'TU'),
(40, 52, '2022-10-05', 'Suliyem', 1, 'TU'),
(41, 52, '2022-10-10', 'Ilma', 1, 'UKS'),
(42, 52, '2022-10-28', 'Wiwik', 1, 'Gugus Covid'),
(43, 52, '2022-11-08', 'Nia', 1, 'BK'),
(44, 52, '2022-11-08', 'Maria Dorothi', 1, 'UKS'),
(45, 52, '2022-12-01', 'Supartinah', 1, 'PPKKS'),
(46, 52, '2022-12-01', 'Nia', 1, 'BK'),
(47, 41, '2022-10-11', 'Tara', 2, 'XI MIPA 1'),
(48, 41, '2022-10-17', 'Aisyah', 2, 'XI IPS 2'),
(49, 41, '2022-11-14', 'Shafa', 1, 'Kelas'),
(50, 23, '2022-10-07', 'Muryati', 1, 'Praktek bhs jawa'),
(51, 23, '2022-10-10', 'Ilma', 1, 'UKS'),
(52, 23, '2022-11-01', 'Eny', 1, 'Ruang Guru'),
(53, 23, '2022-11-02', 'Anggita', 1, 'TU'),
(54, 23, '2022-11-14', 'Anggita', 1, 'TU'),
(55, 23, '2022-11-18', 'Ibnu', 7, 'OSIS'),
(56, 42, '2022-12-01', 'Kiryono', 5, 'Penjaga Malam'),
(57, 44, '2022-12-01', 'Kiryono', 7, 'Penjaga Malam'),
(58, 42, '2022-12-02', 'Mulyanto', 1, 'Lab Kimia'),
(59, 38, '2022-11-29', 'Sarwono', 1, 'Kamar Mandi'),
(60, 38, '2022-11-03', 'Sunoto', 1, 'Kamar mandi'),
(61, 38, '2022-11-03', 'Sarwono', 1, 'Kamar Mandi'),
(62, 25, '2022-10-26', 'Astrid', 1, 'Perpustakaan'),
(63, 25, '2022-10-19', 'Ermi', 1, 'TU'),
(64, 25, '2022-10-07', 'Sarwono', 1, 'Dapur'),
(65, 25, '2022-12-06', 'Angky', 1, 'TU'),
(66, 50, '2022-12-12', 'Isnain Rustam Aji', 1, 'Instalasi listrik dapur'),
(67, 22, '2022-12-12', 'Agustin', 1, 'TU'),
(68, 25, '2022-12-12', 'Kiryono', 1, 'Dapur'),
(69, 42, '2022-12-12', 'Sarwono', 2, 'Instalasi listrik dapur'),
(70, 31, '2022-12-07', 'Zusuf H', 1, 'Waka'),
(71, 24, '2022-12-01', 'Anggita', 1, 'TU'),
(72, 24, '2022-12-02', 'Kasiyanto', 2, 'Ruang Guru'),
(73, 24, '2022-12-02', 'Muryanti', 5, 'PPKKS'),
(74, 22, '2022-12-02', 'Nia', 1, 'BK'),
(75, 24, '2022-12-12', 'Sarwono', 1, 'Dapur'),
(76, 24, '2022-12-12', 'Eko Purwanto', 2, 'EXPO'),
(77, 24, '2022-12-12', 'Suliyem', 1, 'TU'),
(78, 36, '2022-12-06', 'Sukamtiningsih', 18, 'Ruang Guru (ttd raport)'),
(79, 37, '2022-12-06', 'Sukamtiningsih', 17, 'Ruang Guru (ttd raport)'),
(80, 19, '2022-12-01', 'Sukamtiningsih', 40, 'Ruang Guru'),
(81, 24, '2022-12-01', 'Astrid', 1, 'Perpustakaan'),
(82, 46, '2022-12-05', 'Sukamtiningsih', 25, 'Ruang Guru'),
(83, 24, '2022-12-12', 'Miftah Nur', 1, 'Dewan Ambalan'),
(84, 31, '2022-12-15', 'Rini Utami', 3, 'Ruang Guru (E Raport)'),
(85, 32, '2022-12-15', 'Rini Utami', 3, 'Ruang Guru (E Raport)'),
(86, 33, '2022-12-15', 'Rini Utami', 3, 'Ruang Guru (E Raport)'),
(87, 24, '2022-12-16', 'Syahda Maulana S', 1, 'Ruang Bendahara'),
(88, 25, '2022-12-15', 'Astrid', 1, 'Perpustakaan'),
(89, 24, '2022-10-03', 'Dini Ulfa', 1, 'PMR'),
(90, 24, '2022-10-04', 'Eko Purwanto', 2, 'Lab TIK'),
(91, 24, '2022-10-05', 'Sri Hartini', 1, 'Gugus Covid'),
(92, 24, '2022-10-07', 'Sarwono', 1, 'Dapur'),
(93, 24, '2022-10-10', 'Agustin', 1, 'TU'),
(94, 21, '2022-10-10', 'Ilma', 2, 'UKS'),
(95, 24, '2022-10-10', 'Sasa', 1, 'UKS'),
(96, 49, '2022-12-13', 'Wajar B', 5, 'EXPO'),
(97, 24, '2022-12-11', 'Nia', 2, 'BK'),
(98, 24, '2022-10-11', 'Miftah Nur', 1, 'Tim Dapur Umum'),
(99, 24, '2022-10-13', 'Angky', 1, 'TU'),
(100, 32, '2022-10-17', 'Angky', 1, 'TU'),
(101, 24, '2022-10-18', 'Sarwono', 2, 'Dapur'),
(102, 24, '2022-10-18', 'Ambar S', 1, 'Kopsis'),
(103, 29, '2022-10-19', 'Sumardi', 1, 'Gugus Covid'),
(104, 24, '2022-10-20', 'Kasiyanto', 1, 'Ruang Guru'),
(105, 24, '2022-10-24', 'Suliyem', 1, 'TU'),
(106, 24, '2022-10-25', 'Zusuf H', 1, 'Waka'),
(108, 24, '2022-10-26', 'Astrid', 2, 'Perpustakaan'),
(109, 33, '2022-10-26', 'Astrid', 1, 'Perpustakaan'),
(110, 28, '2022-10-27', 'Ririn L', 1, 'Wastafel depan kelas'),
(111, 24, '2022-10-31', 'Ermi', 1, 'TU'),
(112, 24, '2022-10-31', 'Agustin', 1, 'TU'),
(113, 24, '2022-11-02', 'Nia', 1, 'BK'),
(114, 24, '2022-11-02', 'Eko Purwanto', 2, 'Lab TIK'),
(115, 39, '2022-11-03', 'Yukananto', 1, 'Kebersihan'),
(116, 38, '2022-11-03', 'Sunoto', 1, 'Kebersihan'),
(117, 38, '2022-11-03', 'Sarwono', 1, 'Kebersihan'),
(118, 39, '2022-11-04', 'Mulyanto', 2, 'Kebersihan'),
(119, 24, '2022-11-04', 'Mulyanto', 2, 'Kebersihan'),
(120, 50, '2022-11-04', 'Mulyanto', 1, 'Instalasi listrik'),
(121, 24, '2022-11-04', 'Angky', 2, 'Ruang Kepsek'),
(122, 48, '2022-11-04', 'Mulyanto', 2, 'Kebersihan'),
(123, 32, '2022-11-04', 'Ermi', 1, 'PPKKS'),
(124, 21, '2022-11-07', 'Astrid', 2, 'Lab Seni'),
(125, 33, '2022-11-08', 'Sita', 1, 'Ruang Guru'),
(126, 24, '2022-11-08', 'Nia', 2, 'BK'),
(127, 24, '2022-11-10', 'Slavency', 1, 'UKS'),
(128, 24, '2022-11-11', 'Agustin', 1, 'TU'),
(129, 30, '2022-11-11', 'Angky', 1, 'LDK PMR'),
(130, 24, '2022-11-11', 'Adnan', 1, 'Gugus Covid'),
(131, 26, '2022-11-14', 'Slavency', 2, 'UKS'),
(132, 24, '2022-11-14', 'Slavency', 1, 'UKS'),
(133, 40, '2022-11-18', 'Alya', 1, 'Kelas'),
(134, 40, '2022-11-18', 'Dini', 1, 'Kelas'),
(135, 28, '2022-11-18', 'Desi', 1, 'Kelas'),
(136, 48, '2022-11-17', 'Sarwono', 1, 'Mushala'),
(137, 22, '2022-11-16', 'Eko Purwanto', 1, 'Lab TIK'),
(138, 40, '2022-10-04', 'Ermi', 1, 'TU'),
(139, 40, '2022-10-28', 'Fathia', 1, 'Kelas XI MIPA 4'),
(140, 40, '2022-11-18', 'Luluk', 1, 'Lab Fisika'),
(141, 24, '2022-11-23', 'Eko Purwanto', 2, 'Lab TIK'),
(142, 24, '2022-11-22', 'Nia', 2, 'BK'),
(143, 24, '2022-11-24', 'Sunoto', 1, 'Kopsis'),
(144, 31, '2022-11-24', 'Hajid', 1, 'Lab TIK'),
(145, 32, '2022-11-24', 'Hajid', 1, 'Lab TIK'),
(146, 33, '2022-11-24', 'Hajid', 1, 'Lab TIK'),
(147, 24, '2022-11-29', 'Sarwono', 1, 'Dapur'),
(148, 38, '2022-11-29', 'Sarwono', 1, 'Kamar Mandi'),
(149, 24, '2022-11-30', 'Hajid', 1, 'Lab TIK'),
(150, 30, '2022-12-12', 'Hajid', 3, 'EXPO'),
(151, 24, '2022-12-21', 'Astrid', 2, 'Perpustakaan'),
(152, 51, '2022-11-04', 'Mulyanto', 5, 'Instalasi listrik'),
(153, 47, '2022-12-23', 'Ermi', 270, 'TU'),
(155, 42, '2022-12-23', 'Sarwono', 2, 'Ruang Guru'),
(156, 20, '2022-11-30', 'Angky', 2, 'PPKKS'),
(157, 20, '2022-12-01', 'Sutriyani', 1, 'BK'),
(158, 20, '2022-12-02', 'Angky', 1, 'TU'),
(159, 39, '2022-11-29', 'Mulyanto', 1, 'Kebersihan'),
(160, 43, '2022-12-23', 'Kiryono', 3, 'Tempat Parkir'),
(161, 22, '2022-10-27', 'Ririn L', 1, 'Bendahara'),
(162, 45, '2022-10-03', 'Kiryono', 3, 'Instalasi listrik'),
(163, 27, '2022-10-04', 'Sunoto', 1, 'Kebersihan'),
(164, 28, '2022-10-05', 'Yukananto', 4, 'Kebersihan'),
(165, 26, '2022-11-02', 'Zusuf H', 4, 'Waka'),
(166, 22, '2022-11-10', 'Agustin', 6, 'TU'),
(167, 30, '2022-11-16', 'Eko Purwanto', 2, 'Lab TIK'),
(168, 29, '2022-11-24', 'Sumardi', 1, 'Gugus Covid'),
(169, 26, '2022-12-01', 'Maria', 4, 'UKS'),
(170, 26, '2022-11-14', 'Astrid', 2, 'Perpustakaan'),
(171, 20, '2022-11-14', 'Astrid', 2, 'Perpustakaan'),
(172, 26, '2022-10-13', 'Eko Purwanto', 2, 'Lab TIK'),
(173, 32, '2023-01-07', 'Hajid Hamidi', 2, 'Ruang Kurikulum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_satuan`
--

CREATE TABLE `t_satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_satuan`
--

INSERT INTO `t_satuan` (`id_satuan`, `satuan`) VALUES
(1, 'Buah'),
(2, 'Pack'),
(3, 'Botol'),
(4, 'Dirigent'),
(5, 'Dus'),
(6, 'Lembar'),
(7, 'Rim'),
(8, 'Roll'),
(11, 'Strip');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_stock_opname`
--

CREATE TABLE `t_stock_opname` (
  `id_opname` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_update` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `inventory_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_stock_opname`
--

INSERT INTO `t_stock_opname` (`id_opname`, `id_barang`, `tgl_update`, `jumlah`, `inventory_value`) VALUES
(26, 19, '2022-09-30', 40, 6000000),
(27, 20, '2022-09-30', 10, 25000),
(28, 21, '2022-09-30', 24, 120000),
(29, 22, '2022-09-30', 10, 77000),
(30, 23, '2022-09-30', 12, 26400),
(31, 24, '2022-09-30', 98, 1670900),
(32, 25, '2022-09-30', 6, 120000),
(33, 26, '2022-09-30', 64, 633600),
(34, 27, '2022-09-30', 4, 600000),
(35, 28, '2022-09-30', 12, 300000),
(36, 29, '2022-09-30', 10, 2500000),
(37, 30, '2022-09-30', 6, 151800),
(38, 31, '2022-09-30', 11, 2640000),
(39, 32, '2022-09-30', 10, 2400000),
(40, 33, '2022-09-30', 11, 2640000),
(41, 34, '2022-09-30', 7, 588000),
(42, 35, '2022-09-30', 48, 4152000),
(43, 36, '2022-09-30', 18, 360000),
(44, 37, '2022-09-30', 17, 340000),
(45, 38, '2022-09-30', 17, 680000),
(46, 39, '2022-09-30', 8, 120000),
(47, 40, '2022-09-30', 11, 220000),
(48, 41, '2022-09-30', 5, 125000),
(49, 42, '2022-09-30', 10, 1600000),
(50, 43, '2022-09-30', 18, 826200),
(51, 44, '2022-09-30', 18, 752400),
(52, 45, '2022-09-30', 3, 137424),
(53, 46, '2022-09-30', 25, 687500),
(54, 47, '2022-09-30', 270, 405000),
(55, 48, '2022-09-30', 10, 100000),
(56, 49, '2022-09-30', 5, 100000),
(57, 50, '2022-09-30', 2, 50000),
(58, 51, '2022-09-30', 5, 45000),
(59, 52, '2022-09-30', 7, 70000),
(60, 53, '2022-09-30', 14, 826000),
(61, 53, '2022-10-12', 13, 767000),
(62, 53, '2022-10-11', 12, 708000),
(63, 53, '2022-10-19', 11, 649000),
(64, 53, '2022-10-26', 9, 531000),
(65, 53, '2022-10-27', 8, 472000),
(66, 53, '2022-10-27', 7, 413000),
(67, 53, '2022-11-30', 5, 295000),
(68, 53, '2022-10-05', 4, 236000),
(69, 53, '2022-10-26', 3, 177000),
(70, 53, '2022-10-31', 2, 118000),
(71, 53, '2022-10-03', 1, 59000),
(72, 53, '2022-10-07', 0, 0),
(73, 52, '2022-10-05', 6, 60000),
(74, 52, '2022-10-10', 5, 50000),
(75, 52, '2022-10-28', 4, 40000),
(76, 52, '2022-11-08', 3, 30000),
(77, 52, '2022-11-08', 2, 20000),
(78, 52, '2022-12-01', 1, 10000),
(79, 52, '2022-12-01', 0, 0),
(80, 41, '2022-10-11', 3, 75000),
(81, 41, '2022-10-17', 1, 25000),
(82, 41, '2022-11-14', 0, 0),
(83, 23, '2022-10-07', 11, 24200),
(84, 23, '2022-10-10', 10, 22000),
(85, 23, '2022-11-01', 9, 19800),
(86, 23, '2022-11-02', 8, 17600),
(87, 23, '2022-11-14', 7, 15400),
(88, 23, '2022-11-18', 0, 0),
(89, 42, '2022-12-01', 5, 800000),
(90, 44, '2022-12-01', 11, 459800),
(91, 42, '2022-12-02', 4, 640000),
(92, 38, '2022-11-29', 16, 640000),
(93, 38, '2022-11-03', 15, 600000),
(94, 38, '2022-11-03', 14, 560000),
(95, 25, '2022-10-26', 5, 100000),
(96, 25, '2022-10-19', 4, 80000),
(97, 25, '2022-10-07', 3, 60000),
(98, 25, '2022-12-06', 2, 40000),
(99, 50, '2022-12-12', 1, 25000),
(100, 22, '2022-12-12', 9, 69300),
(101, 25, '2022-12-12', 1, 20000),
(102, 42, '2022-12-12', 2, 320000),
(103, 31, '2022-12-07', 10, 2400000),
(104, 24, '2022-12-01', 97, 1653850),
(105, 24, '2022-12-02', 95, 1619750),
(106, 24, '2022-12-02', 90, 1534500),
(107, 22, '2022-12-02', 8, 61600),
(108, 24, '2022-12-12', 89, 1517450),
(109, 24, '2022-12-12', 87, 1483350),
(110, 24, '2022-12-12', 86, 1466300),
(111, 36, '2022-12-06', 0, 0),
(112, 37, '2022-12-06', 0, 0),
(113, 19, '2022-12-01', 0, 0),
(114, 24, '2022-12-01', 85, 1449250),
(115, 46, '2022-12-05', 0, 0),
(116, 24, '2022-12-12', 84, 1432200),
(117, 31, '2022-12-15', 7, 1680000),
(118, 32, '2022-12-15', 7, 1680000),
(119, 33, '2022-12-15', 8, 1920000),
(120, 24, '2022-12-16', 83, 1415150),
(121, 25, '2022-12-15', 0, 0),
(122, 24, '2022-10-03', 82, 1398100),
(123, 24, '2022-10-04', 80, 1364000),
(124, 24, '2022-10-05', 79, 1346950),
(125, 24, '2022-10-07', 78, 1329900),
(126, 24, '2022-10-10', 77, 1312850),
(127, 21, '2022-10-10', 22, 110000),
(128, 24, '2022-10-10', 76, 1295800),
(129, 49, '2022-12-13', 0, 0),
(130, 24, '2022-12-11', 74, 1261700),
(131, 24, '2022-10-11', 73, 1244650),
(132, 24, '2022-10-13', 72, 1227600),
(133, 32, '2022-10-17', 6, 1440000),
(134, 24, '2022-10-18', 70, 1193500),
(135, 24, '2022-10-18', 69, 1176450),
(136, 29, '2022-10-19', 9, 2250000),
(137, 24, '2022-10-20', 68, 1159400),
(138, 24, '2022-10-24', 67, 1142350),
(139, 24, '2022-10-25', 66, 1125300),
(140, 24, '2022-12-20', 64, 1091200),
(141, 24, '2022-12-20', 66, 1125300),
(142, 24, '2022-10-26', 64, 1091200),
(143, 33, '2022-10-26', 7, 1680000),
(144, 28, '2022-10-27', 11, 275000),
(145, 24, '2022-10-31', 63, 1074150),
(146, 24, '2022-10-31', 62, 1057100),
(147, 24, '2022-11-02', 61, 1040050),
(148, 24, '2022-11-02', 59, 1005950),
(149, 39, '2022-11-03', 7, 105000),
(150, 38, '2022-11-03', 13, 520000),
(151, 38, '2022-11-03', 12, 480000),
(152, 39, '2022-11-04', 5, 75000),
(153, 24, '2022-11-04', 57, 971850),
(154, 50, '2022-11-04', 0, 0),
(155, 24, '2022-11-04', 55, 937750),
(156, 48, '2022-11-04', 8, 80000),
(157, 32, '2022-11-04', 5, 1200000),
(158, 21, '2022-11-07', 20, 100000),
(159, 33, '2022-11-08', 6, 1440000),
(160, 24, '2022-11-08', 53, 903650),
(161, 24, '2022-11-10', 52, 886600),
(162, 24, '2022-11-11', 51, 869550),
(163, 30, '2022-11-11', 5, 126500),
(164, 24, '2022-11-11', 50, 852500),
(165, 26, '2022-11-14', 62, 613800),
(166, 24, '2022-11-14', 49, 835450),
(167, 40, '2022-11-18', 10, 200000),
(168, 40, '2022-11-18', 9, 180000),
(169, 28, '2022-11-18', 10, 250000),
(170, 48, '2022-11-17', 7, 70000),
(171, 22, '2022-11-16', 7, 53900),
(172, 40, '2022-10-04', 8, 160000),
(173, 40, '2022-10-28', 7, 140000),
(174, 40, '2022-11-18', 6, 120000),
(175, 24, '2022-11-23', 47, 801350),
(176, 24, '2022-11-22', 45, 767250),
(177, 24, '2022-11-24', 44, 750200),
(178, 31, '2022-11-24', 6, 1440000),
(179, 32, '2022-11-24', 4, 960000),
(180, 33, '2022-11-24', 5, 1200000),
(181, 24, '2022-11-29', 43, 733150),
(182, 38, '2022-11-29', 11, 440000),
(183, 24, '2022-11-30', 42, 716100),
(184, 30, '2022-12-12', 2, 50600),
(185, 24, '2022-12-21', 40, 682000),
(186, 51, '2022-11-04', 0, 0),
(187, 47, '2022-12-23', 0, 0),
(188, 42, '2022-12-23', 1, 160000),
(189, 42, '2022-12-23', 2, 320000),
(190, 42, '2022-12-23', 0, 0),
(191, 20, '2022-11-30', 8, 20000),
(192, 20, '2022-12-01', 7, 17500),
(193, 20, '2022-12-02', 6, 15000),
(194, 39, '2022-11-29', 4, 60000),
(195, 43, '2022-12-23', 15, 688500),
(196, 22, '2022-10-27', 6, 46200),
(197, 45, '2022-10-03', 0, 0),
(198, 27, '2022-10-04', 3, 450000),
(199, 28, '2022-10-05', 6, 150000),
(200, 26, '2022-11-02', 58, 574200),
(201, 22, '2022-11-10', 0, 0),
(202, 30, '2022-11-16', 0, 0),
(203, 29, '2022-11-24', 8, 2000000),
(204, 26, '2022-12-01', 54, 534600),
(205, 26, '2022-11-14', 52, 514800),
(206, 20, '2022-11-14', 4, 10000),
(207, 26, '2022-10-13', 50, 495000),
(208, 32, '2023-01-07', 2, 480000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sumber_dana`
--

CREATE TABLE `t_sumber_dana` (
  `id_sumber` int(11) NOT NULL,
  `sumber` varchar(100) NOT NULL,
  `warna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_sumber_dana`
--

INSERT INTO `t_sumber_dana` (`id_sumber`, `sumber`, `warna`) VALUES
(1, 'BOS', '#389eb7'),
(2, 'BOP', '#41aa4d');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_akun`
--
ALTER TABLE `t_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sumber` (`id_sumber`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indeks untuk tabel `t_masuk_barang`
--
ALTER TABLE `t_masuk_barang`
  ADD PRIMARY KEY (`id_masuk`) USING BTREE,
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `t_pengambilan`
--
ALTER TABLE `t_pengambilan`
  ADD PRIMARY KEY (`id_pengambilan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `t_satuan`
--
ALTER TABLE `t_satuan`
  ADD PRIMARY KEY (`id_satuan`) USING BTREE;

--
-- Indeks untuk tabel `t_stock_opname`
--
ALTER TABLE `t_stock_opname`
  ADD PRIMARY KEY (`id_opname`) USING BTREE,
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `t_sumber_dana`
--
ALTER TABLE `t_sumber_dana`
  ADD PRIMARY KEY (`id_sumber`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_akun`
--
ALTER TABLE `t_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_barang`
--
ALTER TABLE `t_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `t_masuk_barang`
--
ALTER TABLE `t_masuk_barang`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `t_pengambilan`
--
ALTER TABLE `t_pengambilan`
  MODIFY `id_pengambilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT untuk tabel `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `t_stock_opname`
--
ALTER TABLE `t_stock_opname`
  MODIFY `id_opname` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT untuk tabel `t_sumber_dana`
--
ALTER TABLE `t_sumber_dana`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_barang`
--
ALTER TABLE `t_barang`
  ADD CONSTRAINT `t_barang_ibfk_1` FOREIGN KEY (`id_satuan`) REFERENCES `t_satuan` (`id_satuan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `t_barang_ibfk_2` FOREIGN KEY (`id_sumber`) REFERENCES `t_sumber_dana` (`id_sumber`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_masuk_barang`
--
ALTER TABLE `t_masuk_barang`
  ADD CONSTRAINT `t_masuk_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `t_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_pengambilan`
--
ALTER TABLE `t_pengambilan`
  ADD CONSTRAINT `t_pengambilan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `t_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_stock_opname`
--
ALTER TABLE `t_stock_opname`
  ADD CONSTRAINT `t_stock_opname_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `t_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
