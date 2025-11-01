-- Tabel Kategori
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi VARCHAR(255)
);

-- Tabel Lokasi
CREATE TABLE lokasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lokasi VARCHAR(100) NOT NULL,
    deskripsi VARCHAR(255)
);

-- Tabel Barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    kategori_id INT,
    lokasi_id INT,
    satuan VARCHAR(50),
    stok INT DEFAULT 0,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE,
    FOREIGN KEY (lokasi_id) REFERENCES lokasi(id) ON DELETE CASCADE
);

-- Tabel Petugas
CREATE TABLE petugas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_petugas VARCHAR(100) NOT NULL,
    tugas VARCHAR(100),
    no_telpon VARCHAR(20)
);

-- Tabel Mutasi
CREATE TABLE mutasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    barang_id INT,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    tipe ENUM('MASUK','KELUAR','PINDAH') NOT NULL,
    jumlah INT NOT NULL,
    keterangan VARCHAR(255),
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE
);
