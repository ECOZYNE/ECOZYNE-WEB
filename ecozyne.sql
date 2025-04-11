-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2025 at 07:35 AM
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
(3, 'amaba', 'wowowow', 'artikel/ro9SQRZsSwsDGRRPjecv30b13gvMJc9ZoX91dvc7.jpg', '2025-03-28 08:42:27', '2025-03-28 08:42:27'),
(4, 'jaswir', 'buahahha', 'artikel/z2pSmmM0xlmm6pvY2aiHVNWszvB6Wfz4zgPsZ4aH.jpg', '2025-03-28 08:47:41', '2025-03-28 08:47:41'),
(5, 'jamal', 'hantu', 'artikel/KThSffcmujAHd185h6QahZqKVOByym7JLqD0Pp0W.jpg', '2025-03-28 08:50:07', '2025-03-28 08:50:07'),
(6, 'akbar', 'sani', 'artikel/R7AGkodC80Qt5WFdlrhKSbON7pXXKSGfGCMVaZKc.jpg', '2025-03-28 08:55:12', '2025-03-28 08:55:12'),
(7, 'amerika', 'tes', 'artikel/4Sa2SsTOlCoLjdkIie1o0tthP0F6d1zLzCsPj6Ry.png', '2025-03-28 09:01:49', '2025-03-28 09:01:49'),
(8, 'brazil', 'tes', 'artikel/aUpb2qDu9ySwXF3khItla1PKqemcX0NFynQWWe4D.png', '2025-03-28 09:03:04', '2025-03-28 09:03:04'),
(9, 'brazil', 'tes', 'artikel/rvp4hwFX2I5AMx83aVKpnpwDl01EB7DP2PgB6Bx4.png', '2025-03-28 09:03:26', '2025-03-28 09:03:26'),
(10, 'sahid', 'hvcd', 'artikel/4140E1xPs4wwmCNktyZO8vMKFxVcDQ17sBHVoESJ.png', '2025-03-28 09:07:35', '2025-03-28 09:07:35'),
(11, 'france', 'affsdsdsf', 'artikel/00rtBKcAQ7WRtuHxYXX3lyejaNiI23N1gWtWlTgf.png', '2025-03-28 09:10:08', '2025-03-28 09:10:08'),
(12, 'france', 'Mari kita sukseskan Tarawih dengan mengajak anak-anak di sekitar kita untuk selalu melaksanakan shalat Tarawih, meskipun Ramadan telah memasuki hari-hari terakhir. Dengan membiasakan mereka untuk ikut serta dalam shalat Tarawih, kita tidak hanya menanamkan nilai ibadah, tetapi juga membentuk kebiasaan baik yang akan terus melekat dalam kehidupan mereka. Semangat untuk beribadah di bulan yang penuh berkah ini harus tetap terjaga hingga akhir, karena setiap amal kebaikan yang dilakukan akan menjadi bekal di kemudian hari. Mari kita bersama-sama menjaga semangat Ramadan dan menjadikannya sebagai momen yang membawa keberkahan bagi seluruh keluarga dan lingkungan sekitar.', 'artikel/eSZCWfrOMZArrIOblhTjawGSdz3l02yRLsS4UkPf.png', '2025-03-28 09:10:25', '2025-03-28 09:10:25'),
(13, 'mari kita sukesekan ', 'mari kita sukesekan tarawih ', 'artikel/Ey56BDA4Knq4qdctMKKvl9VfHqdyVMkFSoJF5cya.jpg', '2025-03-28 09:14:16', '2025-03-28 09:14:16'),
(14, 'amaba', 'amaba', 'artikel/1rgvx0aAGVMw9TlVaZIMPRwuEtUY1oe8IHgQIeOQ.jpg', '2025-03-28 09:51:16', '2025-03-28 09:51:16'),
(15, 'lol', 'lol', 'artikel/Yw7EHZiEKCkmD2UjIsxX1rweBxnHCxMgKNgBHbQb.jpg', '2025-03-28 09:52:35', '2025-03-28 09:52:35'),
(16, 'tes', 'lol', 'artikel/WYs0JLxDfWdIKjmjZLaD8z3dYvRbRne2ryj6IBnr.jpg', '2025-03-28 09:53:53', '2025-03-28 09:53:53'),
(17, 'yeyeyey', 'lol', 'artikel/msLT5h0xFrhDjqnfxMY5ofW0ATi1nqis7cupT0Jk.jpg', '2025-03-28 09:54:45', '2025-03-28 09:54:45'),
(18, 'indonesia', 'thom haye', 'artikel/8haPyniCnxcHD12lUkCu5zmpUSO0GWL8Y5zqhIEp.png', '2025-03-28 15:40:34', '2025-03-28 15:40:34'),
(19, 'indonesia', 'thom haye', 'artikel/AhkWvWUWLlodtQuXaM9GVBaxN0QGbtwyKQOZDhKd.png', '2025-03-28 15:40:35', '2025-03-28 15:40:35'),
(20, 'brazil', 'o', 'artikel/75gJ0v9Mp6YT8MGK9au17bhDGOq8jn0a61Dw6QhY.png', '2025-03-28 15:41:10', '2025-03-28 15:41:10'),
(21, 'piala dunia', 'indonesia', 'artikel/HK5zXgphbusQlvfVsEaw8PD83bKQLsb5N35rATQP.png', '2025-03-29 00:48:49', '2025-03-29 00:48:49'),
(22, 'amaba', 's', 'artikel/e6u6jWZyiTg1wi8Xq5Hi9YgVnmSXDJNEYI0w3R24.png', '2025-03-29 03:42:18', '2025-03-29 03:42:18'),
(23, 'amaba', 's', 'artikel/2FgAOYuqEejFPLd1xG7kFfqHvLYNTfuPrI9XIOc6.png', '2025-03-29 03:42:18', '2025-03-29 03:42:18'),
(24, 'mortal', 'combat', 'artikel/WjghpPEnvP1NTZMRIkge96YftFDbFhHeDoHU7ADX.jpg', '2025-03-29 06:26:03', '2025-03-29 06:26:03'),
(25, 'kisah seram hantu', 'kampung hantu', 'artikel/BJc5te8n0edGQA2tMQoY1wu9UnP2DjhfCpl3xrp6.png', '2025-03-29 08:50:05', '2025-03-29 08:50:05'),
(26, 'cc', 'cc', 'artikel/UvCkzMDJCU6oXJXLZnxaFGZEMn0PQfyglS0nEjXV.jpg', '2025-03-29 09:58:17', '2025-03-29 09:58:17'),
(27, 'makan ayam goreng', 'seru kalo', 'artikel/RJvp7UAxA6EwLm1EkU8qMipUprafZzxiv0rewtGn.png', '2025-04-08 07:02:54', '2025-04-08 07:02:54'),
(28, 'brazilzzz', 'zzz', 'artikel/nv6iIZ9s1qNS8xcC5vPqP0ao4bnMkSEJFQ6VV4vO.jpg', '2025-04-09 21:29:51', '2025-04-09 21:29:51'),
(29, 'jakarta 1954', 'aeqweeawaw', 'artikel/IiIG4dTibbvkL4nOjCrewwSCSPHVDSKsc4b2DY0l.jpg', '2025-04-09 21:43:21', '2025-04-09 21:43:21');

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
-- Table structure for table `komunitas`
--

