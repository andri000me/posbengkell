-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jul 2020 pada 03.37
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posbengkel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_batasan_akses`
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
  `laporan_unit` varchar(5) NOT NULL,
  `library_service` varchar(5) DEFAULT NULL,
  `task_teknisi` varchar(5) DEFAULT NULL,
  `supplier` char(5) NOT NULL,
  `pembelian` char(5) NOT NULL,
  `penjualan` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_batasan_akses`
--

INSERT INTO `tbl_batasan_akses` (`id`, `role`, `dashboard`, `data_bengkel`, `data_pegawai`, `data_penerimaan`, `data_perintah_kerja`, `data_sparepart`, `master_data`, `admin`, `manager`, `kategori_sparepart`, `kondisi_kendaraan`, `info_bengkel`, `batasan_akses`, `kasir`, `gudang`, `laporan`, `laporan_kendaraan`, `laporan_customer`, `laporan_profitabilitas`, `final_check`, `laporan_sparepart`, `laporan_labarugi`, `laporan_unit`, `library_service`, `task_teknisi`, `supplier`, `pembelian`, `penjualan`) VALUES
(1, 'SUPERADMIN', 'ya', 'ya', NULL, NULL, NULL, NULL, NULL, 'ya', 'ya', NULL, NULL, NULL, 'ya', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', ''),
(2, 'MANAGER', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', ''),
(3, 'ADMIN', 'ya', NULL, 'ya', 'ya', 'ya', 'ya', 'ya', NULL, NULL, 'ya', 'ya', 'ya', '', 'ya', '', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', 'ya', NULL, '', '', ''),
(4, 'TEKNISI', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', ''),
(5, 'GUDANG', 'ya', NULL, '', '', '', 'ya', 'ya', '', '', 'ya', '', '', '', '', 'ya', '', '', '', '', '', '', '', '', NULL, NULL, 'ya', 'ya', 'ya'),
(6, 'KASIR', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', 'ya', '', '', '', '', '', '', '', '', '', NULL, NULL, '', '', ''),
(7, 'KA_TEKNISI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', NULL, 'ya', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_penerimaan`
--

CREATE TABLE `tbl_detail_penerimaan` (
  `id` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '1 = BAIK, 2= RUSAK, 3 = TIDAK ADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_penerimaan`
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
(71, 9, 'Sepion Depan', 1),
(72, 10, 'Automatic Light Switch', 1),
(73, 10, 'High Beam', 1),
(74, 10, 'Low Bean', 1),
(75, 10, 'Lampu Kecil', 1),
(76, 10, 'Lampu Sign Depan', 1),
(77, 11, 'Automatic Light Switch', 1),
(78, 11, 'High Beam', 1),
(79, 11, 'Low Bean', 1),
(80, 11, 'Lampu Kecil', 1),
(81, 11, 'Lampu Sign Depan', 1),
(82, 12, 'Automatic Light Switch', 1),
(83, 12, 'High Beam', 1),
(84, 12, 'Low Bean', 1),
(85, 12, 'Lampu Kecil', 1),
(86, 12, 'Lampu Sign Depan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_final_check`
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
-- Dumping data untuk tabel `tbl_final_check`
--

INSERT INTO `tbl_final_check` (`id`, `id_perintah_kerja`, `penemuan_saran`, `kebersihan_kendaraan_dalam`, `kebersihan_kendaraan_luar`, `kelengkapan_kendaraan`, `part_bekas`, `status`) VALUES
(1, 1, '', 1, 1, 0, 0, 1),
(2, 2, 'mantap', 1, 1, 1, 1, 1),
(3, 3, '', 1, 1, 0, 0, 1),
(4, 4, '', 1, 1, 0, 0, 1),
(5, 5, '', 1, 1, 0, 0, 1),
(6, 6, '', 1, 1, 0, 0, 1),
(7, 7, '', 1, 1, 0, 0, 1),
(8, 8, 'Sudah Selesai', 1, 1, 0, 0, 1),
(9, 9, '', 1, 1, 0, 0, 1),
(10, 11, '', 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_info_bengkel`
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
-- Dumping data untuk tabel `tbl_info_bengkel`
--

INSERT INTO `tbl_info_bengkel` (`id`, `nama_pemilik`, `no_npwp`, `no_telepon`, `alamat`, `foto`) VALUES
('7554478975', 'BENGKEL BUDI', '78473886388377938', '082386283363', 'LUBUK PAKAM', '1591180612Logo_7554478975.jpg'),
('BK001', 'Bengkel Boss', '999888777', '08116002222', 'Jl. Iskandar Muda No.79', '1591180652Logo_BK001.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori_spare_part`
--

CREATE TABLE `tbl_kategori_spare_part` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kategori_spare_part`
--

INSERT INTO `tbl_kategori_spare_part` (`id`, `id_bengkel`, `kategori`) VALUES
(2, 'BK001', 'Spion'),
(3, 'BK001', 'Wiper'),
(4, 'BK001', 'Velg'),
(5, 'BK001', 'Lampu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keluhan_permintaan`
--

CREATE TABLE `tbl_keluhan_permintaan` (
  `id` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_keluhan_permintaan`
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
(10, 8, 'Keluhan', 'hygygy'),
(11, 10, 'Keluhan', 'Mesin Kasar'),
(12, 11, 'Keluhan', 'Mesin Kasar'),
(13, 12, 'Keluhan', 'Mesin Berisik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kondisi_kendaraan`
--

CREATE TABLE `tbl_kondisi_kendaraan` (
  `id` int(11) NOT NULL,
  `id_bengkel` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kondisi_kendaraan`
--

INSERT INTO `tbl_kondisi_kendaraan` (`id`, `id_bengkel`, `keterangan`) VALUES
(1, 'BK001', 'Automatic Light Switch'),
(2, 'BK001', 'High Beam'),
(3, 'BK001', 'Low Bean'),
(4, 'BK001', 'Lampu Kecil'),
(5, 'BK001', 'Lampu Sign Depan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_library_service`
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
-- Dumping data untuk tabel `tbl_library_service`
--

INSERT INTO `tbl_library_service` (`id`, `id_bengkel`, `kode_service`, `service`, `keterangan`, `biaya`, `tipe_keuntungan`, `nilai_keuntungan`, `persen`) VALUES
(2, 'BK001', 'SERVICE-1592812236', 'service ab', 'afsba asdbnsa sadbasnd', 10000, 0, 14, 14),
(3, 'BK001', 'SERVICE-1589739830', 'service dengan sepenuh hati', 'tanpa neko neko yang terbaik lah diberikan pada anda semua', 200000, 0, 20, 20),
(4, 'BK001', 'SERVICE-1589788255', 'ganti ban external', 'mekanik external', 50000, 0, 15, 15),
(5, 'BK001', 'SERVICE-1589843316', 'Service Mobil Fortuner', 'service full', 950000, 0, 20, 20),
(6, 'BK001', 'SERVICE-1589843556', 'Ganti Spearpart', 'ganti spearpart all', 90000, 0, 20, 20),
(7, 'BK001', 'SERVICE-1590426134', 'baru nominal', '2 ribu aja keuntungannya', 10000, 1, 2000, 0),
(8, 'BK001', 'SERVICE-1590426881', 'baru persen', 'keuntungan baru dalam persen', 50000, 0, 10, 0),
(9, 'BK001', 'SERVICE-1590483653', 'Service plus plus', 'service internal', 0, 1, 100000, 0),
(10, 'BK001', 'SERVICE-1590553285', 'service plus extr', 'external', 100000, 0, 25, 0),
(11, 'BK001', 'SERVICE-1592801552', '12121', 'oke', 10000, 0, 10, 0),
(12, 'BK001', 'SERVICE-1592815506', 'service roda', 'service roda', 550000, 0, 20, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_notifikasi`
--

CREATE TABLE `tbl_notifikasi` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_notifikasi`
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
(9, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(10, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(11, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0),
(12, 'Hai, Jepri Naibaho', 'Ada Spare-Part Yang mau diambil Teknisi, Siapin yah :)', 5, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id`, `id_user`, `nip`, `nama`) VALUES
(1, 2, '111', 'Anita'),
(2, 3, '123456', 'Joy Marubah'),
(3, 4, '222222', 'Tio Tizardi'),
(4, 5, '991199', 'Jepri Naibaho'),
(5, 14, '22137048', 'juki marzuki'),
(6, 15, '9991919', 'atep suratep'),
(7, 16, '001919', 'robin salim'),
(8, 17, '71482401', 'mega kasir'),
(9, 20, '00000', 'Mr. Supriadi'),
(10, 21, '987667777', 'caca'),
(11, 22, '99887737626', 'andi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id` int(11) NOT NULL,
  `idBengkel` char(100) NOT NULL,
  `nomorTransaksi` char(250) NOT NULL,
  `idVendor` int(10) NOT NULL,
  `tunai` int(10) NOT NULL,
  `statusBelanja` char(7) NOT NULL DEFAULT 'pending' COMMENT 'pending, selesai, batal',
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id`, `idBengkel`, `nomorTransaksi`, `idVendor`, `tunai`, `statusBelanja`, `waktu`) VALUES
(1, '', 'nandetigan', 264, 67000, 'batal', '2020-07-06 23:20:31'),
(2, '', 'B002640002', 264, 610000, 'selesai', '2020-07-08 12:03:40'),
(3, '', '', 0, 0, 'batal', '2020-07-08 12:26:02'),
(4, '', '', 0, 0, 'pending', '2020-07-08 12:26:07'),
(5, '', '', 0, 0, 'pending', '2020-07-08 12:26:12'),
(6, '', '', 0, 0, 'pending', '2020-07-08 12:26:23'),
(7, '', '', 0, 0, 'pending', '2020-07-08 12:26:38'),
(8, '', '', 0, 0, 'pending', '2020-07-08 12:27:12'),
(9, '', '', 0, 0, 'pending', '2020-07-08 12:27:37'),
(10, '', '', 0, 0, 'pending', '2020-07-08 12:27:56'),
(11, '', '', 0, 0, 'pending', '2020-07-08 12:37:30'),
(12, '', '', 0, 0, 'pending', '2020-07-08 13:01:59'),
(13, '', '', 0, 0, 'pending', '2020-07-08 22:02:26'),
(14, '', '', 0, 0, 'pending', '2020-07-08 22:08:33'),
(15, '', '', 0, 0, 'pending', '2020-07-08 22:09:12'),
(16, '', '', 0, 0, 'pending', '2020-07-08 22:11:22'),
(17, '', '', 0, 0, 'pending', '2020-07-08 22:11:43'),
(18, '', '', 0, 0, 'pending', '2020-07-08 22:17:42'),
(19, '', 'B002640019', 264, 10000, 'selesai', '2020-07-08 22:20:58'),
(20, '', '', 0, 0, 'pending', '2020-07-08 22:34:43'),
(21, '', '', 0, 0, 'batal', '2020-07-08 22:50:30'),
(22, 'BK001', 'B002640022', 264, 14000, 'selesai', '2020-07-09 20:31:40'),
(23, 'BK001', 'B002640023', 264, 14000, 'selesai', '2020-07-09 20:51:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian_item`
--

CREATE TABLE `tbl_pembelian_item` (
  `id` int(11) NOT NULL,
  `idPembelian` int(11) NOT NULL,
  `idProduk` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pembelian_item`
--

INSERT INTO `tbl_pembelian_item` (`id`, `idPembelian`, `idProduk`, `harga`, `diskon`, `quantity`) VALUES
(1, 1, 1, 5000, 500, 13),
(2, 1, 2, 4500, 500, 11),
(5, 2, 3, 10000, 0, 1),
(6, 2, 1, 600000, 0, 1),
(7, 3, 2, 10000, 0, 1),
(8, 5, 2, 10000, 0, 1),
(9, 6, 2, 10000, 0, 1),
(10, 8, 2, 10000, 0, 1),
(13, 19, 2, 10000, 0, 1),
(14, 21, 3, 10000, 0, 1),
(18, 22, 3, 7000, 0, 1),
(19, 22, 2, 7000, 0, 1),
(20, 23, 2, 7000, 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penerimaan`
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
-- Dumping data untuk tabel `tbl_penerimaan`
--

INSERT INTO `tbl_penerimaan` (`id`, `id_bengkel`, `id_admin`, `nama_pemilik`, `email_pemilik`, `alamat_pemilik`, `telepon_pemilik`, `no_pkb`, `no_polisi`, `no_rangka`, `no_mesin`, `tipe_warna`, `tahun_produksi`, `kilometer`, `bahan_bakar`, `tgl_penerimaan`, `tgl_transaksi`, `bayar`, `kembalian`, `diskon`, `diskon_service`, `diskon_sparepart`, `ppn`, `status`) VALUES
(1, 'BK001', 10, 'Budi Liliyanto', 'budililiyanto@gmail.com', 'Medan', '082386283363', 'BK001-1589947273', 'BK 3396', '98339JH9893', '783728826382762', 'FORTUNER,HITAM', 2020, 30000, 1, '2020-05-20 11:01:44', '2020-05-20 11:09:38', 1850000, 5300, 0, 5, 1, 0, 3),
(2, 'BK001', 10, 'JONI', 'JONI@GMAIL.COM', 'Medan', '082386283363', 'BK001-1590421875', 'BK 000 TO', '9976ghhgf64666', '32423423223', 'FORTUNER,HITAM', 2020, 3000, 1, '2020-05-25 22:51:44', '2020-05-26 01:13:50', 1393700, 3685, 0, 5, 0, 0, 3),
(3, 'BK001', 10, 'Alma', 'alma@gmail.com', 'Medan', '083167098372', 'BK001-1590483701', 'bk 998 ty', '980828TY8638IX7', '783728826382762', 'FORTUNER,HITAM', 2020, 20000, 1, '2020-05-26 16:02:30', '2020-05-26 16:07:13', 2860000, 0, 0, 0, 0, 0, 3),
(4, 'BK001', 10, 'DIDIN', 'DIDIN@GMAIL.COM', 'JAMBI', '081176283749', 'BK001-1590552532', 'BH 987 TI', '3736648736CDJ3739', '848379MND304848', 'FORTUNER, PUTIH', 2020, 20000, 1, '2020-05-27 11:09:58', '2020-05-27 11:13:25', 880000, 0, 0, 0, 0, 0, 3),
(5, 'BK001', 10, 'NANI', 'NANI@GMAIL.COM', 'MEDAN', '082160640970', 'BK001-1590552908', 'BK 987 IO', '83874DHHBDH2639WJ', 'HH3842776DJND33', 'AVANZA, HITAM', 2020, 20000, 1, '2020-05-27 11:16:03', '2020-05-27 11:18:58', 770000, 0, 0, 0, 0, 0, 3),
(6, 'BK001', 10, 'ZIKRI', 'ZIKRI@GMAIL.COM', 'MEDAN', '0987566252525', 'BK001-1590553302', 'BK 876 TO', '566252775GGGSG2526', '76227766SGW62627', 'AVANZA, SILVER', 2020, 20000, 1, '2020-05-27 11:22:41', '2020-05-27 11:27:57', 760000, 5125, 0, 7, 5, 0, 3),
(7, 'BK001', 10, 'Budi Liliyanto', 'budililiyanto@gmail.com', 'Medan', '082386283363', 'BK001-1590811406', 'BK 3396', '980828TY8638IX7', '3434433HD77888', 'FORTUNER,HITAM', 2020, 2000, 1, '2020-05-30 11:04:19', '2020-05-30 11:09:54', 730000, 6750, 0, 0, 0, 0, 3),
(8, 'BK001', 10, 'Budi Sari', 'budililiyanto@gmail.com', 'medan', '082386283363', 'BK001-1591079849', 'BK 97 AO', '980828TY8638IX7', '3434433HD77888', 'FORTUNER,PUTIH', 2020, 20000, 1, '2020-06-02 13:37:54', '2020-06-22 16:10:33', 2775000, 3000, 0, 0, 5, 0, 3),
(9, 'BK001', 10, 'Pak Gultom', 'gultom@gmail.com', 'Medan', '08366372883', 'BK001-1591180705', 'BK 99 TO', '883772J73992EJ3', '9983JEE8399928', 'FORTUNER,PUTIH', 2019, 40000, 1, '2020-06-03 17:39:41', '2020-06-03 18:20:47', 740000, 6300, 0, 3, 5, 0, 3),
(10, 'BK001', 10, 'joko', 'joko@gmail.com', 'Medan', '082160640973', 'BK001-1592815820', 'BK 88 TO', '8756654433', '88649986', 'AVANZA, HITAM', 2020, 19000, 1, '2020-06-22 15:51:16', NULL, 0, 0, 0, 0, 0, 0, 1),
(11, 'BK001', 10, 'zizi', 'zizi@gmail.com', 'Medan', '081370040089', 'BK001-1592815919', 'BK 885 IO', '87754545', '76665455', 'FORTUNER,PUTIH', 2020, 1000, 3, '2020-06-22 15:52:44', '2020-06-22 16:11:52', 1400000, 16750, 0, 0, 0, 0, 3),
(12, 'BK001', 10, 'Pak Timbul', 'timbul@gmail.com', 'Medan', '0872666278367', 'BK001-1592816003', 'BB 9886 IO', '8675655', '7565676767', 'FORTUNER,HITAM', 2020, 10000, 4, '2020-06-22 15:54:03', NULL, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id` int(11) NOT NULL,
  `idBengkel` char(100) NOT NULL,
  `nomorTransaksi` char(250) NOT NULL,
  `diskon` int(10) NOT NULL,
  `statusPenjualan` char(7) NOT NULL COMMENT 'pending, selesai, batal',
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id`, `idBengkel`, `nomorTransaksi`, `diskon`, `statusPenjualan`, `waktu`) VALUES
(1, 'BK001', 'NandeKaroRasBereTigan', 500, 'pending', '2020-07-09 21:28:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan_item`
--

CREATE TABLE `tbl_penjualan_item` (
  `id` int(11) NOT NULL,
  `idPenjualan` int(10) NOT NULL,
  `idProduk` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `diskon` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_penjualan_item`
--

INSERT INTO `tbl_penjualan_item` (`id`, `idPenjualan`, `idProduk`, `harga`, `diskon`, `quantity`) VALUES
(1, 1, 1, 4500, 500, 10),
(2, 1, 2, 4500, 100, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perintah_kerja`
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
-- Dumping data untuk tabel `tbl_perintah_kerja`
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
(9, 8, 10, 'Erc', 'Ditunggu', '2020-06-12 14:43:56', '2020-06-13 14:25:56', 4, 5, 1, 1, ''),
(10, 12, 10, 'ERC', 'Ditunggu', '2020-06-22 15:54:49', '2020-06-22 22:55:49', 21, 5, 1, 1, ''),
(11, 11, 10, 'ERC', 'Ditunggu', '2020-06-22 15:58:51', '2020-06-22 15:55:51', 16, 5, 1, 1, ''),
(12, 10, 10, 'ERC', 'Ditunggu', '2020-06-22 16:00:11', '2020-06-22 23:45:11', 3, 5, 1, 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_spare_part`
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
-- Dumping data untuk tabel `tbl_spare_part`
--

INSERT INTO `tbl_spare_part` (`id`, `kode_barang`, `id_bengkel`, `kategori`, `nama`, `harga_beli`, `harga_jual`, `stok`, `temp`, `tgl_input`) VALUES
(1, '1589730236', 'BK005', 'Lampu', 'Lampu Low Beam Multifungsi', 300000, 600000, 76, 3, '2020-05-17 22:43:56'),
(2, '1594005306', 'BK001', 'Wiper', 'Cimpa Nande Tigan', 7000, 10000, 83, 0, '2020-07-06 10:15:06'),
(3, '1594008288', 'BK001', 'Lampu', 'medan', 7000, 10000, 8, 0, '2020-07-06 11:04:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi_spare_part`
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
-- Dumping data untuk tabel `tbl_transaksi_spare_part`
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
(9, 9, 1, 4, 'tgtg', 1),
(10, 10, 1, 2, 'yy', 1),
(11, 11, 1, 2, 'uy', 1),
(12, 12, 1, 1, 'gy', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_uraian_pekerjaan`
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
-- Dumping data untuk tabel `tbl_uraian_pekerjaan`
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
(10, 8, 9, 'service internal', 0, 0, 1, 100000, 0, 1),
(11, 9, 3, 'tanpa neko neko yang terbaik lah diberikan pada anda semua', 0, 200000, 0, 20, 0, 1),
(12, 10, 12, 'service roda', 0, 550000, 0, 20, 0, 0),
(13, 11, 4, 'mekanik external', 0, 50000, 0, 15, 0, 1),
(14, 12, 8, 'keuntungan baru dalam persen', 0, 50000, 0, 10, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
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
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_bengkel`, `username`, `password`, `role_user`, `remember_token`, `firebase_token`) VALUES
(1, '-', 'admin', '$2y$10$aseXR2mDPIv63xz7ewI4N.R8EDP/3asA4f2jh6LP9DtropsEisNNu', 'SUPERADMIN', '', 'ehdyisnbvchsadbcjsd'),
(3, 'BK001', 'joy', '$2y$10$RvgzeMxS7etQ.hOrsUkr0.IdI4xUDL6cDQblBlkJjWLZKeZPatSEi', 'TEKNISI', '', 'cOoPwhP-SYSqddAh4VJDq9:APA91bEz-vsXH_UP4ch0FYzUys2GUBC4MEVEUJdLaTzrDFJjVqqT4qHNzoq1W_PIZ0PKL2vo84mML287DxBx89mCuEfJpwq8C1V6ZftWgJU37du22mV6SokljbMtdvpyc97TRGgtDUQx'),
(4, 'BK001', 'tio', '$2y$10$aseXR2mDPIv63xz7ewI4N.R8EDP/3asA4f2jh6LP9DtropsEisNNu', 'TEKNISI', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNTkyNzk3NDkyLCJpZCI6IjQiLCJpZF9iZW5na2VsIjoiQkswMDEiLCJ1c2VybmFtZSI6InRpbyIsIm5hbWEiOiJUaW8gVGl6YXJkaSIsInJvbGVfdXNlciI6IlRFS05JU0kifQ.GzkfbFrrTPTzIknP4khF8Gs3B03oo2fd2DImjDmmZTo', 'dVtHKMFFQnOQXVyLPAN6js:APA91bE-tmcGTcLkNVoG-lz4CheITs-bXiUU1wT4jFoajWocgMZfJt1suVugTRpUxlptfeP4YEd78dMhkVFAnbp12qGiJPid0wdgNK2kcybU6f-uDDPa2FolkdIxWNZgG1qr5BDhDYpu'),
(5, 'BK001', 'Jepri', '$2y$10$hkkN4Tm6EWpmM/WRiPyOZej3riL8VDo.WbgQSaCHFjDe6uprWAT2q', 'GUDANG', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0aW1lIjoxNTg4MDU0MDc4LCJpZCI6IjUiLCJpZF9iZW5na2VsIjoiQkswMDEiLCJ1c2VybmFtZSI6IkplcHJpIiwibmFtYSI6IkplcHJpIE5haWJhaG8iLCJyb2xlX3VzZXIiOiJHVURBTkcifQ.4aVviMGXRjCg1sLMs3l7xUWynQMgn-qtK10ufiEb_UQ', 'daTsTY8-Te2RjqMeGojNzO:APA91bHSE_qZ-gNGwnW_cDI3BeHN_zbtbXN9fN6N1IqyaQv2TGxzcuIwF_AnCQMaFI5m_E6KB-uc3fDjxXpUGsjstJoeB7iOth3FCovX6SfWwgtSgy8oeu9tTz4FL-iRg9FsfKDsfDwr'),
(10, 'BK001', 'anita', '$2y$10$pNFLU9dbCWsZZL5DHJfZ1efOtpYHqx.5zmhUtEMlp6cUvj/Aqr2FO', 'ADMIN', '', ''),
(11, 'BK001', 'rey', '$2y$10$wtb/Vf4GQQ4.tn2tm9Vz1.ZdzX4lyNw5mxrBlMLCWXnIGaS0VJBjG', 'MANAGER', '', 'dVtHKMFFQnOQXVyLPAN6js:APA91bE-tmcGTcLkNVoG-lz4CheITs-bXiUU1wT4jFoajWocgMZfJt1suVugTRpUxlptfeP4YEd78dMhkVFAnbp12qGiJPid0wdgNK2kcybU6f-uDDPa2FolkdIxWNZgG1qr5BDhDYpu'),
(12, 'BK002', 'cika', '$2y$10$VNuvZxUGakxNoMzOIaWjIe.ovCM.fCPq1R5W7tlt76gvdW2JO/98S', 'MANAGER', '', ''),
(13, 'BK002', 'linda', '$2y$10$hkkN4Tm6EWpmM/WRiPyOZej3riL8VDo.WbgQSaCHFjDe6uprWAT2q', 'ADMIN', '', ''),
(14, 'BK002', 'juki', '$2y$10$8E6FLnbg/z89uTFazMCcAOhXjsqmkPkddvbEjIt88dpvPVVcXmBKe', 'TEKNISI', '', ''),
(15, 'BK002', 'atep', '$2y$10$1HfEsmVkBrhU/jT1g1fBYOSnffpyKmcKVrkEhx/uFb3elGJxWVyGK', 'GUDANG', '', ''),
(16, 'BK001', 'robin', '$2y$10$hzrLAQl5jM94sV8szuGV2.OA4pa8xTnIxirC4HPwnmD76SqRnhdYe', 'TEKNISI', '', ''),
(17, 'BK001', 'mega', '$2y$10$pNFLU9dbCWsZZL5DHJfZ1efOtpYHqx.5zmhUtEMlp6cUvj/Aqr2FO', 'KASIR', '', ''),
(18, '7554478975', 'budi', '$2y$10$LW/FNMhnbtcSjoTrmVyl0efPKHR92Wos06B3coD17J9GFVAwuUQJu', 'ADMIN', '', ''),
(19, '7554478975', 'joko', '$2y$10$fiq5q0Iz1klBfRfaOyH12eIC/.fDIsAtfGnr/JHMspYx3ZvM8i/iC', 'MANAGER', '', 'cVXwb_z3QMea85T169vwdR:APA91bHWmi-nL7VeczdZ5LcuAnIER2uB8-ktcalVwWgkuK92xDIUhEXMJH-F7Ok6CglMCW84kLAcdQ7ejWAgqXu3PJMMnM8XfAYZlvp6f-QyrEIuJYIa9TLizVDLYzeL0PC1qeg8R5Yo'),
(20, 'BK001', 'Supriadi', '$2y$10$lYBLSWLzfqGsqayKR6ig0.86X3tCN/7n.ZSnNYPVby1u/9rkArdEW', 'KA_TEKNISI', '', ''),
(21, 'BK001', 'caca', '$2y$10$oCB2y.t9rvMMuqcegWeWnOxD.KnswIV6Ea3VPbgd92IfOKYQLOwtK', 'TEKNISI', '', ''),
(22, 'BK001', 'andi', '$2y$10$Rvg.3JE/e5WYDOOMINwLlOHAoUb1dE/n344nnweaC3JgWtBFkihAK', 'TEKNISI', '', ''),
(23, 'BK001', 'falentinodjoka2801', '487ff2d43f052defb561b1cfc8062a01', 'GUDANG', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_vendor`
--

CREATE TABLE `tbl_vendor` (
  `id` int(11) NOT NULL,
  `nama` char(150) NOT NULL,
  `alamat` char(250) NOT NULL,
  `telepon` char(15) NOT NULL,
  `email` char(100) NOT NULL,
  `lamanWeb` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`id`, `nama`, `alamat`, `telepon`, `email`, `lamanWeb`) VALUES
(2, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(8, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(10, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(11, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(12, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(13, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(14, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(15, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(16, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(17, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(18, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(19, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(20, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(21, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(22, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(23, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(24, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(25, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(26, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(27, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(28, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(29, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(30, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(31, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(32, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(33, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(34, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(35, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(36, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(37, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(38, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(39, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(40, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(41, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(42, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(43, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(44, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(45, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(46, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(47, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(48, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(49, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(50, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(51, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(52, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(53, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(54, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(55, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(56, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(57, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(58, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(59, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(60, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(61, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(62, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(63, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(64, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(65, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(66, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(67, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(68, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(69, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(70, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(71, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(72, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(73, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(74, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(75, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(76, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(77, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(78, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(79, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(80, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(81, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(82, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(83, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(84, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(85, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(86, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(87, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(88, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(89, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(90, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(91, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(92, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(93, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(94, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(95, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(96, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(97, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(98, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(99, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(100, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(101, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(102, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(103, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(104, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(105, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(106, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(107, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(108, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(109, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(110, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(111, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(112, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(113, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(114, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(115, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(116, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(117, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(118, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(119, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(120, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(121, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(122, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(123, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(124, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(125, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(126, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(127, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(128, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(129, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(130, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(131, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(132, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(133, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(134, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(135, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(136, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(137, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(138, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(139, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(140, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(141, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(142, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(143, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(144, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(145, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(146, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(147, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(148, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(149, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(150, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(151, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(152, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(153, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(154, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(155, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(156, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(157, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(158, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(159, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(160, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(161, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(162, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(163, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(164, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(165, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(166, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(167, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(168, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(169, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(170, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(171, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(172, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(173, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(174, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(175, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(176, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(177, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(178, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(179, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(180, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(181, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(182, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(183, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(184, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(185, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(186, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(187, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(188, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(189, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(190, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(191, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(192, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(193, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(194, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(195, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(196, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(197, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(198, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(199, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(200, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(201, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(202, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(203, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(204, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(205, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(206, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(207, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(208, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(209, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(210, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(211, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(212, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(213, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(214, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(215, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(216, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(217, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(218, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(219, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(220, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(221, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(222, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(223, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(224, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(225, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(226, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(227, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(228, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(229, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(230, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(231, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(232, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(233, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(234, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(235, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(236, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(237, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(238, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(239, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(240, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(241, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(242, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(243, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(244, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(245, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(246, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(247, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(248, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(249, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(250, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(251, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(252, 'nande biring', 'Jl. Bahagia', '081933306903', 'nandebiring@gmail.com', 'nandebiring.com'),
(253, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(255, 'Nande Tigan', 'Jl. Bahagia', '081533306905', 'nandetigan@gmail.com', 'nandetigan.com'),
(264, 'Eren Sinulingga', 'Medan', '091432434', 'falentinodjoka2801@gmail.com', 'erensinulingga.com.ID');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_batasan_akses`
--
ALTER TABLE `tbl_batasan_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_detail_penerimaan`
--
ALTER TABLE `tbl_detail_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_final_check`
--
ALTER TABLE `tbl_final_check`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_info_bengkel`
--
ALTER TABLE `tbl_info_bengkel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kategori_spare_part`
--
ALTER TABLE `tbl_kategori_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_keluhan_permintaan`
--
ALTER TABLE `tbl_keluhan_permintaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kondisi_kendaraan`
--
ALTER TABLE `tbl_kondisi_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_library_service`
--
ALTER TABLE `tbl_library_service`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pembelian_item`
--
ALTER TABLE `tbl_pembelian_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_penerimaan`
--
ALTER TABLE `tbl_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_penjualan_item`
--
ALTER TABLE `tbl_penjualan_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_perintah_kerja`
--
ALTER TABLE `tbl_perintah_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_spare_part`
--
ALTER TABLE `tbl_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_transaksi_spare_part`
--
ALTER TABLE `tbl_transaksi_spare_part`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_uraian_pekerjaan`
--
ALTER TABLE `tbl_uraian_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_batasan_akses`
--
ALTER TABLE `tbl_batasan_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_penerimaan`
--
ALTER TABLE `tbl_detail_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `tbl_final_check`
--
ALTER TABLE `tbl_final_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori_spare_part`
--
ALTER TABLE `tbl_kategori_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_keluhan_permintaan`
--
ALTER TABLE `tbl_keluhan_permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_kondisi_kendaraan`
--
ALTER TABLE `tbl_kondisi_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_library_service`
--
ALTER TABLE `tbl_library_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_notifikasi`
--
ALTER TABLE `tbl_notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian_item`
--
ALTER TABLE `tbl_pembelian_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_penerimaan`
--
ALTER TABLE `tbl_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualan_item`
--
ALTER TABLE `tbl_penjualan_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_perintah_kerja`
--
ALTER TABLE `tbl_perintah_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_spare_part`
--
ALTER TABLE `tbl_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi_spare_part`
--
ALTER TABLE `tbl_transaksi_spare_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_uraian_pekerjaan`
--
ALTER TABLE `tbl_uraian_pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tbl_vendor`
--
ALTER TABLE `tbl_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
