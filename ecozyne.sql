-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2025 at 03:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecozyne`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id_alamat` bigint UNSIGNED NOT NULL,
  `id_kelurahan` bigint UNSIGNED NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`id_alamat`, `id_kelurahan`, `alamat`, `kode_pos`, `created_at`, `updated_at`) VALUES
(1, 2, 'Bida Asri 2', '26504', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(2, 3, 'Perumahan Kda', '12345', '2025-07-12 15:13:26', '2025-07-12 15:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_sampah`
--

CREATE TABLE `bank_sampah` (
  `id_bank_sampah` bigint UNSIGNED NOT NULL,
  `id_pengajuan_bank_sampah` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hadiah`
--

CREATE TABLE `hadiah` (
  `id_hadiah` bigint UNSIGNED NOT NULL,
  `nama_hadiah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int UNSIGNED NOT NULL,
  `point_satuan` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` bigint UNSIGNED NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `kecamatan`, `created_at`, `updated_at`) VALUES
(1, 'batam kota', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(2, 'batu aji', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(3, 'batu ampar', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(4, 'belakang padang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(5, 'bengkong', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(6, 'bulang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(7, 'galang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(8, 'lubuk baja', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(9, 'nongsa', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(10, 'sagulung', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(11, 'sei beduk', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(12, 'sekupang', '2025-07-12 15:13:26', '2025-07-12 15:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kouta` int UNSIGNED NOT NULL,
  `tanggal_kegiatan` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kelurahan` bigint UNSIGNED NOT NULL,
  `id_kecamatan` bigint UNSIGNED NOT NULL,
  `kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id_kelurahan`, `id_kecamatan`, `kelurahan`, `created_at`, `updated_at`) VALUES
(1, 1, 'baloi permai', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(2, 1, 'belian', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(3, 1, 'sukajadi', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(4, 1, 'sungai panas', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(5, 1, 'taman baloi', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(6, 1, 'teluk tering', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(7, 2, 'bukit tempayan', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(8, 2, 'buliang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(9, 2, 'kibing', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(10, 2, 'tanjung uncang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(11, 3, 'batu merah', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(12, 3, 'kampung seraya', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(13, 3, 'sungai jodoh', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(14, 3, 'tanjung sengkuang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(15, 4, 'kasu', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(16, 4, 'penccong', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(17, 4, 'pemping', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(18, 4, 'sekanak raya', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(19, 4, 'tanjung sari', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(20, 4, 'pulau terong', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(21, 5, 'bengkong indah', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(22, 5, 'bengkong laut', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(23, 5, 'sadai', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(24, 5, 'tanjung buntung', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(25, 6, 'batu lengong', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(26, 6, 'bulang lintang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(27, 6, 'pantai gelam', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(28, 6, 'pulau buluh', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(29, 6, 'setokok', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(30, 6, 'temoyong', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(31, 7, 'air raja', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(32, 7, 'galang baru', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(33, 7, 'karas', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(34, 7, 'pulau abang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(35, 7, 'rempang cate', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(36, 7, 'sembulang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(37, 7, 'sijantung', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(38, 7, 'subung mas', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(39, 8, 'baloi indah', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(40, 8, 'batu selicin', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(41, 8, 'kampung pelita', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(42, 8, 'lubuk baja kota', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(43, 8, 'tanjung uma', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(44, 9, 'batu besar', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(45, 9, 'kabil', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(46, 9, 'ngenang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(47, 9, 'sambau', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(48, 10, 'sagulung kota', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(49, 10, 'sungai binti', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(50, 10, 'sungai langkai', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(51, 10, 'sungai lekop', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(52, 10, 'sungai pelunggut', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(53, 10, 'tembesi', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(54, 11, 'duriangkang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(55, 11, 'mangsang', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(56, 11, 'muka kuning', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(57, 11, 'tanjung piayu', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(58, 12, 'patam lestari', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(59, 12, 'sungai harapan', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(60, 12, 'tanjung pinggir', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(61, 12, 'tanjung riau', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(62, 12, 'tiban baru', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(63, 12, 'tiban lama', '2025-07-12 15:13:26', '2025-07-12 15:13:26'),
(64, 12, 'tiban indah', '2025-07-12 15:13:26', '2025-07-12 15:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE `komunitas` (
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `id_alamat` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id_komunitas`, `id_user`, `id_alamat`, `nama`, `no_telp`, `foto`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'nabil', '082385142237', 'https://api.dicebear.com/9.x/initials/svg?seed=na', '2025-07-12 15:13:27', '2025-07-12 15:13:27'),
(2, 3, 2, 'justine', '096788888888', 'https://api.dicebear.com/9.x/initials/svg?seed=ju', '2025-07-12 15:13:27', '2025-07-12 15:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_02_141732_create_kecamatans_table', 1),
(5, '2025_02_03_141442_create_kelurahans_table', 1),
(6, '2025_03_01_140738_create_alamats_table', 1),
(7, '2025_03_18_100054_create_komunitas_table', 1),
(8, '2025_03_28_141010_create_artikel_table', 1),
(9, '2025_04_11_021300_create_galeri_table', 1),
(10, '2025_04_11_155839_create_kegiatan_table', 1),
(11, '2025_04_12_065329_create_hadiah_table', 1),
(12, '2025_04_24_145104_create_pengajuan_bank_sampahs_table', 1),
(13, '2025_04_24_150438_create_bank_sampahs_table', 1),
(14, '2025_04_24_151101_create_transaksi_sampahs_table', 1),
(15, '2025_04_24_153124_create_produks_table', 1),
(16, '2025_04_24_154553_create_pesanans_table', 1),
(17, '2025_04_24_155002_create_transaksi_produks_table', 1),
(18, '2025_04_24_161408_create_penukarans_table', 1),
(19, '2025_04_24_161756_create_transaksi_penukarans_table', 1),
(20, '2025_04_25_022441_create_points_table', 1),
(21, '2025_05_01_124346_create_pendaftaran_kegiatans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_kegiatan`
--

CREATE TABLE `pendaftaran_kegiatan` (
  `id_pendaftaran_kegiatan` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `id_kegiatan` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_bank_sampah`
--

CREATE TABLE `pengajuan_bank_sampah` (
  `id_pengajuan_bank_sampah` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `nama_bank_sampah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `lokasi_bank_sampah` text COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `status` enum('diproses','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penukaran`
--

CREATE TABLE `penukaran` (
  `id_penukaran` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `status_penukaran` enum('menunggu','diterima','ditolak','dikemas','dikirim','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `id_bank_sampah` bigint UNSIGNED NOT NULL,
  `status_pesanan` enum('menunggu','diterima','ditolak','dikemas','dikirim','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `status_pembayaran` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `id_point` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `point` int UNSIGNED NOT NULL,
  `expired_point` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`id_point`, `id_komunitas`, `point`, `expired_point`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2026-07-12', '2025-07-12 15:13:27', '2025-07-12 15:13:27'),
(2, 2, 0, '2026-07-12', '2025-07-12 15:13:27', '2025-07-12 15:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_bank_sampah` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(12,0) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penukaran`
--

CREATE TABLE `transaksi_penukaran` (
  `id_transaksi_penukaran` bigint UNSIGNED NOT NULL,
  `id_penukaran` bigint UNSIGNED NOT NULL,
  `id_hadiah` bigint UNSIGNED NOT NULL,
  `jumlah` int UNSIGNED NOT NULL,
  `point_satuan` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id_transaksi_produk` bigint UNSIGNED NOT NULL,
  `id_pesanan` bigint UNSIGNED NOT NULL,
  `id_produk` bigint UNSIGNED NOT NULL,
  `jumlah` int UNSIGNED NOT NULL,
  `harga` decimal(12,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_sampah`
--

CREATE TABLE `transaksi_sampah` (
  `id_transaksi_sampah` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `id_bank_sampah` bigint UNSIGNED NOT NULL,
  `berat_sampah` decimal(8,2) UNSIGNED NOT NULL,
  `point_didapat` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$12$OQYlpmWoYCokAzAD4BXFJe.pqoOnvrYhV5sungSgrTR5Ft4sQs.DC', 'admin', '2025-07-12 15:13:27', '2025-07-12 15:13:27'),
(2, 'nabil', 'nabiladitya2203@gmail.com', '$2y$12$6hwZQPybQy2s1bUNGgF3v.klft8A6unCG8Xf1UikIx7qvFHA1SPYu', 'komunitas', '2025-07-12 15:13:27', '2025-07-12 15:13:27'),
(3, 'justine', 'justine@gmail.com', '$2y$12$Kh3l68CsqZdgVJnS4b5oQ.Pb.W4QtMo6DSWiZpLiisEOA14KUKy7G', 'komunitas', '2025-07-12 15:13:27', '2025-07-12 15:13:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `alamat_id_kelurahan_foreign` (`id_kelurahan`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  ADD PRIMARY KEY (`id_bank_sampah`),
  ADD KEY `bank_sampah_id_pengajuan_bank_sampah_foreign` (`id_pengajuan_bank_sampah`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id_hadiah`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`),
  ADD KEY `kelurahan_id_kecamatan_foreign` (`id_kecamatan`);

--
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id_komunitas`),
  ADD UNIQUE KEY `komunitas_no_telp_unique` (`no_telp`),
  ADD KEY `komunitas_id_user_foreign` (`id_user`),
  ADD KEY `komunitas_id_alamat_foreign` (`id_alamat`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pendaftaran_kegiatan`
--
ALTER TABLE `pendaftaran_kegiatan`
  ADD PRIMARY KEY (`id_pendaftaran_kegiatan`),
  ADD KEY `pendaftaran_kegiatan_id_komunitas_foreign` (`id_komunitas`),
  ADD KEY `pendaftaran_kegiatan_id_kegiatan_foreign` (`id_kegiatan`);

--
-- Indexes for table `pengajuan_bank_sampah`
--
ALTER TABLE `pengajuan_bank_sampah`
  ADD PRIMARY KEY (`id_pengajuan_bank_sampah`),
  ADD KEY `pengajuan_bank_sampah_id_komunitas_foreign` (`id_komunitas`);

--
-- Indexes for table `penukaran`
--
ALTER TABLE `penukaran`
  ADD PRIMARY KEY (`id_penukaran`),
  ADD KEY `penukaran_id_komunitas_foreign` (`id_komunitas`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `pesanan_id_komunitas_foreign` (`id_komunitas`),
  ADD KEY `pesanan_id_bank_sampah_foreign` (`id_bank_sampah`);

--
-- Indexes for table `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`id_point`),
  ADD KEY `point_id_komunitas_foreign` (`id_komunitas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_bank_sampah_foreign` (`id_bank_sampah`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi_penukaran`
--
ALTER TABLE `transaksi_penukaran`
  ADD PRIMARY KEY (`id_transaksi_penukaran`),
  ADD KEY `transaksi_penukaran_id_penukaran_foreign` (`id_penukaran`),
  ADD KEY `transaksi_penukaran_id_hadiah_foreign` (`id_hadiah`);

--
-- Indexes for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id_transaksi_produk`),
  ADD KEY `transaksi_produk_id_pesanan_foreign` (`id_pesanan`),
  ADD KEY `transaksi_produk_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `transaksi_sampah`
--
ALTER TABLE `transaksi_sampah`
  ADD PRIMARY KEY (`id_transaksi_sampah`),
  ADD KEY `transaksi_sampah_id_komunitas_foreign` (`id_komunitas`),
  ADD KEY `transaksi_sampah_id_bank_sampah_foreign` (`id_bank_sampah`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id_alamat` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  MODIFY `id_bank_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id_hadiah` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id_kelurahan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id_komunitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pendaftaran_kegiatan`
--
ALTER TABLE `pendaftaran_kegiatan`
  MODIFY `id_pendaftaran_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_bank_sampah`
--
ALTER TABLE `pengajuan_bank_sampah`
  MODIFY `id_pengajuan_bank_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penukaran`
--
ALTER TABLE `penukaran`
  MODIFY `id_penukaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point`
--
ALTER TABLE `point`
  MODIFY `id_point` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_penukaran`
--
ALTER TABLE `transaksi_penukaran`
  MODIFY `id_transaksi_penukaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id_transaksi_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi_sampah`
--
ALTER TABLE `transaksi_sampah`
  MODIFY `id_transaksi_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_id_kelurahan_foreign` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id_kelurahan`);

--
-- Constraints for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  ADD CONSTRAINT `bank_sampah_id_pengajuan_bank_sampah_foreign` FOREIGN KEY (`id_pengajuan_bank_sampah`) REFERENCES `pengajuan_bank_sampah` (`id_pengajuan_bank_sampah`);

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `kelurahan_id_kecamatan_foreign` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`);

--
-- Constraints for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD CONSTRAINT `komunitas_id_alamat_foreign` FOREIGN KEY (`id_alamat`) REFERENCES `alamat` (`id_alamat`),
  ADD CONSTRAINT `komunitas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pendaftaran_kegiatan`
--
ALTER TABLE `pendaftaran_kegiatan`
  ADD CONSTRAINT `pendaftaran_kegiatan_id_kegiatan_foreign` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`),
  ADD CONSTRAINT `pendaftaran_kegiatan_id_komunitas_foreign` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);

--
-- Constraints for table `pengajuan_bank_sampah`
--
ALTER TABLE `pengajuan_bank_sampah`
  ADD CONSTRAINT `pengajuan_bank_sampah_id_komunitas_foreign` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);

--
-- Constraints for table `penukaran`
--
ALTER TABLE `penukaran`
  ADD CONSTRAINT `penukaran_id_komunitas_foreign` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_id_bank_sampah_foreign` FOREIGN KEY (`id_bank_sampah`) REFERENCES `bank_sampah` (`id_bank_sampah`),
  ADD CONSTRAINT `pesanan_id_komunitas_foreign` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);

--
-- Constraints for table `point`
--
ALTER TABLE `point`
  ADD CONSTRAINT `point_id_komunitas_foreign` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_bank_sampah_foreign` FOREIGN KEY (`id_bank_sampah`) REFERENCES `bank_sampah` (`id_bank_sampah`);

--
-- Constraints for table `transaksi_penukaran`
--
ALTER TABLE `transaksi_penukaran`
  ADD CONSTRAINT `transaksi_penukaran_id_hadiah_foreign` FOREIGN KEY (`id_hadiah`) REFERENCES `hadiah` (`id_hadiah`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_penukaran_id_penukaran_foreign` FOREIGN KEY (`id_penukaran`) REFERENCES `penukaran` (`id_penukaran`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD CONSTRAINT `transaksi_produk_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `transaksi_produk_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `transaksi_sampah`
--
ALTER TABLE `transaksi_sampah`
  ADD CONSTRAINT `transaksi_sampah_id_bank_sampah_foreign` FOREIGN KEY (`id_bank_sampah`) REFERENCES `bank_sampah` (`id_bank_sampah`),
  ADD CONSTRAINT `transaksi_sampah_id_komunitas_foreign` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
