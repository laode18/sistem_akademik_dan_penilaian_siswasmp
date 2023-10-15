-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 05:27 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_siakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` bigint(20) NOT NULL,
  `pertemuan` int(11) DEFAULT NULL,
  `tanggal` varchar(30) DEFAULT NULL,
  `hadir` int(11) DEFAULT NULL,
  `sakit` int(11) DEFAULT NULL,
  `izin` int(11) DEFAULT NULL,
  `alpa` int(11) DEFAULT NULL,
  `pokok_pembahasan` text DEFAULT NULL,
  `id_bel` varchar(20) NOT NULL,
  `id_siswa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `pertemuan`, `tanggal`, `hadir`, `sakit`, `izin`, `alpa`, `pokok_pembahasan`, `id_bel`, `id_siswa`) VALUES
(339, 1, '2023-09-01', 1, 0, 0, 0, 'Perkenalan awal', 'BEL1', 'SW7-1'),
(340, 1, '2023-09-01', 0, 1, 0, 0, 'Perkenalan awal', 'BEL1', 'SW7-2'),
(341, 1, '2023-09-01', 0, 1, 0, 0, 'Perkenalan awal', 'BEL1', 'SW7-3'),
(342, 1, '2023-09-01', 1, 0, 0, 0, 'Perkenalan awal', 'BEL1', 'SW7-4'),
(343, 1, '2023-09-01', 1, 0, 0, 0, 'Perkenalan awal', 'BEL1', 'SW7-5'),
(344, 1, '2023-09-01', 1, 0, 0, 0, 'Perkenalan awal', 'BEL1', 'SW7-6'),
(345, 2, '2023-09-08', 1, 0, 0, 0, 'Test24', 'BEL1', 'SW7-1'),
(346, 2, '2023-09-08', 1, 0, 0, 0, 'Test24', 'BEL1', 'SW7-2'),
(347, 2, '2023-09-08', 0, 1, 0, 0, 'Test24', 'BEL1', 'SW7-3'),
(348, 2, '2023-09-08', 0, 1, 0, 0, 'Test24', 'BEL1', 'SW7-4'),
(349, 2, '2023-09-08', 1, 0, 0, 0, 'Test24', 'BEL1', 'SW7-5'),
(350, 2, '2023-09-08', 1, 0, 0, 0, 'Test24', 'BEL1', 'SW7-6'),
(351, 1, '2023-08-30', 1, 0, 0, 0, 'Perkenalan awall', 'BEL4', 'SW7-1'),
(352, 1, '2023-08-30', 1, 0, 0, 0, 'Perkenalan awall', 'BEL4', 'SW7-2'),
(353, 1, '2023-08-30', 1, 0, 0, 0, 'Perkenalan awall', 'BEL4', 'SW7-3'),
(354, 1, '2023-08-30', 1, 0, 0, 0, 'Perkenalan awall', 'BEL4', 'SW7-4'),
(355, 1, '2023-08-30', 0, 1, 0, 0, 'Perkenalan awall', 'BEL4', 'SW7-5'),
(356, 1, '2023-08-30', 1, 0, 0, 0, 'Perkenalan awall', 'BEL4', 'SW7-6'),
(357, 2, '2023-09-06', 0, 1, 0, 0, 'Bola Basket', 'BEL4', 'SW7-1'),
(358, 2, '2023-09-06', 0, 1, 0, 0, 'Bola Basket', 'BEL4', 'SW7-2'),
(359, 2, '2023-09-06', 1, 0, 0, 0, 'Bola Basket', 'BEL4', 'SW7-3'),
(360, 2, '2023-09-06', 1, 0, 0, 0, 'Bola Basket', 'BEL4', 'SW7-4'),
(361, 2, '2023-09-06', 1, 0, 0, 0, 'Bola Basket', 'BEL4', 'SW7-5'),
(362, 2, '2023-09-06', 1, 0, 0, 0, 'Bola Basket', 'BEL4', 'SW7-6');

-- --------------------------------------------------------

--
-- Table structure for table `db_siswa`
--

