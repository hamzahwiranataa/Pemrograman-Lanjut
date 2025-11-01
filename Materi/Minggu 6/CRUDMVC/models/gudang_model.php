<?php
class Gudang_Model {
    private $conn;

    public function __construct() {

        $this->conn = new mysqli('localhost', 'root', '', 'pl5_gudang_barang');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function getKategori() {
        $result = $this->conn->query("SELECT * FROM kategori");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getBarang() {
        $result = $this->conn->query("SELECT * FROM barang");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getPetugas() {
        $result = $this->conn->query("SELECT * FROM petugas");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getMutasi() {
        $result = $this->conn->query("SELECT * FROM mutasi");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getLokasi() {
        $result = $this->conn->query("SELECT * FROM lokasi");
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    public function getKategoriById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM kategori WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getBarangById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPetugasById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM petugas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getMutasiById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM mutasi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getLokasiById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM lokasi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addKategori($nama, $deskripsi) {
        
        $stmt = $this->conn->prepare("INSERT INTO kategori (nama_kategori, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $deskripsi);
        return $stmt->execute();
    }
    public function addBarang($nama_barang, $kategori_id, $lokasi_id, $satuan, $stok) {
        $stmt = $this->conn->prepare("INSERT INTO barang (nama_barang, kategori_id, lokasi_id, satuan, stok) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siisi", $nama_barang, $kategori_id, $lokasi_id, $satuan, $stok);
        return $stmt->execute();
    }
    public function addPetugas($nama_petugas, $tugas, $no_telpon) {
        $stmt = $this->conn->prepare("INSERT INTO petugas (nama_petugas, tugas, no_telpon) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama_petugas, $tugas, $no_telpon);
        return $stmt->execute();
    }
    public function addMutasi($barang_id, $tanggal, $tipe, $jumlah, $keterangan) {
        $stmt = $this->conn->prepare("INSERT INTO mutasi (barang_id, tanggal, tipe, jumlah, keterangan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $barang_id, $tanggal, $tipe, $jumlah, $keterangan);
        return $stmt->execute();
    }
    public function addLokasi($lokasi, $deskripsi) {
        $stmt = $this->conn->prepare("INSERT INTO lokasi (lokasi, deskripsi) VALUES (?, ?)");
        $stmt->bind_param("ss", $lokasi, $deskripsi);
        return $stmt->execute();
    }

    public function updateKategori($id, $nama, $deskripsi) {
        $stmt = $this->conn->prepare("UPDATE kategori SET nama_kategori = ?, deskripsi = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nama, $deskripsi, $id);
        return $stmt->execute();
    }

    public function updateBarang($id, $nama_barang, $kategori_id, $lokasi_id, $satuan, $stok) {
        $stmt = $this->conn->prepare("UPDATE barang SET nama_barang = ?, kategori_id = ?, lokasi_id = ?, satuan = ?, stok = ? WHERE id = ?");
        $stmt->bind_param("siisii", $nama_barang, $kategori_id, $lokasi_id, $satuan, $stok, $id);
        return $stmt->execute();
    }
    
    public function updatePetugas($id, $nama_petugas, $tugas, $no_telpon) {
        $stmt = $this->conn->prepare("UPDATE petugas SET nama_petugas = ?, tugas = ?, no_telpon = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nama_petugas, $tugas, $no_telpon, $id);
        return $stmt->execute();
    }

    public function updateMutasi($id, $barang_id, $tanggal, $tipe, $jumlah, $keterangan) {
        $stmt = $this->conn->prepare("UPDATE mutasi SET barang_id = ?, tanggal = ?, tipe = ?, jumlah = ?, keterangan = ? WHERE id = ?");
        $stmt->bind_param("issisi", $barang_id, $tanggal, $tipe, $jumlah, $keterangan, $id);
        return $stmt->execute();
    }
    public function updateLokasi($id, $lokasi, $deskripsi) {
        $stmt = $this->conn->prepare("UPDATE lokasi SET lokasi = ?, deskripsi = ? WHERE id = ?");
        $stmt->bind_param("ssi", $lokasi, $deskripsi, $id);
        return $stmt->execute();
    }

    public function deleteKategori($id) {
        $stmt = $this->conn->prepare("DELETE FROM kategori WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function deleteBarang($id) {
        $stmt = $this->conn->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function deletePetugas($id) {
        $stmt = $this->conn->prepare("DELETE FROM petugas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function deleteMutasi($id) {
        $stmt = $this->conn->prepare("DELETE FROM mutasi WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function deleteLokasi($id) {
        $stmt = $this->conn->prepare("DELETE FROM lokasi WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
