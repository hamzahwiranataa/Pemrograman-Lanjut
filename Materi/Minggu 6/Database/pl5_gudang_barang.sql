-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2025 pada 14.34
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
-- Database: `pl5_gudang_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `lokasi_id` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `kategori_id`, `lokasi_id`, `satuan`, `stok`) VALUES
(1, 'Asus ROG Zephyrus', 1, 2, 'Unit', 5),
(2, 'iPhone 14 Pro', 2, 3, 'Unit', 8),
(3, 'Earphone Bluetooth JBL', 4, 5, 'Unit', 15),
(4, 'Logitech G502 Mouse', 5, 6, 'Unit', 12),
(5, 'TP-Link Router AX1800', 6, 7, 'Unit', 10),
(6, 'Samsung SSD 1TB', 7, 8, 'Unit', 20),
(7, 'Intel Core i7 12700K', 8, 9, 'Unit', 7),
(8, 'Mechanical Keyboard Keychron', 9, 6, 'Unit', 14),
(9, 'Google Nest Mini', 10, 10, 'Unit', 6),
(10, 'Xiaomi Powerbank 20.000mAh', 3, 4, 'Unit', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Laptop', 'Perangkat komputer portabel'),
(2, 'Smartphone', 'Telepon pintar berbasis Android/iOS'),
(3, 'Aksesoris', 'Perangkat tambahan elektronik'),
(4, 'Audio', 'Peralatan suara dan musik'),
(5, 'Gaming', 'Peralatan untuk bermain game'),
(6, 'Networking', 'Peralatan jaringan internet'),
(7, 'Storage', 'Penyimpanan data'),
(8, 'Komputer Rakitan', 'Komponen PC'),
(9, 'Peripherals', 'Peralatan input/output'),
(10, 'Smart Home', 'Perangkat rumah pintar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`id`, `lokasi`, `deskripsi`) VALUES
(1, 'Gudang Utama', 'Penyimpanan pusat'),
(2, 'Rak A1', 'Area laptop'),
(3, 'Rak B2', 'Area smartphone'),
(4, 'Rak C3', 'Aksesoris kecil'),
(5, 'Rak D4', 'Perangkat audio'),
(6, 'Rak E5', 'Gaming gear'),
(7, 'Rak F6', 'Networking dan kabel'),
(8, 'Rak G7', 'Hardisk & SSD'),
(9, 'Rak H8', 'Komponen PC'),
(10, 'Rak I9', 'Smart Home Device');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mutasi`
--

CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `tipe` enum('MASUK','KELUAR','PINDAH') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mutasi`
--

INSERT INTO `mutasi` (`id`, `barang_id`, `tanggal`, `tipe`, `jumlah`, `keterangan`) VALUES
(1, 1, '2025-10-05 20:32:05', 'MASUK', 2, 'Restock dari distributor'),
(2, 2, '2025-10-05 20:32:05', 'KELUAR', 1, 'Dikirim ke toko A'),
(3, 3, '2025-10-05 20:32:05', 'MASUK', 5, 'Pembelian baru'),
(4, 4, '2025-10-05 20:32:05', 'KELUAR', 2, 'Penjualan online'),
(5, 5, '2025-10-05 20:32:05', 'PINDAH', 1, 'Dipindah ke Rak B2'),
(6, 6, '2025-10-05 20:32:05', 'MASUK', 10, 'Stok baru dari supplier'),
(7, 7, '2025-10-05 20:32:05', 'KELUAR', 1, 'Digunakan untuk servis'),
(8, 8, '2025-10-05 20:32:05', 'PINDAH', 2, 'Relokasi display'),
(9, 9, '2025-10-05 20:32:05', 'MASUK', 3, 'Add stock'),
(10, 10, '2025-10-05 20:32:05', 'KELUAR', 4, 'Order pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `tugas` varchar(100) DEFAULT NULL,
  `no_telpon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `tugas`, `no_telpon`) VALUES
(1, 'Budi Santoso', 'Admin Gudang', '081234567890'),
(2, 'Rina Marlina', 'Pencatat Stok', '082345678901'),
(3, 'Andi Wijaya', 'Kurir Internal', '083456789012'),
(4, 'Siti Rahma', 'Pemeriksa Barang', '084567890123'),
(5, 'Rangga Wijaya', 'Maintenance', '085678901234'),
(6, 'Dewi Lestari', 'Input Data', '086789012345'),
(7, 'Agus Saputra', 'Packing Barang', '087890123456'),
(8, 'Yudi Pratama', 'Pengiriman', '088901234567'),
(9, 'Fitri Handayani', 'Quality Control', '089012345678'),
(10, 'Hendra Gunawan', 'Operator Forklift', '081223344556');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `lokasi_id` (`lokasi_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
