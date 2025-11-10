-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2025 pada 09.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pl7_praktikum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(11) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama_bahan`, `jenis`, `stok`, `hapus`, `deleted_at`) VALUES
(1, 'Kertas A', 'Kertas', 10000, 1, '2025-12-01 19:04:32'),
(2, 'Kertas B', 'Kertas', 12000, 1, '2025-12-01 21:46:18'),
(3, 'Kertas C', 'Kertas', 15000, 1, '2025-12-01 21:46:18'),
(4, 'Kertas D', 'Kertas', 9000, 0, NULL),
(5, 'Kertas E', 'Kertas', 11000, 0, NULL),
(6, 'Tinta A', 'Tinta', 5000, 0, NULL),
(7, 'Tinta B', 'Tinta', 6000, 0, NULL),
(8, 'Tinta C', 'Tinta', 5500, 1, '2025-12-01 21:46:18'),
(9, 'Tinta D', 'Tinta', 7000, 0, NULL),
(10, 'Tinta E', 'Tinta', 6500, 0, NULL),
(11, 'Plastik A', 'Plastik', 8000, 0, NULL),
(12, 'Plastik B', 'Plastik', 9000, 0, NULL),
(13, 'Plastik C', 'Plastik', 8500, 0, NULL),
(14, 'Plastik D', 'Plastik', 7500, 0, NULL),
(15, 'Plastik E', 'Plastik', 9500, 0, NULL),
(16, 'Kertas F', 'Kertas', 10000, 0, NULL),
(17, 'Tinta F', 'Tinta', 6000, 0, NULL),
(18, 'Plastik F', 'Plastik', 8000, 0, NULL),
(19, 'Kertas G', 'Kertas', 12000, 0, NULL),
(20, 'Tinta G', 'Tinta', 5000, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mesin`
--

CREATE TABLE `mesin` (
  `id` int(11) NOT NULL,
  `nama_mesin` varchar(100) NOT NULL,
  `kapasitas_per_jam` int(11) DEFAULT NULL,
  `tahun_pembuatan` int(11) DEFAULT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mesin`
--

INSERT INTO `mesin` (`id`, `nama_mesin`, `kapasitas_per_jam`, `tahun_pembuatan`, `hapus`, `deleted_at`) VALUES
(3, 'Mesin Cetak C', 700, 2017, 1, '2025-12-02 01:14:18'),
(5, 'Mesin Cetak E', 550, 2015, 0, NULL),
(6, 'Mesin Cetak F', 650, 2016, 0, NULL),
(7, 'Mesin Cetak G', 750, 2017, 0, NULL),
(8, 'Mesin Cetak H', 800, 2018, 0, NULL),
(9, 'Mesin Cetak I', 450, 2015, 0, NULL),
(12, 'Mesin Cetak L', 700, 2018, 0, NULL),
(13, 'Mesin Cetak M', 550, 2015, 0, NULL),
(15, 'Mesin Cetak O', 750, 2017, 0, NULL),
(28, 'MESIN CETAK XXXX', 2500, 2019, 1, '2025-12-02 01:18:36'),
(29, 'MESIN CETAK AADAD', 2500, 2017, 1, '2025-12-02 01:18:36'),
(30, 'awdanwdjknakwjnkndjawjk', 500, 2015, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nomor` varchar(50) NOT NULL,
  `shift` enum('pagi','siang','malam') DEFAULT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `operator`
--

INSERT INTO `operator` (`id`, `nama`, `nomor`, `shift`, `hapus`, `deleted_at`) VALUES
(1, 'Andi', '+62-123-1231-2333', 'pagi', 0, NULL),
(2, 'Budi', '+62-872-8372-7392', 'siang', 0, NULL),
(4, 'Dewi', '+62-134-5326-5431', 'pagi', 0, NULL),
(5, 'Eka', '+62-938-4728-2910', 'siang', 0, NULL),
(6, 'Fajar', '+62-930-0374-6392', 'malam', 0, NULL),
(7, 'Gita', '+62-947-2638-2712', 'pagi', 0, NULL),
(10, 'Joko', '+62-874-5637-2831', 'pagi', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_lembar` int(11) DEFAULT NULL,
  `mesin_id` int(11) DEFAULT NULL,
  `bahan_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id`, `tanggal`, `jumlah_lembar`, `mesin_id`, `bahan_id`, `operator_id`, `hapus`, `deleted_at`) VALUES
(5, '2025-01-05', 1300, 5, 5, 5, 0, NULL),
(6, '2025-01-06', 1400, 6, 6, 6, 0, NULL),
(7, '2025-01-07', 1600, 7, 7, 7, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_check`
--

CREATE TABLE `quality_check` (
  `id` int(11) NOT NULL,
  `produksi_id` int(11) DEFAULT NULL,
  `tingkat_cacat` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `status` enum('lulus','ulang') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `hapus` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quality_check`
--

INSERT INTO `quality_check` (`id`, `produksi_id`, `tingkat_cacat`, `jumlah`, `status`, `catatan`, `hapus`, `deleted_at`) VALUES
(5, 5, 3, 39, 'ulang', 'Cacat minor', 0, NULL),
(6, 6, 2, 28, 'lulus', 'Normal', 0, NULL),
(7, 7, 4, 64, 'ulang', 'Perlu pengecekan ulang', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesin_id` (`mesin_id`),
  ADD KEY `bahan_id` (`bahan_id`),
  ADD KEY `operator_id` (`operator_id`);

--
-- Indeks untuk tabel `quality_check`
--
ALTER TABLE `quality_check`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produksi_id` (`produksi_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `mesin`
--
ALTER TABLE `mesin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `quality_check`
--
ALTER TABLE `quality_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`mesin_id`) REFERENCES `mesin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produksi_ibfk_2` FOREIGN KEY (`bahan_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produksi_ibfk_3` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_check`
--
ALTER TABLE `quality_check`
  ADD CONSTRAINT `quality_check_ibfk_1` FOREIGN KEY (`produksi_id`) REFERENCES `produksi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
