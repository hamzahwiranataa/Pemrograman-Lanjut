-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2025 pada 10.57
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
-- Database: `firma_hukum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama_klien` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jenis_jasa` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama_klien`, `email`, `jenis_jasa`, `deskripsi`, `tanggal_pesan`) VALUES
(8, 'Sergio Marquina', 'madriddds@anon.org', 'Pendampingan Hukum', 'Indikasi', '2025-11-02 17:55:43');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