CREATE TABLE `db_siswa` (
  `id_siswa` varchar(15) NOT NULL,
  `nisn` varchar(15) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jenis_kel` varchar(30) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanggal_lahir` varchar(80) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_siswa`
--

INSERT INTO `db_siswa` (`id_siswa`, `nisn`, `nama_siswa`, `jenis_kel`, `id_kelas`, `tanggal_lahir`, `foto`, `password`) VALUES
('SW7-1', '1247236872985', 'RANGGA SETIAWAN', 'Laki-Laki', 19, '07-08-2008', '6515a2f61d01164a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW7-2', '0092120251', 'ABIMANYU MAULANA', 'Laki-Laki', 19, '08-02-2007', '6515a3028015064a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW7-3', '0073663475', 'Aldiyansyah', 'Laki-Laki', 19, '10-01-2008', '6515a32ac7de064a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW7-4', '0084148923', 'Alka Asmana Jaya', 'Laki-Laki', 19, '10-01-2008', '6515a3367497364a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW7-5', '0089150114', 'Arief Ardiansyah', 'Laki-Laki', 19, '01-02-2008', '6515a3445035b64a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW7-6', '0098497132', 'Dzilhaybati Salma Aulya Subagja', 'Laki-Laki', 19, '27-03-2007', '6515a3510e0eb64a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW8-1', '1515151515151', 'KEYSHA NUR PADILAH', 'Perempuan', 20, '08-02-2009', '6515a36bbda6364a5a812dde54avatar-neha-punita.png', '12345678'),
('SW8-2', '0085978371', 'M RIPAN SYAMSIDAR', 'Laki-Laki', 20, '01-02-2009', '6515a37aa913264a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW8-3', '0081605550', 'MAHENDRA PUTRA', 'Laki-Laki', 20, '01-02-2009', '6515a389b88ef64a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW9-1', '0091749669', 'Maulana Yusuf', 'Laki-Laki', 21, '10-01-2009', '6515a3983504864a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW9-2', '0092707356', 'MUHAMAD RAMDAN', 'Laki-Laki', 21, '01-02-2009', '6515a3a07e68864a5a6f027c09avatar-cao-yu.png', '12345678'),
('SW9-3', '0086063029', 'NAVISA DWI CAHAYA KUSDINAR', 'Laki-Laki', 21, '10-01-2008', '6515a3abaafc064a5a6f027c09avatar-cao-yu.png', '12345678');

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
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` varchar(20) NOT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `jenis_kel` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nuptk`, `nama_guru`, `jenis_kel`, `foto`, `password`) VALUES
('GR-1', '6636756657300052', 'Diana Damayanti A.Md', 'Perempuan', '6515a11612e3blogo.png', '12345678'),
('GR-10', '78787879687978', 'Anwar Hidayat, A.Md', 'Laki-Laki', '6515a15253149logo.png', '12345678'),
('GR-11', '9898989898989898', 'Asep', 'Laki-Laki', '651da580665c3logo.png', '12345678'),
('GR-2', '196403292008012001', 'Nenemg Wawat Darhawati S.Pd', 'Perempuan', '6515a164c79e1logo.png', '12345678'),
('GR-3', '1460756660130103', 'Gan Gan Gandra. S.Pd', 'Laki-Laki', '6515a17323bb4logo.png', '12345678'),
('GR-4', '5236770671130213', 'Moh Ridwan Fathurrohman S.Pd', 'Laki-Laki', '6515a183de6d5logo.png', '12345678'),
('GR-5', '1449753653220002', 'Lela Nurlaelani, S.Pd', 'Perempuan', '6515a1b748d52logo.png', '12345678'),
('GR-6', '297403292008012102', 'Asep Mulyana, S.Ag', 'Laki-Laki', '6515a1a5f0508logo.png', '12345678'),
('GR-7', '11616161616167', 'Ridwan faturohman S.pd', 'Laki-Laki', '6515a1cab2b56logo.png', '12345678'),
('GR-8', '3838383838383', 'Wahyu Gunawan', 'Laki-Laki', '6515a1de6d79elogo.png', '12345678'),
('GR-9', '6868696999679', 'Adila Yuliandawati', 'Perempuan', '6515a202e3d31logo.png', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(19, '7'),
(20, '8'),
(21, '9');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_matpel` int(11) NOT NULL,
  `nama_matpel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_matpel`, `nama_matpel`) VALUES
