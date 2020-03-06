-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Mar 2020 pada 10.42
-- Versi server: 8.0.13
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_admin`
--

CREATE TABLE `api_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1. superadmin 2. admin 3. developer',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 active',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `api_admin`
--

INSERT INTO `api_admin` (`id`, `name`, `password`, `email`, `role`, `enable`, `created`) VALUES
(1, 'Ibnu Maksum', '$2y$10$hXkSbly/Tp9046gAQM0XjezMswGgBpWhx7sBfx42MzDPe78z8keDO', 'me@ibnux.net', 1, 1, '2020-03-05 15:30:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_auth`
--

CREATE TABLE `api_auth` (
  `id` int(11) NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `jwt_secret` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `expired` int(11) NOT NULL DEFAULT '24' COMMENT 'hours',
  `header` varchar(16) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'x-auth'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_db`
--

CREATE TABLE `api_db` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `db_type` enum('mysql','mssql','oracle','pgsql') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `db_host` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `db_name` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `db_user` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `db_pass` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `environment` enum('development','staging','production') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_groups`
--

CREATE TABLE `api_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_routes`
--

CREATE TABLE `api_routes` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `environment` enum('development','staging','production') COLLATE utf8mb4_general_ci NOT NULL,
  `version` tinyint(3) NOT NULL,
  `category` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'uncategory' COMMENT 'send',
  `function` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'sms',
  `methods` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'GET,POST,PUT,DELETE,PATCH' COMMENT 'GET,POST,PUT,DELETE,PATCH',
  `route_type` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '''http'',''sql'',''php'',''plain'',''echo''',
  `content_type` varchar(128) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'application/json' COMMENT 'application/json',
  `db_id` int(11) NOT NULL DEFAULT '0',
  `auth_id` int(11) NOT NULL DEFAULT '0',
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `retry` int(11) NOT NULL DEFAULT '3',
  `retry_delay` int(11) NOT NULL DEFAULT '30',
  `timeout` int(11) NOT NULL DEFAULT '30',
  `enabled` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 enabled',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_stats`
--

CREATE TABLE `api_stats` (
  `date` date NOT NULL,
  `route_id` int(11) NOT NULL,
  `0` int(11) NOT NULL DEFAULT '0',
  `1` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `3` int(11) NOT NULL DEFAULT '0',
  `4` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL DEFAULT '0',
  `6` int(11) NOT NULL DEFAULT '0',
  `7` int(11) NOT NULL DEFAULT '0',
  `8` int(11) NOT NULL DEFAULT '0',
  `9` int(11) NOT NULL DEFAULT '0',
  `10` int(11) NOT NULL DEFAULT '0',
  `11` int(11) NOT NULL DEFAULT '0',
  `12` int(11) NOT NULL DEFAULT '0',
  `13` int(11) NOT NULL DEFAULT '0',
  `14` int(11) NOT NULL DEFAULT '0',
  `15` int(11) NOT NULL DEFAULT '0',
  `16` int(11) NOT NULL DEFAULT '0',
  `17` int(11) NOT NULL DEFAULT '0',
  `18` int(11) NOT NULL DEFAULT '0',
  `19` int(11) NOT NULL DEFAULT '0',
  `20` int(11) NOT NULL DEFAULT '0',
  `21` int(11) NOT NULL DEFAULT '0',
  `22` int(11) NOT NULL DEFAULT '0',
  `23` int(11) NOT NULL DEFAULT '0',
  `sum` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `api_admin`
--
ALTER TABLE `api_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `api_auth`
--
ALTER TABLE `api_auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `api_db`
--
ALTER TABLE `api_db`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `api_groups`
--
ALTER TABLE `api_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `api_routes`
--
ALTER TABLE `api_routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `path` (`function`),
  ADD KEY `category` (`category`);

--
-- Indeks untuk tabel `api_stats`
--
ALTER TABLE `api_stats`
  ADD PRIMARY KEY (`date`,`route_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `api_admin`
--
ALTER TABLE `api_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `api_auth`
--
ALTER TABLE `api_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `api_db`
--
ALTER TABLE `api_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `api_groups`
--
ALTER TABLE `api_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `api_routes`
--
ALTER TABLE `api_routes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
