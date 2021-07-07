-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2021 pada 04.31
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `junior-test`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `logo`, `created_at`, `updated_at`) VALUES
(9, 'PT.Tunas Karya', 'tunas.karya@office.co.id', 'icons8-star-96.png', '2021-06-30 18:17:23', '2021-07-03 09:32:02'),
(11, 'PT.Podomoro', 'podomoro@gmail.com', 'icons8-search-150.png', '2021-06-30 19:32:23', '2021-07-03 09:27:43'),
(12, 'PT.AGR', 'agr@email.com', 'icons8-camera-100.png', '2021-06-30 19:32:54', '2021-07-03 09:26:16'),
(13, 'PT.MNC', 'mnc@office.co.id', 'icons8-search-150.png', '2021-06-30 19:33:19', '2021-07-03 09:53:38'),
(15, 'PT.AGRIYA', 'agriya@gmail.com', 'close.png', '2021-06-30 19:34:24', '2021-06-30 19:34:24'),
(16, 'MNC Group', 'mnc.group@gmail.com', 'cover.jpg', '2021-06-30 19:35:06', '2021-06-30 19:35:06'),
(17, 'PT.Akira', 'akira@gmail.co.id', 'p4.png', '2021-06-30 19:38:12', '2021-06-30 19:38:12'),
(18, 'PT.Cryp', 'cryp@gmail.com', 'p3.jpg', '2021-06-30 19:38:42', '2021-06-30 19:38:42'),
(19, 'PT.Agar', 'agar@gmail.com', 'close.png', '2021-06-30 19:39:09', '2021-06-30 19:39:09'),
(21, 'SCTV Group', 'sctv@gmail.com', 'kiluan2.jpg', '2021-07-03 11:14:24', '2021-07-03 11:14:24'),
(22, 'PT.jaya', 'jaya@gmail.com', 'Maladewa-Lampung.jpg', '2021-07-03 11:15:17', '2021-07-03 11:15:17'),
(27, 'PT.AgungSukma', 'sukma@gmail.com', '9f04155f5da92e280eb89d1866e162fa.jpg', '2021-07-03 11:27:06', '2021-07-03 11:27:06'),
(29, 'PT.SumberPadi', 'sumberpadi@gmail.com', 'Capture.PNG', '2021-07-03 11:28:42', '2021-07-03 11:28:42'),
(32, 'PT.Sido', 'sido@gmail.com', 'mahitam.jpg', '2021-07-03 11:31:27', '2021-07-03 11:31:27'),
(47, 'PT.BerasKencur', 'kencur@gmail.com', 'mahitam.jpg', '2021-07-03 11:56:14', '2021-07-03 11:56:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `company_id`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'ravi', 'prayoga', 9, 'raviprayoga534@gmail.com', '085763885183', '2021-07-03 00:00:20', '2021-07-03 00:00:20'),
(3, 'Budi', 'Santoso', 13, 'olip@gmail.com', '085763885182', '2021-07-03 02:57:15', '2021-07-03 10:37:15'),
(4, 'ahmad', 'rudi', 12, 'rudi@gmail.com', '081311221212', '2021-07-03 10:42:47', '2021-07-03 10:42:47'),
(5, 'samuel', 'fernando', 17, 'samuel@gmail.com', '085732313332', '2021-07-03 10:43:27', '2021-07-03 10:43:27'),
(6, 'mufid', 'lukman', 11, 'mufid@gmail.com', '08197788123', '2021-07-03 10:44:01', '2021-07-03 10:44:01'),
(7, 'Bento', 'darminto', 15, 'bento@gmail.com', '087756531878', '2021-07-03 10:44:38', '2021-07-03 10:44:38'),
(8, 'markus', 'horizon', 12, 'markus@gmail.com', '089877998231', '2021-07-03 10:45:27', '2021-07-03 10:45:27'),
(9, 'muzak', 'rahmat', 18, 'muzak@gmail.com', '089877517632', '2021-07-03 10:45:55', '2021-07-03 12:05:20'),
(10, 'slamet', 'riadi', 21, 'riadi@gmail.com', '081367648131', '2021-07-03 12:05:54', '2021-07-03 12:05:54'),
(11, 'bahrur', 'razak', 47, 'razzak@gmail.com', '08132124323', '2021-07-03 12:06:30', '2021-07-03 12:06:30'),
(12, 'junaidi', 'karo', 11, 'karo@gmail.com', '089787876362', '2021-07-03 12:07:00', '2021-07-03 12:07:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