(8, 'Pendidikan Agama Islam'),
(9, 'Pendidikan Pancasila Kewarganegaraan'),
(10, 'Bahasa Indonesia'),
(11, 'Bahasa Inggris'),
(12, 'Matematika'),
(13, 'Ilmu Pengetahuan Alam'),
(14, 'Ilmu pengetahuan sosial'),
(15, 'Penjaskes'),
(17, 'Prakarya'),
(18, 'Seni Budaya'),
(19, 'Bahasa Sunda');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` bigint(20) NOT NULL,
  `ulangan_harian` int(11) DEFAULT NULL,
  `ulangan_harian1` int(11) DEFAULT NULL,
  `ulangan_harian2` int(11) DEFAULT NULL,
  `ulangan_harian3` int(11) DEFAULT NULL,
  `uts` int(11) DEFAULT NULL,
  `uas` int(11) DEFAULT NULL,
  `tugas` int(11) DEFAULT NULL,
  `tugas1` int(11) DEFAULT NULL,
  `nilai_absen` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_bel` varchar(20) NOT NULL,
  `id_siswa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `ulangan_harian`, `ulangan_harian1`, `ulangan_harian2`, `ulangan_harian3`, `uts`, `uas`, `tugas`, `tugas1`, `nilai_absen`, `deskripsi`, `id_bel`, `id_siswa`) VALUES
(60, 90, 92, 89, 91, 80, 90, 100, 95, 100, 'Lumayan', 'BEL1', 'SW7-1'),
(61, 80, 80, 90, 85, 90, 90, 98, 98, 90, 'Bagus', 'BEL1', 'SW7-2'),
(62, 90, 90, 98, 90, 90, 90, 80, 100, 100, 'Not Bad', 'BEL4', 'SW7-1'),
(63, 89, 80, 78, 99, 90, 90, 100, 100, 90, 'Baguslah', 'BEL4', 'SW7-2');

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_ortu` varchar(20) NOT NULL,
  `id_siswa` varchar(15) NOT NULL,
  `nama_ortu` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id_ortu`, `id_siswa`, `nama_ortu`, `alamat`, `username`, `password`) VALUES
('ORT-1', 'SW7-2', 'juanda', 'sukabungah', 'juanda', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelajaran`
--

