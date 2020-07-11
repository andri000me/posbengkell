-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2020 at 12:22 AM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recandid_posbengkell`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batasan_akses`
--

CREATE TABLE `tbl_batasan_akses` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `dashboard` varchar(5) DEFAULT NULL,
  `data_bengkel` varchar(5) DEFAULT NULL,
  `data_pegawai` varchar(5) DEFAULT NULL,
  `data_penerimaan` varchar(5) DEFAULT NULL,
  `data_perintah_kerja` varchar(5) DEFAULT NULL,
  `data_sparepart` varchar(5) DEFAULT NULL,
  `master_data` varchar(5) DEFAULT NULL,
  `admin` varchar(5) DEFAULT NULL,
  `manager` varchar(5) DEFAULT NULL,
  `kategori_sparepart` varchar(5) DEFAULT NULL,
  `kondisi_kendaraan` varchar(5) DEFAULT NULL,
  `info_bengkel` varchar(5) DEFAULT NULL,
  `batasan_akses` varchar(5) DEFAULT NULL,
  `kasir` varchar(5) NOT NULL,
  `gudang` varchar(5) NOT NULL,
  `laporan` varchar(5) NOT NULL,
  `laporan_kendaraan` varchar(5) NOT NULL,
  `laporan_customer` varchar(5) NOT NULL,
  `laporan_profitabilitas` varchar(5) NOT NULL,
  `final_check` varchar(5) NOT NULL,
  `laporan_sparepart` varchar(5) NOT NULL,
  `laporan_labarugi` varchar(5) NOT NULL,
  `laporan_unit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_batasan_akses`
--

