-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2025 at 04:25 AM
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
(1, 2, 'Bida Asri 2', '26504', '2025-06-09 09:53:11', '2025-06-09 09:53:11'),
(2, 3, 'Bida Asri 2 Blok H No 9', '29464', '2025-06-09 09:53:11', '2025-06-09 09:53:11'),
(3, 1, 'bida asri 2', '29464', '2025-06-09 09:54:25', '2025-06-09 09:54:25'),
(4, 1, 'bida asri 2', '29464', '2025-06-09 09:56:36', '2025-06-09 09:56:36'),
(5, 1, 'taman marcelia', '12345', '2025-06-09 10:03:29', '2025-06-09 10:03:29'),
(6, 51, 'sei lekop', '67493', '2025-06-09 10:07:14', '2025-06-09 10:07:14'),
(7, 13, 'a', '12345', '2025-06-09 10:09:25', '2025-06-09 10:09:25'),
(8, 1, 'a', '12345', '2025-06-09 10:11:08', '2025-06-09 10:11:08'),
(9, 2, 'bida asri 2', '29464', '2025-06-09 10:15:58', '2025-06-09 10:15:58'),
(10, 1, 'bida asri 2', '29464', '2025-06-09 10:22:31', '2025-06-09 10:22:31'),
(11, 1, 'a', '26504', '2025-06-09 10:23:16', '2025-06-09 10:23:16'),
(12, 57, 'piayu gate 2', '29464', '2025-06-09 21:41:48', '2025-06-09 21:41:48'),
(13, 7, 'a', '12345', '2025-06-09 21:58:01', '2025-06-09 21:58:01'),
(14, 1, 'w', '12345', '2025-06-09 21:59:43', '2025-06-09 21:59:43'),
(15, 7, '2', '12345', '2025-06-09 22:03:35', '2025-06-09 22:03:35'),
(16, 1, 'batam', '26504', '2025-06-09 22:13:38', '2025-06-09 22:13:38'),
(17, 2, 'batam kota', '26504', '2025-06-09 22:19:09', '2025-06-09 22:19:09'),
(18, 1, 'batam kota', '12345', '2025-06-09 22:21:41', '2025-06-09 22:21:41'),
(19, 7, 'a', '26504', '2025-06-09 22:23:51', '2025-06-09 22:23:51'),
(20, 1, 'a', '12345', '2025-06-09 22:24:55', '2025-06-09 22:24:55'),
(21, 2, 'bida asri 2', '29464', '2025-06-09 22:27:38', '2025-06-09 22:27:38'),
(22, 51, 'Taman Asri Sei Lekop', '67536', '2025-06-09 23:12:33', '2025-06-09 23:12:33'),
(23, 41, 'Kampung Pelita, perum penuin permai', '35423', '2025-06-09 23:14:06', '2025-06-09 23:14:06'),
(24, 5, 'legenda', '12345', '2025-06-10 01:15:12', '2025-06-10 01:15:12'),
(25, 1, 'BATAM', '29464', '2025-06-10 07:44:31', '2025-06-10 07:44:31');

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
(1, 'Solusi Ramah Lingkungan dari Dapur Rumah', 'Artikel ini membahas bagaimana limbah dapur seperti kulit buah dan sayuran bisa diubah menjadi Eco Enzyme, cairan multifungsi yang berguna untuk membersihkan rumah, menyuburkan tanaman, dan menjaga lingkungan tetap lestari.', '1ULGxy9q416UnbRF3elEoF1th3HdetJv2b1o4KsP.jpg', '2025-06-09 22:33:02', '2025-06-09 22:33:02'),
(2, 'Workshop Pembuatan Eco Enzyme dan penerapanya', 'Kegiatan edukatif ini mengajak peserta untuk belajar langsung cara membuat Eco Enzyme dari limbah dapur. Selain praktik fermentasi, peserta juga dibekali pemahaman tentang pentingnya pengelolaan sampah organik.', 'maFFUgToAGPXRlJLoAG4jcTKJY68PihDkPBSTqgN.jpg', '2025-06-09 22:34:18', '2025-06-09 22:35:05'),
(3, 'Komunitas Bersatu Membuat Eco Enzyme Massal', 'Komunitas lingkungan mengadakan aksi bersama membuat Eco Enzyme sebagai upaya mengurangi sampah organik rumah tangga. Kegiatan ini mempererat solidaritas sekaligus memberi solusi nyata untuk masalah sampah.', 'OhBXy9ZP1HfZyTtRa4kE2fb8OOGbbHyBLtGQG14u.jpg', '2025-06-09 22:35:40', '2025-06-09 22:35:40');

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
(1, 1, '2025-06-09 22:30:27', '2025-06-09 22:30:27'),
(2, 2, '2025-06-10 02:19:55', '2025-06-10 02:19:55');

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
(1, '0RkzIIyG41deJJWrDLlZn9GMf3PvIYhi3OdIO5J7.jpg', 'UMKM jual Produk Eco Enzim', '2025-06-09 22:36:31', '2025-06-09 22:36:31'),
(2, 'eeg2D9518gNvWYBWeaqfsNr1AuvQiPn0jSGxwbus.jpg', 'Menanam Pohon Bersama', '2025-06-09 22:36:57', '2025-06-09 22:36:57'),
(3, 'PcBfaOHBGJSN97FABpQMBXJEXVrCQsnRExp35R4s.jpg', 'Untuk ekosisitem sungai, peran besar cairan eco enzim', '2025-06-09 22:37:34', '2025-06-09 22:37:34'),
(4, 'snpm60MYv7EqrcCSE3FtDtws9rUIf5AIam8jS7MR.jpg', 'pupuk eco enzim', '2025-06-09 22:38:01', '2025-06-09 22:38:01'),
(5, 'IisgW0J9C8kJ2RR4aDkzRejKxCBsyAJKEqweM1OW.jpg', 'Tni bersama rakyat membangun hidup sehat', '2025-06-09 22:38:35', '2025-06-09 22:38:35'),
(6, 'EDL8i4WKuA27ZLJoHkeDfy9htuBbYgxOrqLcy4tr.jpg', 'Politeknik negeri batam mengembangkan eco enzim', '2025-06-09 22:39:13', '2025-06-09 22:39:13');

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