CREATE TABLE `pembelajaran` (
  `id_bel` varchar(20) NOT NULL,
  `id_guru` varchar(20) NOT NULL,
  `id_matpel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelajaran`
--

INSERT INTO `pembelajaran` (`id_bel`, `id_guru`, `id_matpel`, `id_kelas`) VALUES
('BEL1', 'GR-1', 8, 19),
('BEL2', 'GR-4', 17, 20),
('BEL3', 'GR-2', 12, 21),
('BEL4', 'GR-11', 15, 19),
('BEL5', 'GR-11', 15, 20),
('BEL6', 'GR-11', 11, 19);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tingkatan_kelas`
--

CREATE TABLE `tingkatan_kelas` (
  `id_tingkel` int(11) NOT NULL,
  `nama_tingkel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Admin', 'zaenall', NULL, '$2y$10$/LLGzX4RY.v8wrJe0Mj0LuMIEiJjKheDhu1z69WvqUbBG8kHAibSi', 'admin', NULL, '2023-07-02 03:07:38', NULL),
('2', 'Guru 1', '1234567891234567', NULL, '$2y$10$/LLGzX4RY.v8wrJe0Mj0LuMIEiJjKheDhu1z69WvqUbBG8kHAibSi', 'guru', NULL, '2023-07-02 04:04:51', NULL),
('3', 'Siswa 1', '1234567890', NULL, '$2y$10$/LLGzX4RY.v8wrJe0Mj0LuMIEiJjKheDhu1z69WvqUbBG8kHAibSi', 'siswa', NULL, '2023-07-02 04:04:51', NULL),
('GR-1', 'Diana Damayanti A.Md', '6636756657300052', NULL, '$2y$10$ipwz.5ODb5r1Xh9X7WoWjO5PvXm6lsGRmTVlPf.1qHapaXBfA1Cyy', 'guru', NULL, '2023-09-06 01:12:37', '2023-09-06 01:12:37'),
('GR-10', 'Anwar Hidayat, A.Md', '78787879687978', NULL, '$2y$10$baKImYl/jCiKqHiBAqRIbOkWGlPNc1CdI3MmYYWLfStnpV2jZLpG6', 'guru', NULL, '2023-09-13 06:50:57', '2023-09-13 06:50:57'),
('GR-11', 'Asep', '9898989898989898', NULL, '$2y$10$8ewLPXLBL1ZHYvUv2RjvZOG2gQa6Hg69n/.QJCgIUImQ7aVKIW3w.', 'guru', NULL, '2023-10-04 10:48:48', '2023-10-04 10:48:48'),
('GR-2', 'Nenemg Wawat Darhawati S.Pd', '196403292008012001', NULL, '$2y$10$NzfhmFyWqAUw62MbeMpfn.uqM140vx5aSfgxAB5GfgDUtYV9tMD62', 'guru', NULL, '2023-09-06 01:09:51', '2023-09-06 01:09:51'),
('GR-3', 'Gan Gan Gandra. S.Pd', '1460756660130103', NULL, '$2y$10$SySRKYb88yaIhJIO.t1yZu8xhZse7aQekC/Rkf8hDmBPhAv.ipOES', 'guru', NULL, '2023-09-06 01:10:35', '2023-09-06 01:10:35'),
('GR-4', 'Moh Ridwan Fathurrohman S.Pd', '5236770671130213', NULL, '$2y$10$TpEvfDzELBIqq0t2cdel2utRKer4DnPZKgcIl41YAgrkOEGzWrEmS', 'guru', NULL, '2023-09-06 01:11:01', '2023-09-06 01:11:01'),
('GR-5', 'Lela Nurlaelani, S.Pd', '1449753653220002', NULL, '$2y$10$zvCxVEZ8jdV6mDvkzujXseXtqBQ9nh3FZMfUFwJRysluazVUjSNRm', 'guru', NULL, '2023-09-06 01:11:28', '2023-09-06 01:11:28'),
('GR-6', 'Asep Mulyana, S.Ag', '297403292008012102', NULL, '$2y$10$Lr9ruxHJcGHz0UlK/U.jzutOVeLN/dDHv45OtFcsoVPQ1wJfZH0Fi', 'guru', NULL, '2023-09-06 01:12:02', '2023-09-06 01:12:02'),
('GR-7', 'Ridwan faturohman S.pd', '11616161616167', NULL, '$2y$10$zfGCrZx3zJAzBh2lWeowR..NO4OF9cT/fws1NNm9Jv3FJw9In7bZm', 'guru', NULL, '2023-09-13 05:37:43', '2023-09-13 05:37:43'),
('GR-8', 'Wahyu Gunawan', '3838383838383', NULL, '$2y$10$n1Ladn1sgpFUlO9PJye9OeTLBtRDKSwEoK42p3u5GAfi8zbyzKO/6', 'guru', NULL, '2023-09-13 05:38:33', '2023-09-13 05:38:33'),
('GR-9', 'Adila Yuliandawati', '6868696999679', NULL, '$2y$10$nnhMydp.H1Aie4w5IBU2HuuVCuq2SgLEgo5nTRS7BwG85TzOOiFiy', 'guru', NULL, '2023-09-13 06:49:57', '2023-09-13 06:49:57'),
('ORT-1', 'juanda', 'juanda', NULL, '$2y$10$jwAEVPq50eI2TxxGtNklgu02pHNK/RQIm0aLbUpjgYOykzS2Cip/6', 'ortu', NULL, '2023-09-13 19:36:44', '2023-09-13 19:36:44'),
('SW7-1', 'RANGGA SETIAWAN', '1247236872985', NULL, '$2y$10$7ZV6LwYTmy/y6s0djO4n9ebLQLX5GH6Jz0X35GGmtZUZlNwaLCpeO', 'siswa', NULL, '2023-09-13 06:35:17', '2023-09-13 06:35:17'),
('SW7-2', 'ABIMANYU MAULANA', '0092120251', NULL, '$2y$10$xzS.actyYnIG.gp0TnDaW.cYnjeEN.skWeibalKbmfMJR5.fm4bGa', 'siswa', NULL, '2023-09-13 06:35:58', '2023-09-13 06:35:58'),
('SW7-3', 'Aldiyansyah', '0073663475', NULL, '$2y$10$uB/RZnJI3NFirTnGpGaHce0ufQluhoLaGpz.8m1aoEHdn/W5LMMT6', 'siswa', NULL, '2023-09-13 06:36:38', '2023-09-13 06:36:38'),
('SW7-4', 'Alka Asmana Jaya', '0084148923', NULL, '$2y$10$TcvJIMvQsRQsWIhP2WyBmevSnNjxu4LsvhHobQXAPj3hL8gyvvJkq', 'siswa', NULL, '2023-09-13 06:41:20', '2023-09-13 06:41:20'),
('SW7-5', 'Arief Ardiansyah', '0089150114', NULL, '$2y$10$/tRD8nuV/ddy2H8aJWRMcOXs7374EAt9V0EoLLzaEeBsxB5MrUZ4m', 'siswa', NULL, '2023-09-13 06:41:58', '2023-09-13 06:41:58'),
('SW7-6', 'Dzilhaybati Salma Aulya Subagja', '0098497132', NULL, '$2y$10$6hGRckSxvuW4RF3Oo2BuTeyZqwJnbux/7YP15kUTAr5bo/y.7gSdK', 'siswa', NULL, '2023-09-13 06:42:31', '2023-09-13 06:42:31'),
('SW8-1', 'KEYSHA NUR PADILAH', '1515151515151', NULL, '$2y$10$mVsqcWSaXliRmZFfgG1LNuozGkq/jSPSq90SfsGY/0ABNk0l66SAq', 'siswa', NULL, '2023-09-13 06:37:36', '2023-09-13 06:37:36'),
('SW8-2', 'M RIPAN SYAMSIDAR', '0085978371', NULL, '$2y$10$qre7QH3XmcRn1Yh6QWJmpuIdkvIHIPMAcxwQKP2KB5tfuyyVNjXm6', 'siswa', NULL, '2023-09-13 06:38:16', '2023-09-13 06:38:16'),
('SW8-3', 'MAHENDRA PUTRA', '0081605550', NULL, '$2y$10$cCY9sqrP/xUwj.p4DZENHO7/ScXjO.3ILHQHuoMVl/NmcetTc6rfG', 'siswa', NULL, '2023-09-13 06:38:48', '2023-09-13 06:38:48'),
('SW9-1', 'Maulana Yusuf', '0091749669', NULL, '$2y$10$yqj3vsTfEK.qf5GT87wb7.XYH.Py.ziGA9FDdwaxBQcPM/Vk69Bu6', 'siswa', NULL, '2023-09-13 06:39:33', '2023-09-13 06:39:33'),
('SW9-2', 'MUHAMAD RAMDAN', '0092707356', NULL, '$2y$10$bm/oe6zwPTqbQi3rlnnFAOoJyQVHdkOim4F1vPvN6.8Mq1N.xBB.6', 'siswa', NULL, '2023-09-13 06:40:04', '2023-09-13 06:40:04'),
('SW9-3', 'NAVISA DWI CAHAYA KUSDINAR', '0086063029', NULL, '$2y$10$ZoE0FLMYmd5nqgrKa4vTAuyW3/qvvpJlf/G.gKvuWVl2aXDPs8YuS', 'siswa', NULL, '2023-09-13 06:40:36', '2023-09-13 06:40:36'),
('WK-5', 'Neneng Wawat, S.pd', 'Neneng@gmail.com', NULL, '$2y$10$8CMD8vO/VDXIThH3Ur.PYe53hcnszNyGNktfJGRm7Jekqp8DrrOD.', 'walkes', NULL, '2023-09-06 01:28:04', '2023-09-06 01:28:04'),
('WK-6', 'Asep Mulyana S.Ag', 'Asep@gmail.com', NULL, '$2y$10$XD8OKqz5ZeOpzRLM4FU.iu2y5hghRmwHew3pCSck33cdab/Qmcthq', 'walkes', NULL, '2023-09-06 01:29:06', '2023-09-06 01:29:06'),
('WK-7', 'Diayana Damayanty A.Mpd', 'Diana@gmail.com', NULL, '$2y$10$9EjqWmEZ1Z48.4zfSIJAYe.JlSwO9g5.r1jkUt12buq7KSlNAmzS.', 'walkes', NULL, '2023-09-06 01:30:49', '2023-09-06 01:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_walkes` varchar(20) NOT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_walkes` varchar(100) NOT NULL,
  `jenis_kel` varchar(20) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_walkes`, `nuptk`, `nama_walkes`, `jenis_kel`, `id_kelas`, `foto`, `password`) VALUES
('WK-5', 'Neneng@gmail.com', 'Neneng Wawat, S.pd', 'Perempuan', 19, '6515a3f28d720logo.png', '12345678'),
('WK-6', 'Asep@gmail.com', 'Asep Mulyana S.Ag', 'Laki-Laki', 20, '6515a40830270logo.png', '12345678'),
('WK-7', 'Diana@gmail.com', 'Diayana Damayanty A.Mpd', 'Perempuan', 21, '6515a415e0ffclogo.png', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `db_siswa`
--
ALTER TABLE `db_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_matpel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_ortu`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembelajaran`
--
ALTER TABLE `pembelajaran`
  ADD PRIMARY KEY (`id_bel`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tingkatan_kelas`
--
ALTER TABLE `tingkatan_kelas`
  ADD PRIMARY KEY (`id_tingkel`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_walkes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_matpel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tingkatan_kelas`
--
ALTER TABLE `tingkatan_kelas`
  MODIFY `id_tingkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
