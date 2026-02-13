-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Feb 2026 pada 07.08
-- Versi server: 10.6.24-MariaDB-cll-lve
-- Versi PHP: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eskalabe_sarprasin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirations`
--

CREATE TABLE `aspirations` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1=Pending, 2=In Progress, 3=Done, 4=Reject',
  `feedback` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aspirations`
--

INSERT INTO `aspirations` (`id`, `complaint_id`, `status`, `feedback`, `image`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 5, 1, NULL, NULL, '2026-01-11 05:52:58', 3, '2026-01-11 05:52:58', NULL, NULL, NULL),
(2, 6, 3, 'sudah selesai', NULL, '2026-01-12 22:51:00', 3, '2026-01-17 05:37:05', 3, NULL, NULL),
(3, 7, 1, NULL, NULL, '2026-01-13 07:31:57', 3, '2026-01-13 08:35:02', 3, NULL, NULL),
(4, 8, 2, 'sedang di perbaiki', NULL, '2026-01-13 17:48:19', 3, '2026-01-17 05:34:38', 3, NULL, NULL),
(5, 9, 1, NULL, NULL, '2026-01-17 05:39:06', 3, '2026-01-17 05:39:06', NULL, NULL, NULL),
(6, 10, 1, 'fotonya yang jelas', NULL, '2026-01-17 05:39:54', 3, '2026-01-27 04:23:55', 3, NULL, NULL),
(7, 11, 3, 'sudah selesai bisa di cek', NULL, '2026-01-18 20:27:48', 3, '2026-01-21 02:09:57', 1, NULL, NULL),
(8, 12, 1, NULL, NULL, '2026-01-20 02:00:51', 3, '2026-01-27 06:38:19', 3, NULL, NULL),
(9, 13, 3, '-', NULL, '2026-01-24 12:09:56', 8, '2026-01-24 13:02:42', 1, NULL, NULL),
(10, 14, 1, NULL, NULL, '2026-01-26 08:07:53', 3, '2026-01-26 08:07:53', NULL, NULL, NULL),
(11, 15, 2, 'sedang dalam perbaikan', NULL, '2026-02-03 12:24:58', 8, '2026-02-03 12:28:57', 1, NULL, NULL),
(12, 16, 1, NULL, NULL, '2026-02-03 12:35:01', 8, '2026-02-03 12:35:01', NULL, NULL, NULL),
(13, 17, 1, NULL, NULL, '2026-02-03 13:19:11', 8, '2026-02-03 13:19:11', NULL, NULL, NULL),
(14, 18, 1, 'gambar tidak jelas', NULL, '2026-02-03 14:28:49', 8, '2026-02-06 09:55:07', 8, NULL, NULL),
(15, 19, 3, 'kabel lan sudah di perbaiki', NULL, '2026-02-06 09:53:16', 8, '2026-02-06 09:55:33', 1, NULL, NULL),
(16, 20, 1, NULL, NULL, '2026-02-10 04:01:15', 8, '2026-02-10 04:01:15', NULL, NULL, NULL),
(17, 21, 3, 'sudah selesai bisa di check', 'uploads/aspirations/1770701157_camera_capture_1770701141798.jpg', '2026-02-10 05:23:12', 8, '2026-02-10 05:25:57', 1, NULL, NULL),
(18, 22, 1, NULL, NULL, '2026-02-11 03:06:45', 8, '2026-02-11 03:06:45', NULL, NULL, NULL),
(19, 23, 1, NULL, NULL, '2026-02-11 03:08:04', 8, '2026-02-11 03:08:04', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspiration_status_logs`
--

CREATE TABLE `aspiration_status_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `aspiration_id` bigint(20) UNSIGNED NOT NULL,
  `old_status` tinyint(4) DEFAULT NULL,
  `new_status` tinyint(4) NOT NULL,
  `note` text DEFAULT NULL,
  `changed_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aspiration_status_logs`
--

INSERT INTO `aspiration_status_logs` (`id`, `aspiration_id`, `old_status`, `new_status`, `note`, `changed_by`, `created_at`) VALUES
(1, 7, 1, 1, 'sabar kami validasi dulu', 1, '2026-01-19 18:50:01'),
(2, 7, 1, 2, 'sedang di perbaiki', 1, '2026-01-19 18:50:25'),
(3, 7, 2, 3, 'sudah selesai bisa di cek', 1, '2026-01-21 02:09:57'),
(4, 6, 1, 1, 'fotonya yang jelas', 1, '2026-01-21 03:17:35'),
(5, 6, 1, 4, 'fotonya yang jelas', 1, '2026-01-21 03:26:00'),
(6, 6, 4, 1, 'fotonya yang jelas', 1, '2026-01-22 00:43:47'),
(7, 6, 1, 4, 'fotonya yang jelas', 1, '2026-01-22 00:46:58'),
(8, 6, 4, 4, 'fotonya yang jelas', 1, '2026-01-22 00:51:59'),
(9, 9, 1, 4, 'gambar tidak jelas', 1, '2026-01-24 12:10:18'),
(10, 9, 4, 1, '-', 1, '2026-01-24 12:11:43'),
(11, 9, 1, 4, '-', 1, '2026-01-24 12:14:45'),
(12, 9, 4, 1, 'Otomatis kembali ke Pending karena aduan diedit oleh siswa.', 8, '2026-01-24 12:15:00'),
(13, 9, 1, 2, '-', 1, '2026-01-24 12:15:20'),
(14, 9, 2, 3, '-', 1, '2026-01-24 13:02:42'),
(15, 6, 4, 1, 'Otomatis kembali ke Pending karena aduan diedit oleh siswa.', 3, '2026-01-27 04:23:55'),
(16, 11, 1, 2, 'sedang dalam perbaikan', 1, '2026-02-03 12:28:57'),
(17, 15, 1, 2, 'akan segera di perbaiki', 1, '2026-02-06 09:54:07'),
(18, 14, 1, 4, 'gambar tidak jelas', 1, '2026-02-06 09:54:49'),
(19, 14, 4, 1, 'Otomatis kembali ke Pending karena aduan diedit oleh siswa.', 8, '2026-02-06 09:55:07'),
(20, 15, 2, 3, 'kabel lan sudah di perbaiki', 1, '2026-02-06 09:55:33'),
(21, 17, 1, 2, 'sedang di perbaiki', 1, '2026-02-10 05:24:34'),
(22, 17, 2, 3, 'sudah selesai bisa di check', 1, '2026-02-10 05:25:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `classrooms`
--

INSERT INTO `classrooms` (`id`, `class_name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'X RPL 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(2, 'X RPL 2', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(3, 'X TKJ 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(4, 'X DKV 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(5, 'X ATPH 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(6, 'X APT 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(7, 'X TBSM 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(8, 'X TKRO 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(9, 'XI RPL 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(10, 'XI RPL 2', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(11, 'XI TKJ 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(12, 'XI DKV 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(13, 'XI ATPH 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(14, 'XI APT 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(15, 'XI TBSM 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(16, 'XI TKRO 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(17, 'XII RPL 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(18, 'XII RPL 2', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(19, 'XII TKJ 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(20, 'XII DKV 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(21, 'XII ATPH 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(22, 'XII APT 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(23, 'XII TBSM 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL),
(24, 'XII TKRO 1', '2026-02-06 02:47:49', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `facility_category_id` int(11) DEFAULT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `complaints`
--

INSERT INTO `complaints` (`id`, `student_id`, `facility_category_id`, `location_id`, `image`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 3, 1, NULL, 'uploads/complaints/1768116602_camera-photo.jpg', 'qwqwqwq', '2026-01-11 00:30:02', 3, '2026-01-11 00:30:02', NULL, '2026-01-11 13:29:58', 3),
(2, 3, 1, NULL, 'uploads/complaints/1768117707_camera-photo.jpg', 'jhvb', '2026-01-11 00:48:27', 3, '2026-01-11 00:48:27', NULL, '2026-01-13 14:25:25', 3),
(3, 3, 1, NULL, 'uploads/complaints/1768118290_camera-photo.jpg', 'sasasa', '2026-01-11 00:58:10', 3, '2026-01-11 01:42:06', 3, '2026-01-13 15:39:59', 3),
(4, 3, 1, NULL, NULL, '212121', '2026-01-11 01:34:13', 3, '2026-01-11 01:34:13', NULL, '2026-01-17 12:30:27', 3),
(5, 3, 1, NULL, 'uploads/complaints/1768135978_Gemini_Generated_Image_2awqb02awqb02awq.png', 'dadsadada', '2026-01-11 05:52:58', 3, '2026-01-11 05:52:58', NULL, '2026-01-17 12:34:53', 3),
(6, 3, 1, NULL, 'uploads/complaints/1768283460_camera-photo.jpg', 'ADADADADA', '2026-01-12 22:51:00', 3, '2026-01-17 05:37:05', 3, NULL, NULL),
(7, 3, 2, NULL, 'uploads/complaints/1768314717_popop.png', '2121', '2026-01-13 07:31:57', 3, '2026-01-13 08:35:02', 3, '2026-01-17 12:37:14', 3),
(8, 3, 1, NULL, 'uploads/complaints/1768351699_screencapture-reg-snpmb-id-success-2026-01-13-12_46_53.png', 'komputer rusakk', '2026-01-13 17:48:19', 3, '2026-01-17 05:34:38', 3, NULL, NULL),
(9, 3, 2, NULL, 'uploads/complaints/1768653546_WhatsApp Image 2026-01-14 at 08.52.23.jpeg', 'rusak kursinya', '2026-01-17 05:39:06', 3, '2026-01-17 05:39:06', NULL, '2026-01-17 12:40:10', 3),
(10, 3, 1, 3, 'uploads/complaints/1768966049_Frame 2.png', 'kipasnya rusak', '2026-01-17 05:39:54', 3, '2026-01-27 04:23:55', 3, NULL, NULL),
(11, 3, 1, NULL, 'uploads/complaints/1768793268_camera-photo.jpg', 'Ac rusak tidak bisa di nyalakan', '2026-01-18 20:27:48', 3, '2026-01-18 20:27:48', NULL, NULL, NULL),
(12, 3, 2, 3, 'uploads/complaints/1769495899_camera-photo.jpg', 'Kursi\r\n\r\nkok lama', '2026-01-20 02:00:51', 3, '2026-01-27 06:38:19', 3, NULL, NULL),
(13, 8, 1, 3, 'uploads/complaints/1769256653_itulah.png', 'PC LG rusak', '2026-01-24 12:09:56', 8, '2026-01-24 12:15:00', 8, NULL, NULL),
(14, 3, 4, 5, NULL, 'vjhg,', '2026-01-26 08:07:53', 3, '2026-01-26 08:07:53', NULL, NULL, NULL),
(15, 8, 1, 3, 'uploads/complaints/1770121498_camera-photo.jpg', 'PC RUSAK', '2026-02-03 12:24:58', 8, '2026-02-03 12:24:58', NULL, NULL, NULL),
(16, 8, 4, 5, 'uploads/complaints/1770122101_camera-photo.jpg', 'asasa', '2026-02-03 12:35:01', 8, '2026-02-03 12:35:01', NULL, '2026-02-03 22:02:32', 8),
(17, 8, 1, 5, 'uploads/complaints/1770124751_camera-photo.jpg', 'Y', '2026-02-03 13:19:11', 8, '2026-02-03 13:19:11', NULL, NULL, NULL),
(18, 8, 2, 3, 'uploads/complaints/1770371707_WhatsApp Image 2026-01-31 at 13.12.53.jpeg', 'Cabe rusak', '2026-02-03 14:28:49', 8, '2026-02-06 09:55:07', 8, NULL, NULL),
(19, 8, 4, 5, 'uploads/complaints/1770371596_1770121498_camera-photo.jpg', 'Kabel Lan terputus', '2026-02-06 09:53:16', 8, '2026-02-06 09:53:16', NULL, NULL, NULL),
(20, 8, 1, 3, 'uploads/complaints/1770696075_camera-photo.jpg', 'AC rusak bau gosong', '2026-02-10 04:01:15', 8, '2026-02-10 04:01:15', NULL, NULL, NULL),
(21, 8, 1, 3, 'uploads/complaints/1770700992_camera-photo.jpg', 'AC nya rusak dan berasap', '2026-02-10 05:23:12', 8, '2026-02-10 05:23:26', 8, NULL, NULL),
(22, 8, 1, 3, 'uploads/complaints/1770779205_camera-photo.jpg', 'Lampu mati', '2026-02-11 03:06:45', 8, '2026-02-11 03:06:45', NULL, NULL, NULL),
(23, 8, 1, 3, 'uploads/complaints/1770779284_camera-photo.jpg', 'Lampu rusak', '2026-02-11 03:08:04', 8, '2026-02-11 03:08:04', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `facility_categories`
--

CREATE TABLE `facility_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL COMMENT '1=Pending,2=In Progress,3=Done',
  `example_items` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `facility_categories`
--

INSERT INTO `facility_categories` (`id`, `name`, `priority`, `example_items`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Elektronik', 2, 'AC, Komputer, Proyektor, Lampu, Printer', '2026-01-10 21:37:38', 1, '2026-02-06 02:32:42', 1, NULL, NULL),
(2, 'Furniture', 1, 'Meja, Kursi, Lemari, Papan Tulis', '2026-01-13 07:27:06', 1, '2026-02-06 02:33:08', 1, NULL, NULL),
(3, 'Kebersihan', 1, 'Sapu, Pel, Tempat Sampah, Ember', '2026-01-22 07:15:50', 1, '2026-02-06 02:33:26', 1, NULL, NULL),
(4, 'Jaringan & Internet', 3, 'Router, Switch, Kabel LAN, Access Point', '2026-01-26 04:43:05', 1, '2026-02-06 02:33:51', 1, NULL, NULL),
(5, 'Keamanan', 3, 'CCTV, Kunci Pintu, Alarm, Gembok', '2026-02-04 00:18:01', 1, '2026-02-04 00:18:01', NULL, NULL, NULL),
(6, 'Listrik', 3, 'Stop Kontak, MCB, Saklar, Kabel Listrik', '2026-02-06 02:34:14', 1, '2026-02-06 02:34:14', NULL, NULL, NULL),
(7, 'Bangunan', 2, 'Pintu, Jendela, Atap, Dinding', '2026-02-06 02:34:32', 1, '2026-02-06 02:34:32', NULL, NULL, NULL),
(8, 'Peralatan Lab', 2, 'PC Lab, Meja Praktikum, Alat Praktik', '2026-02-06 02:34:56', 1, '2026-02-06 02:34:56', NULL, NULL, NULL),
(9, 'Audio Visual', 2, 'Speaker, Mikrofon, Sound System, Amplifier', '2026-02-06 02:40:05', 1, '2026-02-06 03:10:54', 1, NULL, NULL),
(10, 'Sanitasi', 2, 'WC, Wastafel, Kran Air, Saluran Air', '2026-02-06 02:40:05', 1, '2026-02-06 03:05:18', 1, NULL, NULL),
(11, 'Peralatan Olahraga', 1, 'Bola, Net, Ring Basket, Matras', '2026-02-06 02:40:05', 1, '2026-02-06 03:14:35', 1, NULL, NULL),
(12, 'Administrasi & ATK', 2, 'Printer Kantor, Lemari Arsip, Kursi Tamu', '2026-02-06 02:40:05', 1, '2026-02-06 03:09:41', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(3, 'Lab 1 RPL', '2026-01-23 00:23:03', 0, '2026-01-23 00:23:03', NULL, NULL, NULL),
(5, 'Kelas Industri 1 rpl', '2026-01-26 07:50:26', 0, '2026-01-26 07:50:26', NULL, NULL, NULL),
(6, 'Ruang 1', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(7, 'Ruang 2', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(8, 'Ruang 3', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(9, 'Ruang 4', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(10, 'Ruang 5', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(11, 'Ruang 6', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(12, 'Ruang 7', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(13, 'Ruang 8', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(14, 'Ruang 9', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(15, 'Ruang 10', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(16, 'Ruang 11', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(17, 'Ruang 12', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(18, 'Ruang 13', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(19, 'Ruang 14', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(20, 'Ruang 15', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(21, 'Ruang 16', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(22, 'Ruang 17', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(23, 'Ruang 18', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(24, 'Ruang 19', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(25, 'Ruang 20', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(26, 'Ruang 21', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(27, 'Ruang 22', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(28, 'Ruang 23', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(29, 'Ruang 24', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(30, 'Ruang 25', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(31, 'Ruang 26', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(32, 'Ruang 27', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(33, 'Ruang 28', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(34, 'Ruang 29', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(35, 'Ruang 30', '2026-02-06 03:04:36', 1, '2026-02-06 03:04:36', NULL, NULL, NULL),
(36, 'Lab 1 tkj', '2026-02-06 09:46:37', 0, '2026-02-06 09:46:37', NULL, NULL, NULL),
(37, 'lab 2 tkj', '2026-02-06 09:47:08', 0, '2026-02-06 09:47:08', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_27_081932_create_task_categories_table', 1),
(5, '2025_12_27_093000_create_tasks_table', 1),
(6, '2026_01_20_004403_create_aspiration_status_logs_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0HVGeYfAvlP0L0j9p75lRQ5FureQdhUNsrRI9jX3', 8, '36.74.214.168', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ2poV3NHWVNFS1B5WjBKVE83V0ZKMUQyMUc2NkZwUlV3YVpzZGR3UiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vc2FycHJhc2luLmVza2FsYWJlci5teS5pZC9zdHVkZW50L2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNzoic3R1ZGVudC5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1770129436),
('4fwk6L3ydEJfb8czT5PGlgpFgPlio3X7LuMWXWm1', 8, '182.5.236.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQVhFUFROZUthcTdNVVU1WGUxRmIzU1BNREhESHB3S3lvbE1FOHpFRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vc2FycHJhc2luLmVza2FsYWJlci5teS5pZC9zdHVkZW50L2Rhc2hib2FyZCI7czo1OiJyb3V0ZSI7czoxNzoic3R1ZGVudC5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=', 1770122103),
('lTE9dhM70he8rYsRt7bYoALO1QBLNblNY5lCwzJM', 1, '36.73.221.91', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaTQzM0NoMHlxTjlVQ2dZR2ZaTHcxVG0yaExEWUw0MVVnWDY3VUc3VyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjE6Imh0dHBzOi8vc2FycHJhc2luLmVza2FsYWJlci5teS5pZC9hZG1pbi9hc3BpcmF0aW9ucy9kZXRhaWwvMTgiO3M6NToicm91dGUiO3M6MjQ6ImFkbWluLmFzcGlyYXRpb25zLmRldGFpbCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1770129383),
('xtZq6NhpmCc7xL2S0CwkVfLOCxR7FWyHCiYrfQs6', 8, '182.5.236.109', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTkhZanFpbGNkUDhnMlpoaFhwVk9wNmtmY2FoazdGempRRnFwdjFhaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTI6Imh0dHBzOi8vc2FycHJhc2luLmVza2FsYWJlci5teS5pZC9zdHVkZW50L2NvbXBsYWludHMiO3M6NToicm91dGUiO3M6MjQ6InN0dWRlbnQuY29tcGxhaW50cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==', 1770124771);

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `nisn` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `user_id`, `classroom_id`, `nisn`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 3, 3, 1212121, '2026-01-09 22:56:09', 1, '2026-01-13 08:11:33', 1, NULL, NULL),
(2, 7, 4, 212121343, '2026-01-13 17:25:28', 1, '2026-01-13 17:25:28', NULL, NULL, NULL),
(3, 8, 4, 128647891, '2026-01-13 17:26:14', 1, '2026-02-03 12:24:17', 1, NULL, NULL),
(4, 13, 4, 123456789, '2026-01-22 01:00:56', 1, '2026-01-22 01:00:56', NULL, NULL, NULL),
(5, 14, 3, 1234567890, '2026-01-22 01:02:24', 1, '2026-01-22 01:02:24', NULL, '2026-01-22 13:18:25', 1),
(6, 18, 5, 1234567892, '2026-01-27 06:55:57', 1, '2026-01-27 06:55:57', NULL, '2026-02-03 19:29:24', 1),
(7, 19, 17, 986281929, '2026-02-06 09:51:21', 1, '2026-02-06 09:51:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `task_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1: Todo, 2: In Progress, 3: Done',
  `task_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `task_categories`
--

CREATE TABLE `task_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `access_type` int(11) DEFAULT NULL COMMENT '1=Admin, 2=Siswa',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='tabel user utama';

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `access_type`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'Test User', 'test@example.com', '2026-01-09 11:09:09', '$2y$12$3BmdlqpuhI4hca9APKV9IuJAb.1pdOR5QsNS4ox6/mWKnMM5Tph1K', '8OJFNOyFuY2mO08Qlx9iy7X3PvCHGZQh1vQ68YnwsV1bBdD8dKkbKDC2a7Uy', '2026-01-09 11:09:09', 0, '2026-01-09 11:09:09', NULL, NULL, NULL),
(3, 2, 'coba1', '12@gmail.com', NULL, '$2y$12$u2JMur93XHI0P8InzUVl5ea4CrBlTjvDPEbJ/l25Usrs07X9QGKs6', NULL, '2026-01-09 22:56:09', 0, '2026-01-13 08:11:37', NULL, NULL, NULL),
(7, 2, 'rafif', 'rafif@gmail.com', NULL, '$2y$12$82iMkd6n703Le7QzdMOyE.QH42PLbHKe1qDpIoL5Oqpg5mULj9xc6', NULL, '2026-01-13 17:25:28', 0, NULL, NULL, NULL, NULL),
(8, 2, 'freya', 'freya@gmail.com', NULL, '$2y$12$ScEEFY3B./DJ2WedhERi5eBhB9crNyQa7DceatneAJV8z5mQOCQh2', NULL, '2026-01-13 17:26:14', 0, '2026-02-03 12:24:17', NULL, NULL, NULL),
(13, 2, 'Rudi Hartono', 'rrrr@gmail.com', NULL, '$2y$12$/LH60B7.kzxO4RKn2RBO0OHobih15tERad0I4yGGtD2BiE/xVI9aW', NULL, '2026-01-22 01:00:56', 0, NULL, NULL, NULL, NULL),
(14, 2, 'oppp', 'asd@asd.asd', NULL, '$2y$12$JMkUQKi7HRQu2jYw6o5gk.scWkLnuynvgfsq4ERqSFUS1A9ZC1/5.', NULL, '2026-01-22 01:02:24', 0, NULL, NULL, NULL, NULL),
(15, 2, 'asd', 'asd@gmail.com', NULL, '$2y$12$Zb5nFqWiSJ/lwcEg7jqQ7OUQQqruKsqZQgENuk0qK/X/tDTCj7Vb2', NULL, '2026-01-25 14:51:20', 1, NULL, NULL, NULL, NULL),
(16, 2, 'tst', 'tst@gmail.com', NULL, '$2y$12$5oFu7xUtnnB8Bo8AYR5iWuevfmJiZdH35hTCaMF21R3IUFaqW89Li', NULL, '2026-01-25 14:51:51', 1, NULL, NULL, NULL, NULL),
(17, 1, 'ppp', 'pp@gmail.com', NULL, '$2y$12$PsxV0viJcx8GS5VT1goIpeE4qiYmn/hEAORuNj6t6B4SLYbYdBXou', NULL, '2026-01-25 14:52:16', 1, NULL, NULL, NULL, NULL),
(18, 2, 'adalah', 'ada@gmail.com', NULL, '$2y$12$EamGQkOdRH9YprhQIIaoLezgMSg6tr6YBsB.nRNENQeusokNZBSG6', NULL, '2026-01-27 06:55:57', 0, '2026-01-27 06:56:52', NULL, '2026-02-03 19:29:24', 1),
(19, 2, 'royhan', 'arroyhan@gmail.com', NULL, '$2y$12$Zx.bJ1.UFGMvFD.CDimyxOz0iZpWFQOzumjWrX5iyYvDrYWDnTJfS', NULL, '2026-02-06 09:51:21', 0, '2026-02-06 09:51:33', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aspirations`
--
ALTER TABLE `aspirations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aspiration_status_logs`
--
ALTER TABLE `aspiration_status_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_facility_category_id_foreign` (`facility_category_id`),
  ADD KEY `fk_complaints_locations` (`location_id`);

--
-- Indeks untuk tabel `facility_categories`
--
ALTER TABLE `facility_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_task_category_id_foreign` (`task_category_id`);

--
-- Indeks untuk tabel `task_categories`
--
ALTER TABLE `task_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aspirations`
--
ALTER TABLE `aspirations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `aspiration_status_logs`
--
ALTER TABLE `aspiration_status_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `facility_categories`
--
ALTER TABLE `facility_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `task_categories`
--
ALTER TABLE `task_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_facility_category_id_foreign` FOREIGN KEY (`facility_category_id`) REFERENCES `facility_categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_complaints_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_task_category_id_foreign` FOREIGN KEY (`task_category_id`) REFERENCES `task_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