--
-- Dumping data for table `hadiah`
--

INSERT INTO `hadiah` (`id_hadiah`, `nama_hadiah`, `deskripsi`, `foto`, `stok`, `point_satuan`, `created_at`, `updated_at`) VALUES
(1, 'Minyak Goreng 1 Liter', 'Minyak Goreng Fortune adalah minyak nabati berkualitas tinggi yang dibuat dari bahan pilihan dan diolah dengan teknologi modern. Memiliki warna jernih, tidak mudah hitam saat dipakai menggoreng, serta tidak meninggalkan bau tengik.\r\nCocok digunakan untuk menggoreng, menumis, hingga membuat aneka hidangan favorit keluarga.', 'iH4DGrfItzItdtXt1dH3SEIDzpxloxwHjDdm1CEM.jpg', 10, 100, '2025-06-09 22:47:55', '2025-06-09 22:47:55'),
(2, 'Shampo Eco', 'Eco Shampoo adalah sampo alami yang diformulasikan khusus dari bahan-bahan organik dan biodegradable, tanpa kandungan bahan kimia keras. Dibuat untuk merawat rambut sekaligus menjaga kelestarian lingkungan.\r\n\r\nDiperkaya dengan ekstrak tumbuhan seperti lidah buaya, teh hijau, dan minyak esensial, Eco Shampoo membersihkan rambut dengan lembut, menjadikannya lebih sehat, berkilau, dan bebas dari ketombe tanpa merusak ekosistem air.', 's9P0gKyc3wzdkJN5YitEbL6y835ZKR18qRhql6P0.png', 4, 80, '2025-06-09 22:49:55', '2025-06-09 22:49:55');

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
(1, 'Workshop Pembuatan Eco Enzyme dan penerapanya', 'Dalam rangka memperingati Hari Lingkungan Hidup, diadakan kampanye pembuatan dan penggunaan Eco Enzyme. Kegiatan ini mencakup demo pembuatan, pembagian starter kit, dan sosialisasi manfaatnya untuk rumah tangga.', 'Ll3LXYbSGyCU9FJMfrktqbexPGkvj81BavVUesm4.jpg', 'Kantor DLHK Batam', 0, '2025-06-19 22:41:00', '2025-06-09 22:41:23', '2025-06-09 22:54:47'),
(2, 'Sekolah Bersih, Bumi Sehat: Eco Enzyme Goes to School', 'Program edukasi lingkungan di sekolah yang melibatkan siswa dalam pembuatan Eco Enzyme, pemanfaatannya untuk kebersihan sekolah, serta lomba kreativitas berbasis daur ulang limbah organik.', 'TgAar9FPvZgrMsDIDW1wQz9Q3aSmZnzhxDGiRs6e.jpg', 'SDN 010 Batam Kota', 199, '2025-06-19 12:52:00', '2025-06-09 22:52:11', '2025-06-09 23:14:36'),
(3, 'Bank Sampah Organik & Produksi Eco Enzyme', 'Integrasi program bank sampah organik dengan produksi Eco Enzyme. Warga menyetorkan limbah dapur (kulit buah/sayur), lalu diproses bersama menjadi Eco Enzyme dan digunakan kembali untuk kebutuhan RT/RW atau dijual.', 'rvsQc0nJz8aVvqx8HQwmHEzdLnYWX1nwlAesu4fS.jpg', 'Perum KDA', 57, '2025-06-28 12:54:00', '2025-06-09 22:54:14', '2025-06-09 23:14:56'),
(4, 'Polibatam wujudkan sistem ramah  Lingkungan Berkelanjutan', 'Kegiatan ini merupakan inisiatif dari mahasiswa Politeknik Negeri Batam dalam rangka mendukung gerakan peduli lingkungan melalui pembuatan Eco Enzyme dari limbah organik. Melalui kegiatan ini, mahasiswa diajak untuk lebih sadar akan pentingnya pengelolaan sampah rumah tangga, khususnya sampah dapur, yang selama ini sering diabaikan.', '6J7NuD4cLxGDFkB9P0nqBYvYiAalzYXbrjQsqvvV.jpg', 'Polibatam', 119, '2025-06-29 05:56:00', '2025-06-09 22:56:30', '2025-06-09 23:15:07'),
(5, 'Eco Enzyme untuk Pertanian Organik Warga', 'Kegiatan pembuatan Eco Enzyme secara massal yang kemudian dimanfaatkan sebagai pupuk cair alami untuk tanaman warga. Selain mengurangi ketergantungan pada pupuk kimia, juga meningkatkan kesuburan tanah.', 'YrodZIUgJ9VY9DY3kNodkbldA4UYinWolYp0WsFz.jpg', 'Hutan Mata Kucing', 50, '2025-06-30 12:58:00', '2025-06-09 22:58:07', '2025-06-09 22:58:07'),
(6, 'Aksi Tebar Eco Enzyme: Bersama Pulihkan Sungai Kita', 'Kegiatan ini merupakan aksi nyata kepedulian terhadap lingkungan dengan cara menebar cairan Eco Enzyme ke aliran sungai yang mengalami pencemaran ringan hingga sedang. Eco Enzyme dipercaya dapat membantu memperbaiki kualitas air secara alami karena mengandung mikroorganisme hasil fermentasi yang dapat menguraikan limbah organik, mengurangi bau tidak sedap, dan meningkatkan oksigen terlarut dalam air.', 'hAop0049KJVsgTplYg9NOkyx2zxBMnDxWFMhzuAe.jpg', 'Sungai Harapan', 69, '2025-07-01 13:04:00', '2025-06-09 23:04:07', '2025-06-10 02:13:57'),
(7, 'politkenik', 'rets', '0Bq1SmsWzCkWth0va5RWgzxY7dMoFjqBO6zCsj5D.jpg', 'batam', 122, '2025-06-10 15:20:00', '2025-06-10 01:20:46', '2025-06-10 06:05:51');

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
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id_komunitas`, `id_user`, `id_alamat`, `nama`, `no_telp`, `foto`, `created_at`, `updated_at`) VALUES
(19, 19, 21, 'nabil', '082385142233', 'https://api.dicebear.com/9.x/initials/svg?seed=na', '2025-06-09 22:27:38', '2025-06-09 22:27:38'),
(20, 20, 22, 'imel', '098765432342', 'https://api.dicebear.com/9.x/initials/svg?seed=im', '2025-06-09 23:12:33', '2025-06-09 23:12:33'),
(21, 21, 23, 'justine', '096788888887', 'https://api.dicebear.com/9.x/initials/svg?seed=ju', '2025-06-09 23:14:06', '2025-06-09 23:14:06'),
(22, 22, 24, 'wasyn', '083828424872', 'https://api.dicebear.com/9.x/initials/svg?seed=wa', '2025-06-10 01:15:12', '2025-06-10 01:15:12'),
(23, 23, 25, 'adit', '098238920202', 'https://api.dicebear.com/9.x/initials/svg?seed=ad', '2025-06-10 07:44:31', '2025-06-10 07:44:31');

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

--
-- Dumping data for table `pendaftaran_kegiatan`
--

INSERT INTO `pendaftaran_kegiatan` (`id_pendaftaran_kegiatan`, `id_komunitas`, `id_kegiatan`, `created_at`, `updated_at`) VALUES
(1, 19, 3, '2025-06-09 22:58:59', '2025-06-09 22:58:59'),
(2, 21, 3, '2025-06-09 23:14:30', '2025-06-09 23:14:30'),
(3, 21, 2, '2025-06-09 23:14:36', '2025-06-09 23:14:36'),
(4, 20, 3, '2025-06-09 23:14:56', '2025-06-09 23:14:56'),
(5, 20, 4, '2025-06-09 23:15:07', '2025-06-09 23:15:07'),
(6, 19, 6, '2025-06-10 02:13:57', '2025-06-10 02:13:57'),
(7, 21, 7, '2025-06-10 06:05:51', '2025-06-10 06:05:51');

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
  `status` enum('diproses','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_bank_sampah`
