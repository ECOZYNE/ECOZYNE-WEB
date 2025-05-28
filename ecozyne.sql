-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 02:32 PM
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
(1, 1, 'batam jaya', '12345', '2025-05-01 21:21:23', '2025-05-01 21:21:23'),
(2, 7, 'jaya', '12345', '2025-05-01 21:57:00', '2025-05-01 21:57:00'),
(3, 1, 'bida asri 2', '26504', '2025-05-04 04:46:16', '2025-05-04 04:46:16'),
(4, 1, 'bida asri 2 blok h no 9', '29464', '2025-05-06 20:16:20', '2025-05-06 20:16:20'),
(5, 55, 'ded', '12345', '2025-05-06 21:19:03', '2025-05-06 21:19:03'),
(6, 49, 's', '26504', '2025-05-06 21:20:39', '2025-05-06 21:20:39'),
(7, 33, 'feveaefae', '12345', '2025-05-06 21:22:22', '2025-05-06 21:22:22'),
(8, 55, 'bzrrbbrzbssbv', '12345', '2025-05-06 21:23:44', '2025-05-06 21:23:44'),
(9, 1, 'kda', '29464', '2025-05-07 01:04:20', '2025-05-07 01:04:20'),
(10, 1, 'taman baloi', '12345', '2025-05-07 02:24:45', '2025-05-07 02:24:45'),
(11, 2, 'kda raya', '29464', '2025-05-07 05:12:32', '2025-05-07 05:12:32'),
(12, 1, 'bida asri', '12345', '2025-05-20 23:46:46', '2025-05-20 23:46:46'),
(13, 1, 'bida asri', '29464', '2025-05-25 20:58:34', '2025-05-25 20:58:34'),
(14, 1, 'batam', '29464', '2025-05-25 22:20:27', '2025-05-25 22:20:27'),
(15, 2, 'bida asri 2', '29464', '2025-05-28 05:50:24', '2025-05-28 05:50:24');

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

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul`, `isi`, `foto`, `created_at`, `updated_at`) VALUES
(5, 'menanam pohon bersama', 'Acara ini diikuti oleh para pegawai KLHK bersama sejumlah relawan dari komunitas pecinta lingkungan, serta melibatkan perwakilan dari sektor swasta dalam rangka mendukung gerakan penghijauan nasional. Kegiatan ini bertujuan untuk memulihkan fungsi ekologis lahan, mengurangi risiko bencana seperti banjir dan longsor, serta meningkatkan cadangan karbon sebagai upaya mitigasi perubahan iklim. Bibit pohon yang ditanam berasal dari jenis tanaman lokal yang telah disesuaikan dengan kondisi tanah dan iklim setempat, agar dapat tumbuh optimal dan memberikan manfaat jangka panjang bagi lingkungan dan masyarakat sekitar.', '7cK5VOuUowxMvLbUdjBbB2GljzI26YTglxHNnvq6.jpg', '2025-05-07 01:45:28', '2025-05-07 01:49:58'),
(6, 'Acara Gerakan penghijauan', 'Kegiatan Rehabilitasi Hutan oleh Kementerian Lingkungan Hidup dan Kehutanan (KLHK) Sebagai bagian dari komitmen menjaga kelestarian lingkungan hidup dan memperbaiki ekosistem yang rusak, Kementerian Lingkungan Hidup dan Kehutanan (KLHK) menggelar kegiatan penanaman bibit pohon di kawasan yang mengalami kerusakan hutan dan degradasi lahan.', 'JskqwzS0CkmPKaKaXXq5mxNN9Q9aYM60OU4DUSBV.jpg', '2025-05-07 01:49:26', '2025-05-07 01:50:33'),
(7, 'tes ats', 'tes ats', '8RgxnNjUVaimBnrYJSQRrwauPGdncfcF2qp04n0E.jpg', '2025-05-07 05:16:51', '2025-05-07 05:16:51'),
(8, 'wowow', 'wowow gendut', 'Zf0WRRbKU0YWmed7g9LkaqVF6yutTrD8FM4X7OLO.png', '2025-05-26 00:35:08', '2025-05-26 00:35:08');

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

--
-- Dumping data for table `bank_sampah`
--

INSERT INTO `bank_sampah` (`id_bank_sampah`, `id_pengajuan_bank_sampah`, `created_at`, `updated_at`) VALUES
(5, 13, '2025-05-28 00:04:28', '2025-05-28 00:04:28'),
(6, 14, '2025-05-28 00:40:48', '2025-05-28 00:40:48'),
(7, 15, '2025-05-28 01:33:40', '2025-05-28 01:33:40'),
(8, 16, '2025-05-28 05:51:51', '2025-05-28 05:51:51');

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

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `foto`, `deskripsi`, `created_at`, `updated_at`) VALUES
(24, 'YqgUO3MKSwd7IBeNr1BEu421vaJPBCyk9iBMO0Zv.jpg', 'bersama mahasiswa membuat pupuk dnegan eco enzim', '2025-05-07 01:34:57', '2025-05-07 01:34:57'),
(25, 'qL5GeLY2SKef3MyajBO81FhRjgkV1U2ndlqa1V1F.jpg', 'penglohan limbah organik di tpa punggur', '2025-05-07 01:35:31', '2025-05-07 01:35:31'),
(26, 'kLNGmLJeq63crgtyt93hNgKcyoyhLpbVUOTLGwh1.jpg', 'bersama ibu ibu pkk membuat pupuk cair organik', '2025-05-07 01:36:24', '2025-05-07 01:36:24'),
(27, 'HkwvBWyLFpZPAKFkg2Cf5GebOuNq7lSmNtqn7DbV.png', 'semangat ats nyaa', '2025-05-07 05:18:03', '2025-05-07 05:18:03'),
(28, 'H67nvT97Dsr9PA78fmUM07rUhGPNKyK7mVzFEgMm.png', 'p', '2025-05-26 01:23:32', '2025-05-26 01:23:32');

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
(1, 'batam kota', NULL, NULL),
(2, 'batu aji', NULL, NULL),
(3, 'batu ampar', NULL, NULL),
(4, 'belakang padang', NULL, NULL),
(5, 'bengkong', NULL, NULL),
(6, 'bulang', NULL, NULL),
(7, 'galang', NULL, NULL),
(8, 'lubuk baja', NULL, NULL),
(9, 'nongsa', NULL, NULL),
(10, 'sagulung', NULL, NULL),
(11, 'sei beduk', NULL, NULL),
(12, 'sekupang', NULL, NULL);

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

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `judul`, `isi`, `foto`, `lokasi`, `kouta`, `tanggal_kegiatan`, `created_at`, `updated_at`) VALUES
(25, 'menanam 1000 pohon', 'Menanam Seribu Pohon: Investasi Hijau untuk Masa Depan\r\n\r\nMenanam pohon bukan sekadar kegiatan seremonial, tetapi sebuah langkah nyata dalam menjaga keseimbangan alam. Di tengah isu pemanasan global dan berkurangnya ruang hijau, aksi menanam seribu pohon menjadi simbol harapan sekaligus solusi konkret. Setiap pohon yang ditanam membawa manfaat besar bagi lingkungan — menyerap karbon dioksida, memperbaiki kualitas udara, menjaga kesuburan tanah, dan memberikan habitat bagi berbagai makhluk hidup.', 'skrDbFf2LdSU1fIncJhYLVl15IvjkZk9xgK6Cldg.jpg', 'kodim 0136 rider', 100, '2025-05-08 15:38:00', '2025-05-07 01:38:28', '2025-05-07 01:38:28'),
(27, 'tes ats batam', 'semangat ats', '2yiXdFNiS3EivA5TPfl14fMG2vAhyyFfMwifXDLO.jpg', 'polibatam kota', 10009, '2025-05-07 12:17:00', '2025-05-07 05:17:29', '2025-05-20 04:34:46'),
(29, 'a', 'tes', 'OXfsluLcfjWYqvznE4TVBLwAX4QSIoas2PShApUR.png', 'tes2', 2321, '2025-05-26 14:51:00', '2025-05-26 00:51:23', '2025-05-26 00:51:23');

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
(1, 1, 'baloi permai', NULL, NULL),
(2, 1, 'belian', NULL, NULL),
(3, 1, 'sukajadi', NULL, NULL),
(4, 1, 'sungai panas', NULL, NULL),
(5, 1, 'taman baloi', NULL, NULL),
(6, 1, 'teluk tering', NULL, NULL),
(7, 2, 'bukit tempayan', NULL, NULL),
(8, 2, 'buliang', NULL, NULL),
(9, 2, 'kibing', NULL, NULL),
(10, 2, 'tanjung uncang', NULL, NULL),
(11, 3, 'batu merah', NULL, NULL),
(12, 3, 'kampung seraya', NULL, NULL),
(13, 3, 'sungai jodoh', NULL, NULL),
(14, 3, 'tanjung sengkuang', NULL, NULL),
(15, 4, 'kasu', NULL, NULL),
(16, 4, 'penccong', NULL, NULL),
(17, 4, 'pemping', NULL, NULL),
(18, 4, 'sekanak raya', NULL, NULL),
(19, 4, 'tanjung sari', NULL, NULL),
(20, 4, 'pulau terong', NULL, NULL),
(21, 5, 'bengkong indah', NULL, NULL),
(22, 5, 'bengkong laut', NULL, NULL),
(23, 5, 'sadai', NULL, NULL),
(24, 5, 'tanjung buntung', NULL, NULL),
(25, 6, 'batu lengong', NULL, NULL),
(26, 6, 'bulang lintang', NULL, NULL),
(27, 6, 'pantai gelam', NULL, NULL),
(28, 6, 'pulau buluh', NULL, NULL),
(29, 6, 'setokok', NULL, NULL),
(30, 6, 'temoyong', NULL, NULL),
(31, 7, 'air raja', NULL, NULL),
(32, 7, 'galang baru', NULL, NULL),
(33, 7, 'karas', NULL, NULL),
(34, 7, 'pulau abang', NULL, NULL),
(35, 7, 'rempang cate', NULL, NULL),
(36, 7, 'sembulang', NULL, NULL),
(37, 7, 'sijantung', NULL, NULL),
(38, 7, 'subung mas', NULL, NULL),
(39, 8, 'baloi indah', NULL, NULL),
(40, 8, 'batu selicin', NULL, NULL),
(41, 8, 'kampung pelita', NULL, NULL),
(42, 8, 'lubuk baja kota', NULL, NULL),
(43, 8, 'tanjung uma', NULL, NULL),
(44, 9, 'batu besar', NULL, NULL),
(45, 9, 'kabil', NULL, NULL),
(46, 9, 'ngenang', NULL, NULL),
(47, 9, 'sambau', NULL, NULL),
(48, 10, 'sagulung kota', NULL, NULL),
(49, 10, 'sungai binti', NULL, NULL),
(50, 10, 'sungai langkai', NULL, NULL),
(51, 10, 'sungai lekop', NULL, NULL),
(52, 10, 'sungai pelunggut', NULL, NULL),
(53, 10, 'tembesi', NULL, NULL),
(54, 11, 'duriangkang', NULL, NULL),
(55, 11, 'mangsang', NULL, NULL),
(56, 11, 'muka kuning', NULL, NULL),
(57, 11, 'tanjung piayu', NULL, NULL),
(58, 12, 'patam lestari', NULL, NULL),
(59, 12, 'sungai harapan', NULL, NULL),
(60, 12, 'tanjung pinggir', NULL, NULL),
(61, 12, 'tanjung riau', NULL, NULL),
(62, 12, 'tiban baru', NULL, NULL),
(63, 12, 'tiban lama', NULL, NULL),
(64, 12, 'tiban indah', NULL, NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id_komunitas`, `id_user`, `id_alamat`, `nama`, `no_telp`, `created_at`, `updated_at`) VALUES
(3, 3, 3, 'nabiladitya', '082385142234', '2025-05-04 04:46:16', '2025-05-04 04:46:16'),
(9, 11, 9, 'ahmad firdaus', '081278902330', '2025-05-07 01:04:20', '2025-05-07 01:51:10'),
(10, 12, 10, 'hisam', '098918919191', '2025-05-07 02:24:45', '2025-05-07 02:24:45'),
(11, 13, 11, 'nabil', '086272826628', '2025-05-07 05:12:32', '2025-05-07 05:12:32'),
(12, 14, 12, 'justine', '096788888899', '2025-05-20 23:46:46', '2025-05-20 23:46:46'),
(13, 15, 13, 'asep', '096788888822', '2025-05-25 20:58:34', '2025-05-25 20:58:34'),
(14, 16, 14, 'bubu', '132535436547', '2025-05-25 22:20:27', '2025-05-25 22:20:27'),
(15, 17, 15, 'jono', '098765432111', '2025-05-28 05:50:24', '2025-05-28 05:50:24');

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
(12, '2025_04_13_071631_create_students_table', 1),
(13, '2025_04_24_145104_create_pengajuan_bank_sampahs_table', 1),
(14, '2025_04_24_150438_create_bank_sampahs_table', 1),
(15, '2025_04_24_151101_create_transaksi_sampahs_table', 1),
(16, '2025_04_24_153124_create_produks_table', 1),
(17, '2025_04_24_154553_create_pesanans_table', 1),
(18, '2025_04_24_155002_create_transaksi_produks_table', 1),
(19, '2025_04_24_161408_create_penukarans_table', 1),
(20, '2025_04_24_161756_create_transaksi_penukarans_table', 1),
(21, '2025_04_25_022441_create_points_table', 1),
(22, '2025_05_01_124346_create_pendaftaran_kegiatans_table', 1);

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
  `status` enum('diproses','diterima','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_bank_sampah`
--

INSERT INTO `pengajuan_bank_sampah` (`id_pengajuan_bank_sampah`, `id_komunitas`, `nama_bank_sampah`, `file_dokumen`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(13, 11, 'Bank Sampah Ekonomi Sehat', 'dokumen_pengajuan/yAoQ5jxdV8zu8bVfW2WKIyAO9BwK3AE8ywCBY1Dm.pdf', 'baik', 'diterima', '2025-05-28 00:04:06', '2025-05-28 00:04:28'),
(14, 13, 'tes', 'dokumen_pengajuan/rHXXmkpNvC3xsGU4y65gDVopq8wTlwVx9NSrbF5e.pdf', 'y', 'diterima', '2025-05-28 00:40:23', '2025-05-28 00:40:48'),
(15, 12, 'wow burger', 'dokumen_pengajuan/b3Mh22ej5z410v4tEwxj65GzLdp5wQobPr28ZCjZ.pdf', NULL, 'diterima', '2025-05-28 01:33:31', '2025-05-28 01:33:40'),
(16, 15, 'jono bank', 'dokumen_pengajuan/ZwjKqq3Qow3NwyUlEVX35ovEFWqSEXqMHkNfZn8W.pdf', NULL, 'diterima', '2025-05-28 05:51:02', '2025-05-28 05:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `penukaran`
--

CREATE TABLE `penukaran` (
  `id_penukaran` bigint UNSIGNED NOT NULL,
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `status_penukaran` enum('diproses','dikirim','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `status_pesanan` enum('diproses','dikirim','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 1, 0, '2026-05-02', '2025-05-01 21:21:23', '2025-05-01 21:21:23'),
(2, 2, 0, '2026-05-02', '2025-05-01 21:57:00', '2025-05-01 21:57:00'),
(3, 3, 0, '2026-05-04', '2025-05-04 04:46:16', '2025-05-04 04:46:16'),
(4, 4, 0, '2026-05-07', '2025-05-06 20:16:20', '2025-05-06 20:16:20'),
(5, 5, 0, '2026-05-07', '2025-05-06 21:19:03', '2025-05-06 21:19:03'),
(6, 7, 0, '2026-05-07', '2025-05-06 21:22:22', '2025-05-06 21:22:22'),
(7, 8, 0, '2026-05-07', '2025-05-06 21:23:44', '2025-05-06 21:23:44'),
(8, 9, 0, '2026-05-07', '2025-05-07 01:04:20', '2025-05-07 01:04:20'),
(9, 10, 0, '2026-05-07', '2025-05-07 02:24:45', '2025-05-07 02:24:45'),
(10, 11, 0, '2026-05-07', '2025-05-07 05:12:32', '2025-05-07 05:12:32'),
(11, 12, 0, '2026-05-21', '2025-05-20 23:46:46', '2025-05-20 23:46:46'),
(12, 13, 0, '2026-05-26', '2025-05-25 20:58:34', '2025-05-25 20:58:34'),
(13, 14, 0, '2026-05-26', '2025-05-25 22:20:27', '2025-05-25 22:20:27'),
(14, 15, 0, '2026-05-28', '2025-05-28 05:50:24', '2025-05-28 05:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` bigint UNSIGNED NOT NULL,
  `id_bank_sampah` bigint UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int UNSIGNED NOT NULL,
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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NB1fVsQjZJFenmgkG0U7qC7omlUALJ4ucLFlgr2G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWTdVVURqc05MQkIzc3JlakEwNWhIWEtXekZ1aHZjU09EdThGYjdrUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZXJzZXR1anVhYW4tYmFuay1zYW1wYWgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6ODoiaXNfYWRtaW4iO2I6MTt9', 1748436711),
('oujG91Righn0RkJUxsvSXTs6jAaJgRYq0wA8dbBd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoidFBtWDBjeUpqc1Z1QUN5ZjFseTVrQUtScTJXSUpwU2JvTldPNW1MMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1748441395),
('shhKRLMFW3qMh3ykOMIMB68sXlM1kieVelRWv43W', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiMjVGaHpoeEIyY094eXhpTFRnZlJ3R1o1VUE1WjFHOWdhdTFETVFIdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wZXJzZXR1anVhYW4tYmFuay1zYW1wYWgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6ODoiaXNfYWRtaW4iO2I6MTt9', 1748421221),
('u772nvLeDwsNZDjw1Do3G2WIWgqm39vatJeUo3L3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiYjV3NERiQlBzRktGZzdRTElBUGpNT3gzRnZuczdNSWpwY1haT1A1ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo4OiJpc19hZG1pbiI7YjoxO30=', 1748421426),
('URbnOtNLIewiroPnSGMBbGiPLZWZo8lQT3W0GZIN', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiZjh1TnQ0b0VqbGhBc1loNlZoa29vYUNBZlNnT2dZUWQxVG5KZFJoSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6ODoiaXNfYWRtaW4iO2I6MDtzOjE0OiJpc19iYW5rX3NhbXBhaCI7YjoxO30=', 1748421380);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `harga_satuan` int UNSIGNED NOT NULL,
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
  `berat_sampah` int UNSIGNED NOT NULL,
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
(1, 'admin', 'admin@gmail.com', '$2y$12$2IyUhvnI/FmK1QwYri7nO.htJH.3.fObkff28iEhnVq71KucT9PFK', 'admin', '2025-05-01 21:21:23', '2025-05-01 21:21:23'),
(3, 'nabiladitya', 'nabiladitya2203@gmail.com', '$2y$12$TBAWVyogrDz5CNPYr0WcSeV.lONA7Mezw/NjeayvNQtL..8pxJAwW', 'komunitas', '2025-05-04 04:46:16', '2025-05-27 22:34:55'),
(11, 'ahmad', 'ahmad@gmail.com', '$2y$12$IASDDvc22/ugS8UkrIJc8.Xul9petnmaUdytWdQibwqfaYpuBsKtu', 'komunitas', '2025-05-07 01:04:20', '2025-05-07 01:04:20'),
(12, 'hisam', 'hisam@gmail.com', '$2y$12$Pb2gI/gxq20EVWi4ySpQF.ul5JLrD4Aos/MnW876DTR8WxTKrzLde', 'komunitas', '2025-05-07 02:24:45', '2025-05-07 02:24:45'),
(13, 'nabil', 'mnabiladp2005@gmail.com', '$2y$12$Hd7.YhxwPToYSFtFsoNR9eoAPefNKpAzNeQp.Dwe7kzOPMVn1LtbS', 'komunitas', '2025-05-07 05:12:32', '2025-05-07 05:12:32'),
(14, 'justine', 'justine@gmail.com', '$2y$12$zMDPbCMY02d64efkZgXzGu45ZXtko1SKd4ePa9cnur/2CaW.uKdOa', 'komunitas', '2025-05-20 23:46:46', '2025-05-20 23:46:46'),
(15, 'asep', 'asep@gmail.com', '$2y$12$6IlmtTSXYLr8bxYwM1ODZ.Z8FVoxFGDpQj7cqB2xoHoafzZ1IYyfS', 'komunitas', '2025-05-25 20:58:34', '2025-05-25 20:58:34'),
(16, 'bubu', 'bubu@gmail.com', '$2y$12$dhlsER3MD3ToDYXdg/JB8eg2BZa0It0A6CyzDXThpav7jxf60Z1Va', 'komunitas', '2025-05-25 22:20:27', '2025-05-25 22:20:27'),
(17, 'jono', 'jono@gmail.com', '$2y$12$U1432ebHyqf0tyD4o9qbB.kXvjWRQa6wEGViwEoyp3ygpWVX54AU.', 'komunitas', '2025-05-28 05:50:24', '2025-05-28 05:50:24');

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
  ADD UNIQUE KEY `pengajuan_bank_sampah_nama_bank_sampah_unique` (`nama_bank_sampah`),
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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_nim_unique` (`nim`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

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
  MODIFY `id_alamat` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  MODIFY `id_bank_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id_kelurahan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id_komunitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pendaftaran_kegiatan`
--
ALTER TABLE `pendaftaran_kegiatan`
  MODIFY `id_pendaftaran_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_bank_sampah`
--
ALTER TABLE `pengajuan_bank_sampah`
  MODIFY `id_pengajuan_bank_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id_point` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `transaksi_penukaran_id_hadiah_foreign` FOREIGN KEY (`id_hadiah`) REFERENCES `hadiah` (`id_hadiah`),
  ADD CONSTRAINT `transaksi_penukaran_id_penukaran_foreign` FOREIGN KEY (`id_penukaran`) REFERENCES `penukaran` (`id_penukaran`);

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
