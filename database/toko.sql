-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 06:04 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_31_231830_create_mstoko_table', 2),
(5, '2025_03_31_232000_create_msbarang_table', 2),
(6, '2025_03_31_232102_create_msstok_table', 2),
(7, '2025_03_31_232725_create_tspenjualan_table', 2),
(8, '2025_03_31_232855_create_mscompany_table', 2),
(9, '2025_03_31_234827_add_idcompany_and_idtoko_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `msbarang`
--

CREATE TABLE `msbarang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcompany` bigint(20) NOT NULL,
  `namebarang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `msbarang`
--

INSERT INTO `msbarang` (`id`, `idcompany`, `namebarang`, `harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'unta', '200001.00', '2025-04-02 06:43:00', '2025-04-02 06:48:58'),
(3, 1, 'baut', '200001.00', '2025-04-02 06:43:00', '2025-04-02 06:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `mscompany`
--

CREATE TABLE `mscompany` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namecompany` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamatcompany` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logocompany` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailcompany` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msstok`
--

CREATE TABLE `msstok` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idproduk` bigint(20) NOT NULL,
  `idtoko` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `msstok`
--

INSERT INTO `msstok` (`id`, `idproduk`, `idtoko`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 29, '2025-04-02 17:55:36', '2025-04-10 20:22:34'),
(2, 3, 2, 12, '2025-04-02 19:03:09', '2025-04-02 19:03:13'),
(3, 3, 1, 19, '2025-04-10 01:48:40', '2025-04-10 20:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `mstoko`
--

CREATE TABLE `mstoko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nametoko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamattoko` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mstoko`
--

INSERT INTO `mstoko` (`id`, `nametoko`, `alamattoko`, `created_at`, `updated_at`) VALUES
(1, 'toko1', 'alamat231', '2025-04-02 06:03:37', '2025-04-02 00:15:38'),
(2, 'toko2', 'toko12', '2025-04-02 06:00:46', '2025-04-02 06:00:46'),
(3, 'toko3', 'toko31', '2025-04-10 01:53:51', '2025-04-10 01:54:02');

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
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1NiBfhGZRFCQ5BRgs6I1zCOfiG19gSvpPYOy3SlH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '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', 1744344331),
('AYwkGoybCN2gFId2K5PWMFjTUHltnhF7IcD6DjSu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaTNacFlFMWVoWVZ2SjlUaEdUY0VnbTBueWxnUnUxdEp0NlUzeGdPeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744344367),
('fEa2LSaNLoZg5TC1aLQt9ooeS28grWxXkV1OQH6G', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', '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', 1744353757),
('oaL8I3Y4vgGID6urUiFTIWKK2GUQFpckcydzEMpI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT2ZTUVE0N3FsMHVVSXZHR1d4Z2NEZFdmTGFpTWpHSU1Bb09FVGY0OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1744395475),
('WWM3LPDF8Zo6jeUQoMVTtIdHrYWRHKUhXp8MUO19', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieGFETUtvbmFsNFYwMU1wTENlS0NSMXJaRUxkN1N5alhSckdySk1SdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5qdWFsYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjQ6InVzZXIiO086MjU6IkFwcFxNb2RlbHNcQXV0aFxVc2VyTW9kZWwiOjMwOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InVzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTE6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6NToidG9rbzEiO3M6NToiZW1haWwiO3M6MTU6InRva28xQGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJDhMdmNyUHZYWTBZci9HTGdFUlhYOWU5NHg4TkNVNmJYSE9wUS9aTFJaWG5vZ1N1dzM5VVJXIjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047czo5OiJpZGNvbXBhbnkiO2k6MTtzOjY6ImlkdG9rbyI7aToxO3M6ODoidXNlcm5hbWUiO3M6NToidG9rbzEiO31zOjExOiIAKgBvcmlnaW5hbCI7YToxMTp7czoyOiJpZCI7aToxO3M6NDoibmFtZSI7czo1OiJ0b2tvMSI7czo1OiJlbWFpbCI7czoxNToidG9rbzFAZ21haWwuY29tIjtzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7TjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkOEx2Y3JQdlhZMFlyL0dMZ0VSWFg5ZTk0eDhOQ1U2YlhIT3BRL1pMUlpYbm9nU3V3MzlVUlciO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7TjtzOjk6ImlkY29tcGFueSI7aToxO3M6NjoiaWR0b2tvIjtpOjE7czo4OiJ1c2VybmFtZSI7czo1OiJ0b2tvMSI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MDp7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YTowOnt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6Nzp7aTowO3M6NDoibmFtZSI7aToxO3M6NToiZW1haWwiO2k6MjtzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7aTozO3M6ODoidXNlcm5hbWUiO2k6NDtzOjg6InBhc3N3b3JkIjtpOjU7czo5OiJpZGNvbXBhbnkiO2k6NjtzOjY6ImlkdG9rbyI7fXM6MTA6IgAqAGd1YXJkZWQiO2E6MTp7aTowO3M6MToiKiI7fX19', 1744344345),
('ysvJmsY6P8GzdSOWWhP0PbyjCCu0IPCAvNtiVAaz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:138.0) Gecko/20100101 Firefox/138.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlRHczdVNzNVR2gweWhOWUZaM1NaTFFTU2VnOUJPeldtYVdKWkRFUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW5qdWFsYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1744344216);

-- --------------------------------------------------------

--
-- Table structure for table `tspenjualan`
--

CREATE TABLE `tspenjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idstok` bigint(20) NOT NULL,
  `idtoko` bigint(20) NOT NULL,
  `idbarang` bigint(20) NOT NULL,
  `jual` int(11) NOT NULL,
  `hargajual` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tspenjualan`
--

INSERT INTO `tspenjualan` (`id`, `idstok`, `idtoko`, `idbarang`, `jual`, `hargajual`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, NULL, '2025-04-10 09:55:30', '2025-04-29 09:55:35'),
(2, 2, 2, 3, 10, NULL, '2025-04-10 13:20:46', '2025-04-10 13:20:50'),
(3, 1, 1, 1, 14, NULL, '2025-04-10 14:24:05', '2025-04-10 14:24:08'),
(4, 1, 1, 3, 10, NULL, '2025-04-10 14:45:34', '2025-04-10 14:45:37'),
(5, 3, 1, 3, 3, 600003.00, '2025-04-10 20:17:10', '2025-04-10 20:17:10'),
(6, 3, 1, 3, 1, 200001.00, '2025-04-10 20:17:40', '2025-04-10 20:17:40'),
(7, 1, 1, 1, 4, 800004.00, '2025-04-10 20:21:09', '2025-04-10 20:21:09'),
(8, 1, 1, 1, 2, 400002.00, '2025-04-10 20:22:04', '2025-04-10 20:22:04'),
(9, 3, 1, 3, 2, 400002.00, '2025-04-10 20:22:34', '2025-04-10 20:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idcompany` bigint(20) UNSIGNED DEFAULT NULL,
  `idtoko` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `idcompany`, `idtoko`, `username`) VALUES
(1, 'toko1', 'toko1@gmail.com', NULL, '$2y$12$8LvcrPvXY0Yr/GLgERXX9e94x8NCU6bXHOpQ/ZLRZXnogSuw39URW', NULL, NULL, NULL, 1, 1, 'toko1'),
(2, 'toko2', 'toko2@gmail.com', NULL, '$2y$12$8LvcrPvXY0Yr/GLgERXX9e94x8NCU6bXHOpQ/ZLRZXnogSuw39URW', NULL, NULL, NULL, 1, 2, 'toko2'),
(3, 'super', 'super@gmail.com', NULL, '$2y$12$8LvcrPvXY0Yr/GLgERXX9e94x8NCU6bXHOpQ/ZLRZXnogSuw39URW', NULL, NULL, NULL, 1, NULL, 'super');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msbarang`
--
ALTER TABLE `msbarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mscompany`
--
ALTER TABLE `mscompany`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msstok`
--
ALTER TABLE `msstok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mstoko`
--
ALTER TABLE `mstoko`
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
-- Indexes for table `tspenjualan`
--
ALTER TABLE `tspenjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `msbarang`
--
ALTER TABLE `msbarang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mscompany`
--
ALTER TABLE `mscompany`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msstok`
--
ALTER TABLE `msstok`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mstoko`
--
ALTER TABLE `mstoko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tspenjualan`
--
ALTER TABLE `tspenjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
