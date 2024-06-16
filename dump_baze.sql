-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 02:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vacation_tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
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
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uloga_id` bigint(20) UNSIGNED NOT NULL COMMENT '1. Administrator, 2. Menadzer, 3. Korisnik',
  `tim_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ime` varchar(255) NOT NULL DEFAULT '',
  `prezime` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `broj_dana_godisnjeg_odmora` int(11) NOT NULL DEFAULT 0,
  `broj_slobodnih_dana` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `uloga_id`, `tim_id`, `ime`, `prezime`, `email`, `password`, `broj_dana_godisnjeg_odmora`, `broj_slobodnih_dana`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 7, 'Saul', 'Sipes', 'vsmitham@gmail.com', '$2y$12$MpKMihN6/pb9uO4hm2dWc.EMCy7m9SsQ6skl8IizBOz5gUebLR5/a', 13, 5, '2024-06-15 19:40:06', '2024-06-16 10:11:05', NULL),
(2, 3, 7, 'Madelyn', 'Champlin', 'gheaney@cartwright.com', '$2y$12$FKn3nxfyZAUz6mOhzmFOSOTMVwJtY7LCDK/nrYPVgNTGOwsCeMrAC', 20, 5, '2024-06-15 19:40:07', '2024-06-15 19:40:07', NULL),
(3, 1, 11, 'Adalberto', 'Wolff', 'rgibson@spencer.com', '$2y$12$DOwR/bMpQJfzamYMfwt7lOgC9Ov0GMeV8WF09ZlE9UeFA/AVwvN3K', 20, 5, '2024-06-15 19:40:07', '2024-06-15 19:40:07', NULL),
(4, 1, 20, 'Renee', 'Effertz', 'rhoda.mckenzie@hotmail.com', '$2y$12$Up.BiYQQ3VfWId/X/fCtCe8VzjVR/zTy2UhwLsFp0pVL8FNqIAMDe', 20, 5, '2024-06-15 19:40:07', '2024-06-15 21:14:17', NULL),
(5, 3, 13, 'Micaela', 'Haley', 'kara.ryan@torp.biz', '$2y$12$V705u4pgyqCnn7sfOEs/6.6UInm3wTT1S/ts034GeBDxaeBJDu/.C', 20, 5, '2024-06-15 19:40:08', '2024-06-15 19:40:08', NULL),
(6, 2, 20, 'Noelia', 'Bode', 'fgibson@hotmail.com', '$2y$12$c4OzDnB4oIH6Dj4OhSWBgeQRkm7ux.7KI9fWni/eIT5z1ApeGpUx.', 20, 5, '2024-06-15 19:40:08', '2024-06-15 19:40:08', NULL),
(7, 2, 6, 'Lesley', 'Lakin', 'murphy.aaron@beer.info', '$2y$12$h5PQLBIDzdbyjTtNieFzQObqS1UStztn7ygSoDwGuqYkDhHTG.ysm', 20, 5, '2024-06-15 19:40:08', '2024-06-15 19:40:08', NULL),
(8, 1, 17, 'Arno', 'Harber', 'jaida17@gmail.com', '$2y$12$uFfFS.1nYd79BnFIuAGGfun1FgYM0FFvLv9Lwru0Sk3g.XQ1E5R1K', 20, 5, '2024-06-15 19:40:09', '2024-06-15 19:40:09', NULL),
(9, 1, 19, 'Euna', 'Feest', 'daniela.corkery@daugherty.info', '$2y$12$F6v2nscsk7faXm9mDkqvWu00s9oY3fgLb.gmMYvbkcxvhSJcdZ9/W', 20, 5, '2024-06-15 19:40:09', '2024-06-15 19:40:09', NULL),
(10, 3, 4, 'Clovis', 'Schmidt', 'msanford@lesch.com', '$2y$12$MuOX26.5tJ7.AnZJHz5QS.U1NR2quiiCbN1lwTVLrC9rTPTj7RSTG', 20, 5, '2024-06-15 19:40:09', '2024-06-15 19:40:09', NULL),
(11, 3, 1, 'Drake', 'Carroll', 'loreilly@yahoo.com', '$2y$12$Nhv9ua9BgmyvQVCktqPeXuN6a.PnXuq650qWXdyOxbYWk3Dl7J8Q.', 20, 5, '2024-06-15 19:40:10', '2024-06-15 19:40:10', NULL),
(12, 1, 19, 'Jan', 'Lebsack', 'anabelle08@collier.com', '$2y$12$sgV0PGw6.gC2XKzHkK4vR.7OXgGZnfozu65ehm0zPa7et2pssK8lu', 20, 5, '2024-06-15 19:40:10', '2024-06-15 19:40:10', NULL),
(13, 2, 20, 'Irma', 'Hermann', 'runolfsson.anita@marquardt.com', '$2y$12$fcFkLXCRzIp3A6FqZWDMeu7/sU9c7Ka7wcrGTOoEtK3VbjKjaN3l2', 20, 5, '2024-06-15 19:40:10', '2024-06-16 07:20:18', NULL),
(14, 3, 9, 'Rosa', 'Murazik', 'predovic.hortense@wunsch.org', '$2y$12$VsgmAPXxbwEdVU9KLNb2kewE8SdXNzv2kbPeIQW9FaK7OUuoZfNBy', 20, 5, '2024-06-15 19:40:10', '2024-06-15 19:40:10', NULL),
(15, 1, 2, 'Davion', 'Deckow', 'wschowalter@wiegand.com', '$2y$12$2pFqnvsjPhl.CN07amXg9.y5A6uTlHYyJKvXBISED4DKy8ESTXZYi', 20, 5, '2024-06-15 19:40:11', '2024-06-15 19:40:11', NULL),
(16, 3, 11, 'Gabriel', 'Dach', 'mann.winona@lockman.com', '$2y$12$5efAqy5ErP.R0gu1QoQDsOdT5MgrME0ue2pqz4DxWW83quOalvTTu', 20, 5, '2024-06-15 19:40:11', '2024-06-15 19:40:11', NULL),
(17, 2, 5, 'Gillian', 'Lubowitz', 'carmela85@hotmail.com', '$2y$12$y7PyAe4k03YqISHdb81W1OJ4PDtJEmk1gPvUtYVZraLgN8i947y3e', 20, 5, '2024-06-15 19:40:11', '2024-06-15 19:40:11', NULL),
(18, 1, 12, 'Yoshiko', 'Kessler', 'florence58@yahoo.com', '$2y$12$ZCEgoZ4AfuKnahcDq7EMTeuok7dM54Oj7bXmWausbV6TKNn1hNZ7m', 20, 5, '2024-06-15 19:40:12', '2024-06-15 19:40:12', NULL),
(19, 1, 15, 'Jaqueline', 'Haley', 'zskiles@yahoo.com', '$2y$12$fUvzIHGTgwr3eAqJcYTtXOMXdgYjhDeCYLGTwHLPt7ZFxNdieoIUe', 20, 5, '2024-06-15 19:40:12', '2024-06-15 19:40:12', NULL),
(20, 2, 16, 'Paris', 'Cormier', 'qhoeger@hotmail.com', '$2y$12$ytGtLpGpRS2LHz6QCXTLF.Niaetc3ttfKNY79kQrvz7r04VGJ7zRi', 20, 5, '2024-06-15 19:40:12', '2024-06-16 07:57:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_12_203845_create_personal_access_tokens_table', 1),
(5, '2024_06_13_191501_create_uloga_table', 1),
(6, '2024_06_13_191508_create_tim_table', 1),
(7, '2024_06_13_191522_create_tip_zahteva_table', 1),
(8, '2024_06_13_191545_create_korisnik_table', 1),
(9, '2024_06_13_191556_create_tim_korisnik', 1),
(10, '2024_06_13_191606_create_tim_zahtev', 1),
(11, '2024_06_15_191233_alter_korisnik_table', 1),
(12, '2024_06_15_194243_drop_table_tim_korisnik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\Korisnik', 4, 'LOGIN_TOKEN', '975aa629ace6adabfd7d3ec97b28c24b774ca9bd05e1188ef3524f652485f1be', '[\"*\"]', NULL, NULL, '2024-06-15 20:11:13', '2024-06-15 20:11:13'),
(6, 'App\\Models\\Korisnik', 4, 'LOGIN_TOKEN', '7925101c624a09ac0bce1d7f8bab7979abecb10ed4be2b92a332ec5497cb1be1', '[\"*\"]', NULL, NULL, '2024-06-16 07:27:09', '2024-06-16 07:27:09'),
(7, 'App\\Models\\Korisnik', 20, 'LOGIN_TOKEN', '69e6a5f220bc7c023357a62c86ba4a3be4b580e10f30c66a08da6597bebd5537', '[\"*\"]', '2024-06-16 10:03:38', NULL, '2024-06-16 07:27:22', '2024-06-16 10:03:38'),
(8, 'App\\Models\\Korisnik', 20, 'LOGIN_TOKEN', 'daefc40cdebf5d09eaa9aaac5f27da809366217737e6a82faa5df4a510216a0b', '[\"*\"]', '2024-06-16 10:02:16', NULL, '2024-06-16 07:55:40', '2024-06-16 10:02:16'),
(9, 'App\\Models\\Korisnik', 1, 'LOGIN_TOKEN', '36e29734797ac0d83b6dc8f0f98ccb817f766ab50f262039aad2b22dac946ea0', '[\"*\"]', '2024-06-16 10:35:41', NULL, '2024-06-16 10:07:13', '2024-06-16 10:35:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naziv` varchar(255) NOT NULL DEFAULT '',
  `opis` varchar(1024) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `naziv`, `opis`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tim 1', 'Cumque sint voluptas nihil qui. Voluptatem minus aperiam qui omnis. Non est et sed.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(2, 'Tim 2', 'Qui aut qui dolor nulla ut iste. Et ut molestiae quia eum. Aliquam iure magnam totam voluptates.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(3, 'Tim 3', 'Dolores sequi occaecati et et qui. Autem consequatur aliquid id et blanditiis a.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(4, 'Tim 4', 'Doloremque deleniti officia sunt. Et ut officiis ea inventore.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(5, 'Tim 5', 'Eos est est atque rerum voluptatibus. Esse ut porro quis velit.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(6, 'Tim 6', 'Ea sit quam dolor quos dolorum voluptatem. Ut accusantium dolorem pariatur culpa sit omnis tempora.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(7, 'Tim 7', 'Ut saepe nihil et voluptatem nobis. Eos adipisci dolorem et in temporibus. Velit ab rerum atque et.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(8, 'Tim 8', 'Sint est fugiat reprehenderit sequi quam ea. Quod hic est atque in ea illum unde.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(9, 'Tim 9', 'Non sapiente autem est voluptatem inventore ea. Odit laboriosam tempore qui.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(10, 'Tim 10', 'Dicta odit aut et eos. Repellendus pariatur est tenetur sunt.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(11, 'Tim 11', 'Est culpa et nostrum saepe atque. Possimus et omnis totam. Autem assumenda error incidunt saepe.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(12, 'Tim 12', 'Dolorem dolores veritatis ut sed. Numquam possimus soluta fugit quis similique expedita fugit.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(13, 'Tim 13', 'Beatae iusto voluptatum quia qui iusto eum est. Perspiciatis porro nihil explicabo illum quod sint.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(14, 'Tim 14', 'Omnis vel quo voluptatum omnis. Quae debitis corporis sapiente magnam alias.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(15, 'Tim 15', 'Et nihil saepe perferendis et officiis. Quam ducimus et non veritatis reiciendis veritatis et.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(16, 'Tim 16', 'Magni voluptas voluptas ad inventore sed soluta. Eos aperiam inventore ut quidem.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(17, 'Tim 17', 'Placeat enim et praesentium voluptas. Ut ex et suscipit assumenda cupiditate. Quas qui dolorem sit.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(18, 'Tim 18', 'Consequuntur fugit eum quo molestias. Ut voluptatum possimus molestiae exercitationem.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(19, 'Tim 19', 'Non accusantium provident consequatur voluptatem. Quis et nulla enim placeat.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL),
(20, 'Tim 20', 'Quas ipsam totam aut qui eos. Soluta et iure nobis expedita sunt asperiores et.', '2024-06-15 19:40:06', '2024-06-15 19:40:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tip_zahteva`
--

CREATE TABLE `tip_zahteva` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naziv` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tip_zahteva`
--

INSERT INTO `tip_zahteva` (`id`, `naziv`) VALUES
(1, 'Godišnji odmor'),
(2, 'Slobodan dan');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naziv` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Menadzer'),
(3, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zahtev`
--

CREATE TABLE `zahtev` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `korisnik_id` bigint(20) UNSIGNED NOT NULL,
  `tip_zahteva_id` bigint(20) UNSIGNED NOT NULL COMMENT '1. Godisnji odmor, 2. Slobodan dan',
  `datum_od` date DEFAULT NULL,
  `datum_do` date DEFAULT NULL,
  `broj_dana` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0. Na cekanju, 1. Odobren, 2. Odbijen',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zahtev`
--

INSERT INTO `zahtev` (`id`, `korisnik_id`, `tip_zahteva_id`, `datum_od`, `datum_do`, `broj_dana`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 1, '2024-06-20', '2024-06-30', 7, 0, '2024-06-16 10:01:47', '2024-06-16 10:01:47', NULL),
(2, 20, 1, '2024-07-24', '2024-07-29', 4, 0, '2024-06-16 10:03:35', '2024-06-16 10:03:35', NULL),
(3, 1, 1, '2024-06-20', '2024-06-29', 7, 1, '2024-06-16 10:08:22', '2024-06-16 10:11:05', NULL),
(4, 1, 1, '2024-07-02', '2024-07-05', 4, 0, '2024-06-16 10:21:25', '2024-06-16 10:35:37', '2024-06-16 10:35:37'),
(5, 1, 1, '2024-07-06', '2024-07-08', 1, 2, '2024-06-16 10:22:04', '2024-06-16 10:22:04', NULL);

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
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnik_email_unique` (`email`),
  ADD KEY `korisnik_uloga_id_foreign` (`uloga_id`),
  ADD KEY `korisnik_tim_id_foreign` (`tim_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_zahteva`
--
ALTER TABLE `tip_zahteva`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zahtev_korisnik_id_foreign` (`korisnik_id`),
  ADD KEY `zahtev_tip_zahteva_id_foreign` (`tip_zahteva_id`);

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
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tip_zahteva`
--
ALTER TABLE `tip_zahteva`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zahtev`
--
ALTER TABLE `zahtev`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_tim_id_foreign` FOREIGN KEY (`tim_id`) REFERENCES `tim` (`id`),
  ADD CONSTRAINT `korisnik_uloga_id_foreign` FOREIGN KEY (`uloga_id`) REFERENCES `uloga` (`id`);

--
-- Constraints for table `zahtev`
--
ALTER TABLE `zahtev`
  ADD CONSTRAINT `zahtev_korisnik_id_foreign` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `zahtev_tip_zahteva_id_foreign` FOREIGN KEY (`tip_zahteva_id`) REFERENCES `tip_zahteva` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