--

INSERT INTO `pengajuan_bank_sampah` (`id_pengajuan_bank_sampah`, `id_komunitas`, `nama_bank_sampah`, `file_dokumen`, `catatan`, `status`, `created_at`, `updated_at`) VALUES
(1, 19, 'wanabakti', 'dokumen_pengajuan/gh2YASpGrAlb4X5nop69IYRlUYWbcb7HzlEFsKFO.pdf', NULL, 'diterima', '2025-06-09 22:29:57', '2025-06-09 22:30:27'),
(2, 22, 'bank sampah wasin', 'dokumen_pengajuan/49sakxebAd6YInAVqBNlGhUZYxDDDXK6G5C65gcn.pdf', NULL, 'diterima', '2025-06-10 01:17:37', '2025-06-10 02:19:55');

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
(20, 20, 0, '2026-06-10', '2025-06-09 23:12:33', '2025-06-09 23:12:33'),
(21, 21, 0, '2026-06-10', '2025-06-09 23:14:06', '2025-06-09 23:14:06'),
(22, 22, 0, '2026-06-10', '2025-06-10 01:15:12', '2025-06-10 01:15:12'),
(23, 23, 0, '2026-06-10', '2025-06-10 07:44:31', '2025-06-10 07:44:31'),
(90, 19, 80, '2026-06-10', '2025-06-09 22:27:38', '2025-06-09 22:27:38');

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
('7cicslifHJHRBwJWN3RtncQgElicRQmVr9TeGie6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiZzh3UHBvNURtbHo1R3Z3Yjl4OXhWaUNtdWRSV01Scll1eG5oTk13RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi92aWV3LWJhbmstc2FtcGFoIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjc6InVzZXJfaWQiO2k6MTtzOjQ6InJvbGUiO3M6NToiYWRtaW4iO3M6ODoiaXNfYWRtaW4iO2I6MTtzOjE0OiJpc19iYW5rX3NhbXBhaCI7YjowO30=', 1749611345),
('GPhItAE070FlWtcmZe2obC1F82mh9zqas3AqO5jz', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiRG9BUnVkeUUzeXJtODRFVWpnWmJEbFZJUmtJQUpMQlZxT1VWSnVNWiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NzoidXNlcl9pZCI7aToxO3M6NDoicm9sZSI7czo1OiJhZG1pbiI7czo4OiJpc19hZG1pbiI7YjoxO3M6MTQ6ImlzX2Jhbmtfc2FtcGFoIjtiOjA7fQ==', 1749575937),
('Vare3VnNOA2TIfvnNiv3Xr7Y9hbkBahTXUMXgIjp', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiUmhvbzM0eVNSSUNLbHdMM0xCVldjMnlPMEdvaWNBV2tRc1ZIVVdRSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvYWRkLXNldG9yLXNhbXBhaCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O3M6NzoidXNlcl9pZCI7aToxOTtzOjQ6InJvbGUiO3M6OToia29tdW5pdGFzIjtzOjg6ImlzX2FkbWluIjtiOjA7czoxNDoiaXNfYmFua19zYW1wYWgiO2I6MTt9', 1749615746),
('XIWXWhhxUM32tirL6WhthNSnGpBlQGsxNEzasFzD', 19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiek02NldxZ3NEcTZ1WEdjdWZQT0tMT3dpcmYzR0lwa3lPVzE0UW91diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvYWRkLXNldG9yLXNhbXBhaCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE5O3M6NzoidXNlcl9pZCI7aToxOTtzOjQ6InJvbGUiO3M6OToia29tdW5pdGFzIjtzOjg6ImlzX2FkbWluIjtiOjA7czoxNDoiaXNfYmFua19zYW1wYWgiO2I6MTt9', 1749576296);

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
(1, 'admin', 'admin@gmail.com', '$2y$12$PDowt6CnQbELPgp8NT23Ku/ukTcpul84eCgn/bEPgTVRQJMYBaZc6', 'admin', '2025-06-09 09:54:25', '2025-06-09 09:54:25'),
(19, 'nabil', 'nabiladitya2203@gmail.com', '$2y$12$4x73EBpfzSnaRbgVHcHo8ucTnbgkzWy25r4pZhnMx8DyTZg/4jKeW', 'komunitas', '2025-06-09 22:27:38', '2025-06-09 22:27:38'),
(20, 'imel', 'imel@gmail.com', '$2y$12$pl0DBXhDoGr.hgvWIjuyJu5hOZBi0nvn3aBGWKGRKrkJxidYxqeQy', 'komunitas', '2025-06-09 23:12:33', '2025-06-09 23:12:33'),
(21, 'justine', 'justine@gmail.com', '$2y$12$Mf1vHOjXOYI.exE6De1gyeqidThG1c6RSudWhZ6TT/rsrcZ6yvyYG', 'komunitas', '2025-06-09 23:14:06', '2025-06-09 23:14:06'),
(22, 'wasyn', 'wasyn@gmail.com', '$2y$12$J9LjNwSJCft45t58Uy2hI.rrUChsTalU2.6cLXaHSpaG9UFMgMdTW', 'komunitas', '2025-06-10 01:15:12', '2025-06-10 01:15:12'),
(23, 'adit', 'adit@gmail.com', '$2y$12$OMdhL6oN3PQv46jAzYWBOutmgSRs3LqgE9GyXHATvsWTXRR0Zea6y', 'komunitas', '2025-06-10 07:44:31', '2025-06-10 07:44:31');

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
  MODIFY `id_alamat` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_sampah`
--
ALTER TABLE `bank_sampah`
  MODIFY `id_bank_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id_hadiah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id_kelurahan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id_komunitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pendaftaran_kegiatan`
--
ALTER TABLE `pendaftaran_kegiatan`
  MODIFY `id_pendaftaran_kegiatan` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengajuan_bank_sampah`
--
ALTER TABLE `pengajuan_bank_sampah`
  MODIFY `id_pengajuan_bank_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_point` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
  MODIFY `id_transaksi_sampah` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