CREATE TABLE `komunitas` (
  `id_komunitas` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id_komunitas`, `id_user`, `nama`, `no_telp`, `alamat`, `kecamatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'akram', '082385142231', 'batam', 'lubuk baja', '2025-03-28 09:29:00', '2025-03-28 09:29:00'),
(2, 2, 'putera', '082385142252', 'Batam kota', 'lubuk baja', '2025-03-28 09:30:20', '2025-03-28 09:30:20'),
(3, 3, 'gameniu', '082385148867', 'Batam kota', 'lubuk baja', '2025-03-28 09:32:52', '2025-03-28 09:32:52'),
(4, 4, 'abdul', '082385142294', 'Batam kota', 'lubuk baja', '2025-03-28 09:34:13', '2025-03-28 09:34:13'),
(5, 5, 'yetro', '082385142289', 'batam', 'batu ampar', '2025-03-28 09:36:49', '2025-03-28 09:36:49'),
(6, 6, 'supardianto', '082385142273', 'Batam kota', 'batu ampar', '2025-03-28 09:38:31', '2025-03-28 09:38:31'),
(7, 7, 'nabil', '087834784569', 'batam', 'lubuk baja', '2025-03-28 09:43:07', '2025-03-28 09:43:07'),
(8, 8, 'adit', '082385142255', 'Batam kota', 'lubuk baja', '2025-03-28 09:45:35', '2025-03-28 09:45:35'),
(9, 9, 'amaba', '082385142244', 'batam', 'bengkong', '2025-03-28 09:47:49', '2025-03-28 09:47:49'),
(10, 10, 'roza', '082385142654', 'b', 'bengkong', '2025-03-29 03:22:08', '2025-03-29 03:22:08'),
(11, 11, 'nabil hacker', '082385142666', 'Batam kota', 'batu ampar', '2025-03-29 03:22:37', '2025-03-29 03:22:37'),
(14, 19, 'kj', '987654567643', 'k', 'batu ampar', '2025-03-29 09:57:28', '2025-03-29 09:57:28'),
(15, 20, 'cika', '098765432477', 'kda', 'batam kota', '2025-04-08 07:00:32', '2025-04-08 07:00:32'),
(16, 21, 'gamang', '535252532532', 'gamangaaa', 'bengkong', '2025-04-09 21:33:45', '2025-04-09 21:33:45'),
(17, 22, 'gemang', '082385142239', 'aa', 'batu ampar', '2025-04-09 23:44:39', '2025-04-09 23:44:39');

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
(4, '2025_03_18_100054_create_komunitas_table', 1),
(5, '2025_03_28_141010_create_artikels_table', 1);

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
('9ZlODxzKR3UmrQidrK5MnDaqMi0NgviAUa58Sw8A', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSklaV3RtMXpmd0hRWXdSU2JkWFFJU1MxTDFFNlRTbVBwck96SVpKNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi92aWV3LWFydGlrZWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1744270347);

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
(1, 'akram', 'akram@gmail.com', '$2y$12$ZNzAaaBmaaT64mN0.HBXfu94eHXIZW1OiJ3VWbi6ZOD5/YMb/lQOu', 'komunitas', '2025-03-28 09:29:00', '2025-03-28 09:29:00'),
(2, 'putera', 'putera@gmail.com', '$2y$12$qJNJfgWbxlVoIcjCGEDkbuz9kLHZYDojm5AsdMQJsodI3BTFt3Zhi', 'komunitas', '2025-03-28 09:30:20', '2025-03-28 09:30:20'),
(3, 'gameniu', 'gameniu@gmail.com', '$2y$12$jFz.rjRwHkhP3PNb8h1pxelQKv9Jy2I5NYwAq8ktiC912CynHj5Wi', 'komunitas', '2025-03-28 09:32:52', '2025-03-28 09:32:52'),
(4, 'abdul', 'abdul@gmail.com', '$2y$12$c1WvbP6hLQCk043aks8I5evk8wLUMzjNjb4t5wBR2wHY.qtbq/zT6', 'komunitas', '2025-03-28 09:34:13', '2025-03-28 09:34:13'),
(5, 'yetro', 'yetro@gmail.com', '$2y$12$cob1c6vQq8PP59KRw5vVburWxuDFqy6jgMzFnLKy2kjJcPs/ytdue', 'komunitas', '2025-03-28 09:36:49', '2025-03-28 09:36:49'),
(6, 'supardianto', 'supardianto@gmail.com', '$2y$12$6Eef9fXUDDIlMF1/7F6Jj.7.Whxqq26R2QX2zvYVoKZcqFfgVs9Hq', 'komunitas', '2025-03-28 09:38:31', '2025-03-28 09:38:31'),
(7, 'admin', 'mnabiladp2005@gmail.com', '$2y$12$uxiofwhLJ9MGDnImXBeNxuHDWfJLAbDyvd0Ws8ZSlfTBtRmoFdXNO', 'admin', '2025-03-28 09:43:07', '2025-03-28 09:43:07'),
(8, 'adit', 'adit@gmail.com', '$2y$12$PWA5GJKo4ZtuJ1Dtkiujbey3.95T5wtX7DlsM8DD3BZhiIB0VcFDq', 'komunitas', '2025-03-28 09:45:35', '2025-03-28 09:45:35'),
(9, 'amaba', 'amaba@gmailcom', '$2y$12$qMW6EmQcW9l5yjSg0sjeyeRV13DyIoKF3btzHp.kcEuzvIAANEs1y', 'komunitas', '2025-03-28 09:47:49', '2025-03-28 09:47:49'),
(10, 'roza', 'roza@gmail.com', '$2y$12$Scjv7PSB9I/gXMSsvaJFu.r7bW9Or2oERfN.k2ToBPTwdXhu1Di7e', 'komunitas', '2025-03-29 03:22:08', '2025-03-29 03:22:08'),
(11, 'nabilhacker', 'nabilhacker@gmail.com', '$2y$12$7Gg8RRbPW3v5OJd3ORQYLe5sIQysWAXwJBWIH.iQm/5mL1NW6/QD6', 'komunitas', '2025-03-29 03:22:37', '2025-03-29 03:22:37'),
(19, 'kj', 'kj@gmail.com', '$2y$12$OiUIY/SRzruC/Eu.DyV9vOVR8TLs/RI7aGpN.flq55NspFanGPDY6', 'komunitas', '2025-03-29 09:57:28', '2025-03-29 09:57:28'),
(20, 'cika', 'cika@gmail.com', '$2y$12$u7pVWrgVAliggW4y/bXOmOkU8NVkTkz3g71c9mkKQvHmHjl7chppq', 'komunitas', '2025-04-08 07:00:32', '2025-04-08 07:00:32'),
(21, 'gamango', 'gamang@gmail.com', '$2y$12$Q1BQ7PNHreop/aFIpXvdT.jM385tTDfvdGAt/r2ETyPYMUYYruM/e', 'komunitas', '2025-04-09 21:33:45', '2025-04-09 21:33:45'),
(22, 'gemang', 'gemang@gmmai.com', '$2y$12$5kN4ru7.45yoNLwjFs/6MOEutFV0ac.bozeB/znE/5Bq7wAg6omIO', 'komunitas', '2025-04-09 23:44:39', '2025-04-09 23:44:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

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
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id_komunitas`),
  ADD UNIQUE KEY `komunitas_no_telp_unique` (`no_telp`),
  ADD KEY `komunitas_id_user_foreign` (`id_user`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id_komunitas` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD CONSTRAINT `komunitas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
