-- INSERT KATEGORI
INSERT INTO kategori (nama_kategori, deskripsi) VALUES
('Laptop', 'Perangkat komputer portabel'),
('Smartphone', 'Telepon pintar berbasis Android/iOS'),
('Aksesoris', 'Perangkat tambahan elektronik'),
('Audio', 'Peralatan suara dan musik'),
('Gaming', 'Peralatan untuk bermain game'),
('Networking', 'Peralatan jaringan internet'),
('Storage', 'Penyimpanan data'),
('Komputer Rakitan', 'Komponen PC'),
('Peripherals', 'Peralatan input/output'),
('Smart Home', 'Perangkat rumah pintar');

-- INSERT LOKASI
INSERT INTO lokasi (lokasi, deskripsi) VALUES
('Gudang Utama', 'Penyimpanan pusat'),
('Rak A1', 'Area laptop'),
('Rak B2', 'Area smartphone'),
('Rak C3', 'Aksesoris kecil'),
('Rak D4', 'Perangkat audio'),
('Rak E5', 'Gaming gear'),
('Rak F6', 'Networking dan kabel'),
('Rak G7', 'Hardisk & SSD'),
('Rak H8', 'Komponen PC'),
('Rak I9', 'Smart Home Device');

-- INSERT BARANG
INSERT INTO barang (nama_barang, kategori_id, lokasi_id, satuan, stok) VALUES
('Asus ROG Zephyrus', 1, 2, 'Unit', 5),
('iPhone 14 Pro', 2, 3, 'Unit', 8),
('Earphone Bluetooth JBL', 4, 5, 'Unit', 15),
('Logitech G502 Mouse', 5, 6, 'Unit', 12),
('TP-Link Router AX1800', 6, 7, 'Unit', 10),
('Samsung SSD 1TB', 7, 8, 'Unit', 20),
('Intel Core i7 12700K', 8, 9, 'Unit', 7),
('Mechanical Keyboard Keychron', 9, 6, 'Unit', 14),
('Google Nest Mini', 10, 10, 'Unit', 6),
('Xiaomi Powerbank 20.000mAh', 3, 4, 'Unit', 18);

-- INSERT PETUGAS
INSERT INTO petugas (nama_petugas, tugas, no_telpon) VALUES
('Budi Santoso', 'Admin Gudang', '081234567890'),
('Rina Marlina', 'Pencatat Stok', '082345678901'),
('Andi Wijaya', 'Kurir Internal', '083456789012'),
('Siti Rahma', 'Pemeriksa Barang', '084567890123'),
('Rangga Wijaya', 'Maintenance', '085678901234'),
('Dewi Lestari', 'Input Data', '086789012345'),
('Agus Saputra', 'Packing Barang', '087890123456'),
('Yudi Pratama', 'Pengiriman', '088901234567'),
('Fitri Handayani', 'Quality Control', '089012345678'),
('Hendra Gunawan', 'Operator Forklift', '081223344556');

-- INSERT MUTASI
INSERT INTO mutasi (barang_id, tipe, jumlah, keterangan) VALUES
(1, 'MASUK', 2, 'Restock dari distributor'),
(2, 'KELUAR', 1, 'Dikirim ke toko A'),
(3, 'MASUK', 5, 'Pembelian baru'),
(4, 'KELUAR', 2, 'Penjualan online'),
(5, 'PINDAH', 1, 'Dipindah ke Rak B2'),
(6, 'MASUK', 10, 'Stok baru dari supplier'),
(7, 'KELUAR', 1, 'Digunakan untuk servis'),
(8, 'PINDAH', 2, 'Relokasi display'),
(9, 'MASUK', 3, 'Add stock'),
(10, 'KELUAR', 4, 'Order pelanggan');