INSERT INTO `tbl_batasan_akses` (`id`, `role`, `dashboard`, `data_bengkel`, `data_pegawai`, `data_penerimaan`, `data_perintah_kerja`, `data_sparepart`, `master_data`, `admin`, `manager`, `kategori_sparepart`, `kondisi_kendaraan`, `info_bengkel`, `batasan_akses`, `kasir`, `gudang`, `laporan`, `laporan_kendaraan`, `laporan_customer`, `laporan_profitabilitas`, `final_check`, `laporan_sparepart`, `laporan_labarugi`, `laporan_unit`) VALUES
(1, 'SUPERADMIN', 'ya', 'ya', NULL, NULL, NULL, NULL, NULL, 'ya', 'ya', NULL, NULL, NULL, 'ya', '', '', '', '', '', '', '', '', '', ''),
(2, 'MANAGER', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'ADMIN', 'ya', NULL, 'ya', 'ya', 'ya', 'ya', 'ya', NULL, NULL, 'ya', 'ya', 'ya', '', 'ya', '', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya'),
(4, 'TEKNISI', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'GUDANG', 'ya', NULL, '', '', '', 'ya', 'ya', '', '', 'ya', '', '', '', '', 'ya', '', '', '', '', '', '', '', ''),
(6, 'KASIR', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', 'ya', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_penerimaan`
--

CREATE TABLE `tbl_detail_penerimaan` (
  `id` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '1 = BAIK, 2= RUSAK, 3 = TIDAK ADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_detail_penerimaan`
--

INSERT INTO `tbl_detail_penerimaan` (`id`, `id_penerimaan`, `keterangan`, `status`) VALUES
(1, 1, 'Automatic Light Switch', 1),
(2, 1, 'High Beam', 1),
(3, 1, 'Low Bean', 1),
(4, 1, 'Lampu Kecil', 1),
(5, 1, 'Lampu Sign Depan', 1),
(6, 2, 'Automatic Light Switch', 1),
(7, 2, 'High Beam', 1),
(8, 2, 'Low Bean', 1),
(9, 2, 'Lampu Kecil', 1),
(10, 2, 'Lampu Sign Depan', 2),
(11, 3, 'Automatic Light Switch', 1),
(12, 3, 'High Beam', 1),
(13, 3, 'Low Bean', 1),
(14, 3, 'Lampu Kecil', 1),
(15, 3, 'Lampu Sign Depan', 1),
(16, 4, 'Automatic Light Switch', 1),
(17, 4, 'High Beam', 1),
(18, 4, 'Low Bean', 1),
(19, 4, 'Lampu Kecil', 1),
(20, 4, 'Lampu Sign Depan', 1),
(21, 5, 'Automatic Light Switch', 1),
(22, 5, 'High Beam', 1),
(23, 5, 'Low Bean', 1),
(24, 5, 'Lampu Kecil', 1),
(25, 5, 'Lampu Sign Depan', 1),
(26, 1, 'Automatic Light Switch', 1),
(27, 1, 'High Beam', 1),
(28, 1, 'Low Bean', 1),
(29, 1, 'Lampu Kecil', 1),
(30, 1, 'Lampu Sign Depan', 1),
(31, 2, 'Automatic Light Switch', 1),
(32, 2, 'High Beam', 2),
(33, 2, 'Low Bean', 1),
(34, 2, 'Lampu Kecil', 1),
(35, 2, 'Lampu Sign Depan', 1),
(36, 3, 'Automatic Light Switch', 1),
(37, 3, 'High Beam', 1),
(38, 3, 'Low Bean', 1),
(39, 3, 'Lampu Kecil', 1),
(40, 3, 'Lampu Sign Depan', 1),
(41, 4, 'Automatic Light Switch', 1),
(42, 4, 'High Beam', 1),
(43, 4, 'Low Bean', 1),
(44, 4, 'Lampu Kecil', 1),
(45, 4, 'Lampu Sign Depan', 1),
(46, 5, 'Automatic Light Switch', 1),
(47, 5, 'High Beam', 1),
(48, 5, 'Low Bean', 1),
(49, 5, 'Lampu Kecil', 1),
(50, 5, 'Lampu Sign Depan', 1),
(51, 6, 'Automatic Light Switch', 1),
(52, 6, 'High Beam', 1),
(53, 6, 'Low Bean', 1),
(54, 6, 'Lampu Kecil', 1),
(55, 6, 'Lampu Sign Depan', 1),
(56, 7, 'Automatic Light Switch', 1),
(57, 7, 'High Beam', 1),
(58, 7, 'Low Bean', 1),
(59, 7, 'Lampu Kecil', 1),
(60, 7, 'Lampu Sign Depan', 1),
(61, 8, 'Automatic Light Switch', 0),
(62, 8, 'High Beam', 0),
(63, 8, 'Low Bean', 0),
(64, 8, 'Lampu Kecil', 0),
(65, 8, 'Lampu Sign Depan', 0),
(66, 9, 'Automatic Light Switch', 1),
(67, 9, 'High Beam', 2),
(68, 9, 'Low Bean', 1),
(69, 9, 'Lampu Kecil', 1),
(70, 9, 'Lampu Sign Depan', 1),
(71, 9, 'Sepion Depan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_final_check`
--

CREATE TABLE `tbl_final_check` (
  `id` int(11) NOT NULL,
  `id_perintah_kerja` int(11) NOT NULL,
  `penemuan_saran` text NOT NULL,
  `kebersihan_kendaraan_dalam` tinyint(1) NOT NULL,
  `kebersihan_kendaraan_luar` tinyint(1) NOT NULL,
  `kelengkapan_kendaraan` tinyint(1) NOT NULL,
  `part_bekas` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_final_check`
--

INSERT INTO `tbl_final_check` (`id`, `id_perintah_kerja`, `penemuan_saran`, `kebersihan_kendaraan_dalam`, `kebersihan_kendaraan_luar`, `kelengkapan_kendaraan`, `part_bekas`, `status`) VALUES
(1, 1, '', 1, 1, 0, 0, 1),
(2, 2, 'mantap', 1, 1, 1, 1, 1),
(3, 3, '', 1, 1, 0, 0, 1),
(4, 4, '', 1, 1, 0, 0, 1),
(5, 5, '', 1, 1, 0, 0, 1),
(6, 6, '', 1, 1, 0, 0, 1),
(7, 7, '', 1, 1, 0, 0, 1),
(8, 8, 'Sudah Selesai', 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_bengkel`
--

CREATE TABLE `tbl_info_bengkel` (
  `id` varchar(10) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `no_npwp` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_info_bengkel`
--

INSERT INTO `tbl_info_bengkel` (`id`, `nama_pemilik`, `no_npwp`, `no_telepon`, `alamat`, `foto`) VALUES
('7554478975', 'BENGKEL BUDI', '78473886388377938', '082386283363', 'LUBUK PAKAM', '1591180612Logo_7554478975.jpg'),
('BK001', 'Bengkel Boss', '999888777', '08116002222', 'Jl. Iskandar Muda No.79', '1591180652Logo_BK001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_spare_part`
--

CREATE TABLE `tbl_kategori_spare_part` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori_spare_part`
--

INSERT INTO `tbl_kategori_spare_part` (`id`, `id_bengkel`, `kategori`) VALUES
(2, 'BK001', 'Spion'),
(3, 'BK001', 'Wiper'),
(4, 'BK001', 'Velg'),
(5, 'BK001', 'Lampu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keluhan_permintaan`
--

CREATE TABLE `tbl_keluhan_permintaan` (
  `id` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_keluhan_permintaan`
--

INSERT INTO `tbl_keluhan_permintaan` (`id`, `id_penerimaan`, `kategori`, `keterangan`) VALUES
(1, 1, 'Keluhan', 'Mesin Kasar'),
(2, 2, 'Keluhan', 'Mesin Kasar'),
(3, 3, 'Keluhan', 'Mesin Kasar'),
(4, 4, 'Keluhan', 'MESIN KASAR'),
(5, 5, 'Keluhan', 'SERVICE MESIN'),
(6, 6, 'Keluhan', 'MESIN KASAR'),
(7, 7, 'Keluhan', 'Service Mesin'),
(8, 9, 'Keluhan', 'Mesin Kasar'),
(9, 9, 'Keluhan', 'Rem Depan Tidak Macet'),
(10, 8, 'Keluhan', 'hygygy');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kondisi_kendaraan`
--

CREATE TABLE `tbl_kondisi_kendaraan` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kondisi_kendaraan`
--

INSERT INTO `tbl_kondisi_kendaraan` (`id`, `id_bengkel`, `keterangan`) VALUES
(1, 'BK001', 'Automatic Light Switch'),
(2, 'BK001', 'High Beam'),
(3, 'BK001', 'Low Bean'),
(4, 'BK001', 'Lampu Kecil'),
(5, 'BK001', 'Lampu Sign Depan');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_library_service`
--

CREATE TABLE `tbl_library_service` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `kode_service` varchar(20) NOT NULL,
  `service` text NOT NULL,
  `keterangan` text NOT NULL,
  `biaya` double NOT NULL,
  `tipe_keuntungan` int(1) NOT NULL DEFAULT 0 COMMENT '0=PERSEN, 1=NOMINAL',
  `nilai_keuntungan` double NOT NULL,
  `persen` int(11) NOT NULL COMMENT 'DEPRECATED'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_library_service`
--

INSERT INTO `tbl_library_service` (`id`, `id_bengkel`, `kode_service`, `service`, `keterangan`, `biaya`, `tipe_keuntungan`, `nilai_keuntungan`, `persen`) VALUES
(2, 'BK001', 'SERVICE-1589739528', 'service a', 'afsba asdbnsa sadbasnd', 10000, 0, 14, 14),
(3, 'BK001', 'SERVICE-1589739830', 'service dengan sepenuh hati', 'tanpa neko neko yang terbaik lah diberikan pada anda semua', 200000, 0, 20, 20),
(4, 'BK001', 'SERVICE-1589788255', 'ganti ban external', 'mekanik external', 50000, 0, 15, 15),
(5, 'BK001', 'SERVICE-1589843316', 'Service Mobil Fortuner', 'service full', 950000, 0, 20, 20),
(6, 'BK001', 'SERVICE-1589843556', 'Ganti Spearpart', 'ganti spearpart all', 90000, 0, 20, 20),
(7, 'BK001', 'SERVICE-1590426134', 'baru nominal', '2 ribu aja keuntungannya', 10000, 1, 2000, 0),
(8, 'BK001', 'SERVICE-1590426881', 'baru persen', 'keuntungan baru dalam persen', 50000, 0, 10, 0),
(9, 'BK001', 'SERVICE-1590483653', 'Service plus plus', 'service internal', 0, 1, 100000, 0),
(10, 'BK001', 'SERVICE-1590553285', 'service plus extr', 'external', 100000, 0, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notifikasi`
--

INSERT INTO `tbl_notifikasi` (`id`, `judul`, `deskripsi`, `id_user`, `is_read`) VALUES
(1, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(2, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(3, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(4, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(5, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(6, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(7, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(8, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(9, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id`, `id_user`, `nip`, `nama`) VALUES
(1, 2, '111', 'Anita'),
(2, 3, '123456', 'Joy Marubah'),
(3, 4, '222222', 'Tio Tizardi'),
(4, 5, '991199', 'Jepri Naibaho'),
(5, 14, '22137048', 'juki marzuki'),
(6, 15, '9991919', 'atep suratep'),
(7, 16, '001919', 'robin salim'),
(8, 17, '71482401', 'mega kasir');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penerimaan`
--

CREATE TABLE `tbl_penerimaan` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `email_pemilik` varchar(100) NOT NULL,
  `alamat_pemilik` text NOT NULL,
  `telepon_pemilik` varchar(50) NOT NULL,
  `no_pkb` varchar(100) NOT NULL,
  `no_polisi` varchar(20) NOT NULL,
  `no_rangka` varchar(100) NOT NULL,
  `no_mesin` varchar(50) NOT NULL,
  `tipe_warna` varchar(100) NOT NULL,
  `tahun_produksi` year(4) NOT NULL,
  `kilometer` int(11) NOT NULL,
  `bahan_bakar` tinyint(1) NOT NULL,
  `tgl_penerimaan` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_transaksi` datetime DEFAULT NULL,
  `bayar` double NOT NULL,
  `kembalian` double NOT NULL,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `diskon_service` int(11) NOT NULL,
  `diskon_sparepart` int(11) NOT NULL,
  `ppn` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Penerimaan,1=Perintah Kerja, 2=Final Check, 3=Paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penerimaan`
--

INSERT INTO `tbl_penerimaan` (`id`, `id_bengkel`, `id_admin`, `nama_pemilik`, `email_pemilik`, `alamat_pemilik`, `telepon_pemilik`, `no_pkb`, `no_polisi`, `no_rangka`, `no_mesin`, `tipe_warna`, `tahun_produksi`, `kilometer`, `bahan_bakar`, `tgl_penerimaan`, `tgl_transaksi`, `bayar`, `kembalian`, `diskon`, `diskon_service`, `diskon_sparepart`, `ppn`, `status`) VALUES
(1, 'BK001', 10, 'Budi Liliyanto', 'budililiyanto@gmail.com', 'Medan', '082386283363', 'BK001-1589947273', 'BK 3396', '98339JH9893', '783728826382762', 'FORTUNER,HITAM', 2020, 30000, 1, '2020-05-20 11:01:44', '2020-05-20 11:09:38', 1850000, 5300, 0, 5, 1, 0, 3),
(2, 'BK001', 10, 'JONI', 'JONI@GMAIL.COM', 'Medan', '082386283363', 'BK001-1590421875', 'BK 000 TO', '9976ghhgf64666', '32423423223', 'FORTUNER,HITAM', 2020, 3000, 1, '2020-05-25 22:51:44', '2020-05-26 01:13:50', 1393700, 3685, 0, 5, 0, 0, 3),
(3, 'BK001', 10, 'Alma', 'alma@gmail.com', 'Medan', '083167098372', 'BK001-1590483701', 'bk 998 ty', '980828TY8638IX7', '783728826382762', 'FORTUNER,HITAM', 2020, 20000, 1, '2020-05-26 16:02:30', '2020-05-26 16:07:13', 2860000, 0, 0, 0, 0, 0, 3),
(4, 'BK001', 10, 'DIDIN', 'DIDIN@GMAIL.COM', 'JAMBI', '081176283749', 'BK001-1590552532', 'BH 987 TI', '3736648736CDJ3739', '848379MND304848', 'FORTUNER, PUTIH', 2020, 20000, 1, '2020-05-27 11:09:58', '2020-05-27 11:13:25', 880000, 0, 0, 0, 0, 0, 3),
(5, 'BK001', 10, 'NANI', 'NANI@GMAIL.COM', 'MEDAN', '082160640970', 'BK001-1590552908', 'BK 987 IO', '83874DHHBDH2639WJ', 'HH3842776DJND33', 'AVANZA, HITAM', 2020, 20000, 1, '2020-05-27 11:16:03', '2020-05-27 11:18:58', 770000, 0, 0, 0, 0, 0, 3),
(6, 'BK001', 10, 'ZIKRI', 'ZIKRI@GMAIL.COM', 'MEDAN', '0987566252525', 'BK001-1590553302', 'BK 876 TO', '566252775GGGSG2526', '76227766SGW62627', 'AVANZA, SILVER', 2020, 20000, 1, '2020-05-27 11:22:41', '2020-05-27 11:27:57', 760000, 5125, 0, 7, 5, 0, 3),
(7, 'BK001', 10, 'Budi Liliyanto', 'budililiyanto@gmail.com', 'Medan', '082386283363', 'BK001-1590811406', 'BK 3396', '980828TY8638IX7', '3434433HD77888', 'FORTUNER,HITAM', 2020, 2000, 1, '2020-05-30 11:04:19', '2020-05-30 11:09:54', 730000, 6750, 0, 0, 0, 0, 3),
(8, 'BK001', 10, 'Budi Sari', 'budililiyanto@gmail.com', 'medan', '082386283363', 'BK001-1591079849', 'BK 97 AO', '980828TY8638IX7', '3434433HD77888', 'FORTUNER,PUTIH', 2020, 20000, 1, '2020-06-02 13:37:54', NULL, 0, 0, 0, 0, 0, 0, 1),
(9, 'BK001', 10, 'Pak Gultom', 'gultom@gmail.com', 'Medan', '08366372883', 'BK001-1591180705', 'BK 99 TO', '883772J73992EJ3', '9983JEE8399928', 'FORTUNER,PUTIH', 2019, 40000, 1, '2020-06-03 17:39:41', '2020-06-03 18:20:47', 740000, 6300, 0, 3, 5, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perintah_kerja`
--

CREATE TABLE `tbl_perintah_kerja` (
  `id` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `pelanggan` varchar(100) NOT NULL DEFAULT 'Menunggu',
  `tgl_jam_appointment` datetime NOT NULL,
  `tgl_jam_penyerahan` datetime NOT NULL,
  `id_teknisi` int(11) NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `stnk` tinyint(1) NOT NULL DEFAULT 0,
  `buku_service` tinyint(1) NOT NULL DEFAULT 0,
  `pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_perintah_kerja`
--

INSERT INTO `tbl_perintah_kerja` (`id`, `id_penerimaan`, `id_admin`, `pekerjaan`, `pelanggan`, `tgl_jam_appointment`, `tgl_jam_penyerahan`, `id_teknisi`, `id_gudang`, `stnk`, `buku_service`, `pembayaran`) VALUES
(1, 1, 10, 'ERC', 'Ditunggu', '2020-05-20 11:02:13', '2020-05-20 22:00:13', 3, 5, 1, 1, ''),
(2, 2, 10, 'ERC', 'Ditunggu', '2020-05-25 22:52:10', '2020-05-25 22:50:10', 3, 5, 1, 1, ''),
(3, 3, 10, 'ERC', 'Ditunggu', '2020-05-26 16:02:23', '2020-05-26 23:45:23', 3, 5, 1, 1, ''),
(4, 4, 10, 'ERC', 'Ditunggu', '2020-05-27 11:09:30', '2020-05-27 17:50:30', 3, 5, 1, 1, ''),
(5, 5, 10, 'ERC', 'Ditunggu', '2020-05-27 11:15:39', '2020-05-27 17:50:39', 3, 5, 1, 1, ''),
(6, 6, 10, 'ERC', 'Ditunggu', '2020-05-27 11:22:22', '2020-05-27 16:50:22', 3, 5, 1, 1, ''),
(7, 7, 10, 'ERC', 'Ditunggu', '2020-05-30 11:04:06', '2020-05-30 23:50:06', 3, 5, 1, 1, ''),
(8, 9, 10, 'ERC', 'Ditunggu', '2020-06-03 17:42:13', '2020-06-03 23:40:13', 3, 5, 1, 1, ''),
(9, 8, 10, 'Erc', 'Ditunggu', '2020-06-12 14:43:56', '2020-06-13 14:25:56', 4, 5, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spare_part`
--

CREATE TABLE `tbl_spare_part` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `stok` int(11) NOT NULL,
  `temp` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_spare_part`
--

INSERT INTO `tbl_spare_part` (`id`, `kode_barang`, `id_bengkel`, `kategori`, `nama`, `harga_beli`, `harga_jual`, `stok`, `temp`, `tgl_input`) VALUES
(1, '1589730236', 'BK001', 'Lampu', 'Lampu Low Beam Multifungsi', 300000, 600000, 81, 4, '2020-05-17 22:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_spare_part`
--

CREATE TABLE `tbl_transaksi_spare_part` (
  `id` int(11) NOT NULL,
  `id_perintah_kerja` int(11) NOT NULL,
  `id_spare_part` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=PROCESS, 1=DONE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transaksi_spare_part`
--

INSERT INTO `tbl_transaksi_spare_part` (`id`, `id_perintah_kerja`, `id_spare_part`, `qty`, `keterangan`, `status`) VALUES
(1, 1, 1, 1, 'Lampu depan', 1),
(2, 2, 1, 2, 'oke', 1),
(3, 3, 1, 1, 'Lampu Depan', 1),
(4, 4, 1, 1, 'lampu depan', 1),
(5, 5, 1, 1, 'LAMPU DEPAN', 1),
(6, 6, 1, 1, 'LAMPU DEPAN', 1),
(7, 7, 1, 1, 'Lampu Depan', 1),
(8, 8, 1, 1, 'Lampu Depan', 1),
(9, 9, 1, 4, 'tgtg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uraian_pekerjaan`
--

CREATE TABLE `tbl_uraian_pekerjaan` (
  `id` int(11) NOT NULL,
  `id_perintah_kerja` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `estimasi_biaya` double NOT NULL,
  `biaya` double NOT NULL,
  `tipe_keuntungan` int(11) NOT NULL DEFAULT 0 COMMENT '0=PERSEN, 1=NOMINAL',
  `nilai_keuntungan` double NOT NULL,
  `persen` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = PROCESS, 1 = DONE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_uraian_pekerjaan`
--

INSERT INTO `tbl_uraian_pekerjaan` (`id`, `id_perintah_kerja`, `id_service`, `keterangan`, `estimasi_biaya`, `biaya`, `tipe_keuntungan`, `nilai_keuntungan`, `persen`, `status`) VALUES
(1, 1, 5, 'service full', 0, 950000, 0, 20, 20, 1),
(3, 2, 7, '2 ribu aja keuntungannya', 0, 10000, 1, 2000, 0, 1),
(4, 2, 8, 'keuntungan baru dalam persen', 0, 50000, 0, 10, 0, 1),
(5, 3, 9, 'service internal', 0, 2000000, 1, 0, 0, 1),
(6, 4, 9, 'service internal', 0, 100000, 1, 100000, 0, 1),
(7, 5, 9, 'service internal', 0, 0, 1, 100000, 0, 1),
(8, 6, 10, 'external', 0, 100000, 0, 25, 0, 1),
(9, 7, 4, 'mekanik external', 0, 50000, 0, 15, 0, 1),
(10, 8, 9, 'service internal', 0, 0, 1, 100000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'SUPER_ADMIN, ADMIN, TEKNISI, MANAGER, KASIR, GUDANG',
  `remember_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `firebase_token` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_bengkel`, `username`, `password`, `role_user`, `remember_token`, `firebase_token`) VALUES
(1, '-', 'admin', '$2y$10$aseXR2mDPIv63xz7ewI4N.R8EDP/3asA4f2jh6LP9DtropsEisNNu', 'SUPERADMIN', '', 'ehdyisnbvchsadbcjsd'),
(3, 'BK001', 'joy', '$2y$10$RvgzeMxS7etQ.hOrsUkr0.IdI4xUDL6cDQblBlkJjWLZKeZPatSEi', 'TEKNISI', '', 'cOoPwhP-SYSqddAh4VJDq9:APA91bEz-vsXH_UP4ch0FYzUys2GUBC4MEVEUJdLaTzrDFJjVqqT4qHNzoq1W_PIZ0PKL2vo84mML287DxBx89mCuEfJpwq8C1V6ZftWgJU37du22mV6SokljbMtdvpyc97TRGgtDUQx'),
(4, 'BK001', 'tio', '$2y$10$aseXR2mDPIv63xz7ewI4N.R8EDP/3asA4f2jh6LP9DtropsEisNNu', 'TEKNISI', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNTkyNDU2MDE1LCJpZCI6IjQiLCJpZF9iZW5na2VsIjoiQkswMDEiLCJ1c2VybmFtZSI6InRpbyIsIm5hbWEiOiJUaW8gVGl6YXJkaSIsInJvbGVfdXNlciI6IlRFS05JU0kifQ.JZQdloCeLNUCLAdbWP_DiL7zuvG2Ju2PI5hn-Q7wVFI', 'cT2bl-OATf2dgNOHbL1JPO:APA91bFDz8Uy84ntpOdpSj-RLkhaAKZ0443RD7e3TYIb0LHBiChXHr6vif4YMmb5P5qILMKP-7GkoSFl7Obfbi3FiqEZfvp7tY75eeiacM8ztWUzJrCn7eEUnA_8UYeJvj15yLQLZ-yL'),
(5, 'BK001', 'Jepri', '$2y$10$hkkN4Tm6EWpmM/WRiPyOZej3riL8VDo.WbgQSaCHFjDe6uprWAT2q', 'GUDANG', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNTg4MDU0MDc4LCJpZCI6IjUiLCJpZF9iZW5na2VsIjoiQkswMDEiLCJ1c2VybmFtZSI6IkplcHJpIiwibmFtYSI6IkplcHJpIE5haWJhaG8iLCJyb2xlX3VzZXIiOiJHVURBTkcifQ.4aVviMGXRjCg1sLMs3l7xUWynQMgn-qtK10ufiEb_UQ', 'daTsTY8-Te2RjqMeGojNzO:APA91bHSE_qZ-gNGwnW_cDI3BeHN_zbtbXN9fN6N1IqyaQv2TGxzcuIwF_AnCQMaFI5m_E6KB-uc3fDjxXpUGsjstJoeB7iOth3FCovX6SfWwgtSgy8oeu9tTz4FL-iRg9FsfKDsfDwr'),
(10, 'BK001', 'anita', '$2y$10$pNFLU9dbCWsZZL5DHJfZ1efOtpYHqx.5zmhUtEMlp6cUvj/Aqr2FO', 'ADMIN', '', ''),
(11, 'BK001', 'rey', '$2y$10$wtb/Vf4GQQ4.tn2tm9Vz1.ZdzX4lyNw5mxrBlMLCWXnIGaS0VJBjG', 'MANAGER', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNTkxMTgzNTEwLCJpZCI6IjExIiwiaWRfYmVuZ2tlbCI6IkJLMDAxIiwidXNlcm5hbWUiOiJyZXkiLCJuYW1hIjpudWxsLCJyb2xlX3VzZXIiOiJNQU5BR0VSIn0.dd0HjzeWMnZGEMv3irDGFKYF1WeBUjkw_WSqleOTGWY', 'fepqW9tnQ-6SfCB7agnczy:APA91bGRo8oF_4mN2BKRl04vBGbWVjg4VyUnyB63tpouFKVzx8LMjE8FutWcoVRAwFQi1r0VZkzWxUSNmOnbXKLe_XZft4z2Qh_8_2yWSdMORqAWP2S_6-kB8Vj9DZ0806NxBrM3oLrJ'),
(12, 'BK002', 'cika', '$2y$10$VNuvZxUGakxNoMzOIaWjIe.ovCM.fCPq1R5W7tlt76gvdW2JO/98S', 'MANAGER', '', ''),
(13, 'BK002', 'linda', '$2y$10$hkkN4Tm6EWpmM/WRiPyOZej3riL8VDo.WbgQSaCHFjDe6uprWAT2q', 'ADMIN', '', ''),
(14, 'BK002', 'juki', '$2y$10$8E6FLnbg/z89uTFazMCcAOhXjsqmkPkddvbEjIt88dpvPVVcXmBKe', 'TEKNISI', '', ''),
(15, 'BK002', 'atep', '$2y$10$1HfEsmVkBrhU/jT1g1fBYOSnffpyKmcKVrkEhx/uFb3elGJxWVyGK', 'GUDANG', '', ''),
(16, 'BK001', 'robin', '$2y$10$hzrLAQl5jM94sV8szuGV2.OA4pa8xTnIxirC4HPwnmD76SqRnhdYe', 'TEKNISI', '', ''),
(17, 'BK001', 'mega', '$2y$10$pNFLU9dbCWsZZL5DHJfZ1efOtpYHqx.5zmhUtEMlp6cUvj/Aqr2FO', 'KASIR', '', ''),
(18, '7554478975', 'budi', '$2y$10$LW/FNMhnbtcSjoTrmVyl0efPKHR92Wos06B3coD17J9GFVAwuUQJu', 'ADMIN', '', ''),
(19, '7554478975', 'joko', '$2y$10$fiq5q0Iz1klBfRfaOyH12eIC/.fDIsAtfGnr/JHMspYx3ZvM8i/iC', 'MANAGER', '', 'cVXwb_z3QMea85T169vwdR:APA91bHWmi-nL7VeczdZ5LcuAnIER2uB8-ktcalVwWgkuK92xDIUhEXMJH-F7Ok6CglMCW84kLAcdQ7ejWAgqXu3PJMMnM8XfAYZlvp6f-QyrEIuJYIa9TLizVDLYzeL0PC1qeg8R5Yo');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_data_pegawai`
-- (See below for the actual view)
--
CREATE TABLE `view_data_pegawai` (
`id` int(11)
,`id_bengkel` varchar(10)
,`username` varchar(100)
,`password` text
,`role_user` varchar(50)
,`remember_token` text
,`firebase_token` text
,`id_pegawai` int(11)
,`nip` varchar(100)
,`nama` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_data_penerimaan`
-- (See below for the actual view)
--
CREATE TABLE `view_data_penerimaan` (
`id` int(11)
,`id_bengkel` varchar(10)
,`id_admin` int(11)
,`nama_pemilik` varchar(100)
,`email_pemilik` varchar(100)
,`alamat_pemilik` text
,`telepon_pemilik` varchar(50)
,`no_pkb` varchar(100)
,`no_polisi` varchar(20)
,`no_rangka` varchar(100)
,`no_mesin` varchar(50)
,`tipe_warna` varchar(100)
,`tahun_produksi` year(4)
,`kilometer` int(11)
,`bahan_bakar` tinyint(1)
,`tgl_penerimaan` datetime
,`tgl_transaksi` datetime
,`bayar` double
,`kembalian` double
,`diskon` int(11)
,`diskon_service` int(11)
,`diskon_sparepart` int(11)
,`ppn` double
,`status` tinyint(4)
,`admin` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_data_service`
-- (See below for the actual view)
--
CREATE TABLE `view_data_service` (
`id` int(11)
,`id_perintah_kerja` int(11)
,`id_service` int(11)
,`keterangan` text
,`estimasi_biaya` double
,`biaya` double
,`tipe_keuntungan` int(11)
,`nilai_keuntungan` double
,`persen` int(11)
,`status` tinyint(4)
,`jenis_service` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_perintah_kerja`
-- (See below for the actual view)
--
CREATE TABLE `view_perintah_kerja` (
`id` int(11)
,`id_penerimaan` int(11)
,`id_admin` int(11)
,`pekerjaan` varchar(50)
,`pelanggan` varchar(100)
,`tgl_jam_appointment` datetime
,`tgl_jam_penyerahan` datetime
,`id_teknisi` int(11)
,`id_gudang` int(11)
,`stnk` tinyint(1)
,`buku_service` tinyint(1)
,`pembayaran` varchar(20)
,`no_pkb` varchar(100)
,`id_bengkel` varchar(10)
,`no_polisi` varchar(20)
,`no_rangka` varchar(100)
,`no_mesin` varchar(50)
,`tipe_warna` varchar(100)
,`nama_pemilik` varchar(100)
,`telepon_pemilik` varchar(50)
,`tgl_transaksi` datetime
,`diskon` int(11)
,`diskon_service` int(11)
,`diskon_sparepart` int(11)
,`status` tinyint(4)
,`admin` varchar(100)
,`teknisi` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_transaksi_sparepart`
-- (See below for the actual view)
--
CREATE TABLE `view_transaksi_sparepart` (
`id` int(11)
,`id_perintah_kerja` int(11)
,`id_spare_part` int(11)
,`qty` int(11)
,`keterangan` text
,`status` int(11)
,`harga_jual` double
,`id_bengkel` varchar(10)
,`tgl_input` datetime
,`kode_barang` varchar(100)
,`nama_barang` varchar(100)
,`harga_beli` double
,`stok` int(11)
,`tgl_transaksi` datetime
,`status_penerimaan` tinyint(4)
);

-- --------------------------------------------------------

--
-- Structure for view `view_data_pegawai`
--
DROP TABLE IF EXISTS `view_data_pegawai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`recandid`@`localhost` SQL SECURITY DEFINER VIEW `view_data_pegawai`  AS  select `tbl_user`.`id` AS `id`,`tbl_user`.`id_bengkel` AS `id_bengkel`,`tbl_user`.`username` AS `username`,`tbl_user`.`password` AS `password`,`tbl_user`.`role_user` AS `role_user`,`tbl_user`.`remember_token` AS `remember_token`,`tbl_user`.`firebase_token` AS `firebase_token`,(select `tbl_pegawai`.`id` from `tbl_pegawai` where `tbl_pegawai`.`id_user` = `tbl_user`.`id`) AS `id_pegawai`,(select `tbl_pegawai`.`nip` from `tbl_pegawai` where `tbl_pegawai`.`id_user` = `tbl_user`.`id`) AS `nip`,(select `tbl_pegawai`.`nama` from `tbl_pegawai` where `tbl_pegawai`.`id_user` = `tbl_user`.`id`) AS `nama` from `tbl_user` where `tbl_user`.`role_user` <> 'SUPERADMIN' ;

-- --------------------------------------------------------

--
-- Structure for view `view_data_penerimaan`
--
DROP TABLE IF EXISTS `view_data_penerimaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`recandid`@`localhost` SQL SECURITY DEFINER VIEW `view_data_penerimaan`  AS  select `tbl_penerimaan`.`id` AS `id`,`tbl_penerimaan`.`id_bengkel` AS `id_bengkel`,`tbl_penerimaan`.`id_admin` AS `id_admin`,`tbl_penerimaan`.`nama_pemilik` AS `nama_pemilik`,`tbl_penerimaan`.`email_pemilik` AS `email_pemilik`,`tbl_penerimaan`.`alamat_pemilik` AS `alamat_pemilik`,`tbl_penerimaan`.`telepon_pemilik` AS `telepon_pemilik`,`tbl_penerimaan`.`no_pkb` AS `no_pkb`,`tbl_penerimaan`.`no_polisi` AS `no_polisi`,`tbl_penerimaan`.`no_rangka` AS `no_rangka`,`tbl_penerimaan`.`no_mesin` AS `no_mesin`,`tbl_penerimaan`.`tipe_warna` AS `tipe_warna`,`tbl_penerimaan`.`tahun_produksi` AS `tahun_produksi`,`tbl_penerimaan`.`kilometer` AS `kilometer`,`tbl_penerimaan`.`bahan_bakar` AS `bahan_bakar`,`tbl_penerimaan`.`tgl_penerimaan` AS `tgl_penerimaan`,`tbl_penerimaan`.`tgl_transaksi` AS `tgl_transaksi`,`tbl_penerimaan`.`bayar` AS `bayar`,`tbl_penerimaan`.`kembalian` AS `kembalian`,`tbl_penerimaan`.`diskon` AS `diskon`,`tbl_penerimaan`.`diskon_service` AS `diskon_service`,`tbl_penerimaan`.`diskon_sparepart` AS `diskon_sparepart`,`tbl_penerimaan`.`ppn` AS `ppn`,`tbl_penerimaan`.`status` AS `status`,(select `tbl_user`.`username` from `tbl_user` where `tbl_user`.`id` = `tbl_penerimaan`.`id_admin`) AS `admin` from `tbl_penerimaan` ;

-- --------------------------------------------------------

--
-- Structure for view `view_data_service`
--
DROP TABLE IF EXISTS `view_data_service`;

CREATE ALGORITHM=UNDEFINED DEFINER=`recandid`@`localhost` SQL SECURITY DEFINER VIEW `view_data_service`  AS  select `tbl_uraian_pekerjaan`.`id` AS `id`,`tbl_uraian_pekerjaan`.`id_perintah_kerja` AS `id_perintah_kerja`,`tbl_uraian_pekerjaan`.`id_service` AS `id_service`,`tbl_uraian_pekerjaan`.`keterangan` AS `keterangan`,`tbl_uraian_pekerjaan`.`estimasi_biaya` AS `estimasi_biaya`,`tbl_uraian_pekerjaan`.`biaya` AS `biaya`,`tbl_uraian_pekerjaan`.`tipe_keuntungan` AS `tipe_keuntungan`,`tbl_uraian_pekerjaan`.`nilai_keuntungan` AS `nilai_keuntungan`,`tbl_uraian_pekerjaan`.`persen` AS `persen`,`tbl_uraian_pekerjaan`.`status` AS `status`,(select `tbl_library_service`.`service` from `tbl_library_service` where `tbl_library_service`.`id` = `tbl_uraian_pekerjaan`.`id_service`) AS `jenis_service` from `tbl_uraian_pekerjaan` ;

-- --------------------------------------------------------

--
-- Structure for view `view_perintah_kerja`
--
DROP TABLE IF EXISTS `view_perintah_kerja`;

CREATE ALGORITHM=UNDEFINED DEFINER=`recandid`@`localhost` SQL SECURITY DEFINER VIEW `view_perintah_kerja`  AS  select `tbl_perintah_kerja`.`id` AS `id`,`tbl_perintah_kerja`.`id_penerimaan` AS `id_penerimaan`,`tbl_perintah_kerja`.`id_admin` AS `id_admin`,`tbl_perintah_kerja`.`pekerjaan` AS `pekerjaan`,`tbl_perintah_kerja`.`pelanggan` AS `pelanggan`,`tbl_perintah_kerja`.`tgl_jam_appointment` AS `tgl_jam_appointment`,`tbl_perintah_kerja`.`tgl_jam_penyerahan` AS `tgl_jam_penyerahan`,`tbl_perintah_kerja`.`id_teknisi` AS `id_teknisi`,`tbl_perintah_kerja`.`id_gudang` AS `id_gudang`,`tbl_perintah_kerja`.`stnk` AS `stnk`,`tbl_perintah_kerja`.`buku_service` AS `buku_service`,`tbl_perintah_kerja`.`pembayaran` AS `pembayaran`,(select `tbl_penerimaan`.`no_pkb` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `no_pkb`,(select `tbl_penerimaan`.`id_bengkel` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `id_bengkel`,(select `tbl_penerimaan`.`no_polisi` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `no_polisi`,(select `tbl_penerimaan`.`no_rangka` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `no_rangka`,(select `tbl_penerimaan`.`no_mesin` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `no_mesin`,(select `tbl_penerimaan`.`tipe_warna` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `tipe_warna`,(select `tbl_penerimaan`.`nama_pemilik` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `nama_pemilik`,(select `tbl_penerimaan`.`telepon_pemilik` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `telepon_pemilik`,(select `tbl_penerimaan`.`tgl_transaksi` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `tgl_transaksi`,(select `tbl_penerimaan`.`diskon` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `diskon`,(select `tbl_penerimaan`.`diskon_service` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `diskon_service`,(select `tbl_penerimaan`.`diskon_sparepart` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `diskon_sparepart`,(select `tbl_penerimaan`.`status` from `tbl_penerimaan` where `tbl_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `status`,(select `view_data_penerimaan`.`admin` from `view_data_penerimaan` where `view_data_penerimaan`.`id` = `tbl_perintah_kerja`.`id_penerimaan`) AS `admin`,(select `tbl_user`.`username` from `tbl_user` where `tbl_user`.`id` = `tbl_perintah_kerja`.`id_teknisi`) AS `teknisi` from `tbl_perintah_kerja` ;

-- --------------------------------------------------------

--
-- Structure for view `view_transaksi_sparepart`
--
DROP TABLE IF EXISTS `view_transaksi_sparepart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`recandid`@`localhost` SQL SECURITY DEFINER VIEW `view_transaksi_sparepart`  AS  select `tbl_transaksi_spare_part`.`id` AS `id`,`tbl_transaksi_spare_part`.`id_perintah_kerja` AS `id_perintah_kerja`,`tbl_transaksi_spare_part`.`id_spare_part` AS `id_spare_part`,`tbl_transaksi_spare_part`.`qty` AS `qty`,`tbl_transaksi_spare_part`.`keterangan` AS `keterangan`,`tbl_transaksi_spare_part`.`status` AS `status`,(select `tbl_spare_part`.`harga_jual` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `harga_jual`,(select `tbl_spare_part`.`id_bengkel` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `id_bengkel`,(select `tbl_spare_part`.`tgl_input` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `tgl_input`,(select `tbl_spare_part`.`kode_barang` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `kode_barang`,(select `tbl_spare_part`.`nama` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `nama_barang`,(select `tbl_spare_part`.`harga_beli` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `harga_beli`,(select `tbl_spare_part`.`stok` from `tbl_spare_part` where `tbl_spare_part`.`id` = `tbl_transaksi_spare_part`.`id_spare_part`) AS `stok`,(select `view_perintah_kerja`.`tgl_transaksi` from `view_perintah_kerja` where `view_perintah_kerja`.`id` = `tbl_transaksi_spare_part`.`id_perintah_kerja`) AS `tgl_transaksi`,(select `view_perintah_kerja`.`status` from `view_perintah_kerja` where `view_perintah_kerja`.`id` = `tbl_transaksi_spare_part`.`id_perintah_kerja`) AS `status_penerimaan` from `tbl_transaksi_spare_part` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_batasan_akses`
--
ALTER TABLE `tbl_batasan_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_detail_penerimaan`
--
ALTER TABLE `tbl_detail_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_final_check`
--
ALTER TABLE `tbl_final_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info_bengkel`
--
ALTER TABLE `tbl_info_bengkel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kategori_spare_part`
--
ALTER TABLE `tbl_kategori_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_keluhan_permintaan`
--
ALTER TABLE `tbl_keluhan_permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kondisi_kendaraan`
--
ALTER TABLE `tbl_kondisi_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_library_service`
--
ALTER TABLE `tbl_library_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penerimaan`
--
ALTER TABLE `tbl_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_perintah_kerja`
--
ALTER TABLE `tbl_perintah_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_spare_part`
--
ALTER TABLE `tbl_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi_spare_part`
--
ALTER TABLE `tbl_transaksi_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_uraian_pekerjaan`
--
ALTER TABLE `tbl_uraian_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_batasan_akses`
--
ALTER TABLE `tbl_batasan_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_detail_penerimaan`
--
ALTER TABLE `tbl_detail_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tbl_final_check`
--
ALTER TABLE `tbl_final_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_kategori_spare_part`
--
ALTER TABLE `tbl_kategori_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_keluhan_permintaan`
--
ALTER TABLE `tbl_keluhan_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_kondisi_kendaraan`
--
ALTER TABLE `tbl_kondisi_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_library_service`
--
ALTER TABLE `tbl_library_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_penerimaan`
--
ALTER TABLE `tbl_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_perintah_kerja`
--
ALTER TABLE `tbl_perintah_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_spare_part`
--
ALTER TABLE `tbl_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transaksi_spare_part`
--
ALTER TABLE `tbl_transaksi_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_uraian_pekerjaan`
--
ALTER TABLE `tbl_uraian_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
