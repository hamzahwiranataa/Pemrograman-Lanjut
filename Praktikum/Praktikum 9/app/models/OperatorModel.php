<?php

require_once '../core/database.php';

class Operator extends Database {
    
    public function GetUserData($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function GetAllData() {
        $sql = "SELECT * FROM data_produksi";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function GetDataById($id) {
        $sql = "SELECT * FROM data_produksi WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function tambah_data_produksi($tanggal, $varian, $jumlah_lembar) {
        $sql = "INSERT into data_produksi (tanggal, varian, jumlah_lembar, status) VALUES (?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $tanggal, $varian, $jumlah_lembar);
        return $stmt->execute();
    }

    public function edit_data_produksi($tanggal, $varian, $jumlah_lembar, $id) {
        $sql = "UPDATE data_produksi SET tanggal = ?, varian = ?, jumlah_lembar = ?, status = 0 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siii", $tanggal, $varian, $jumlah_lembar, $id);
        return $stmt->execute();
    }

    public function setuju_perunding($id) {
        $sql = "UPDATE data_produksi SET status = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);     
        $stmt->bind_param("i", $id); 
        return $stmt->execute();  
    }

    public function tolak_perunding($id) {
        $sql = "UPDATE data_produksi SET status = 2 WHERE id = ?";
        $stmt = $this->conn->prepare($sql);    
        $stmt->bind_param("i", $id);   
        return $stmt->execute();  
    }

    public function hapus($id) {
        $sql = "DELETE FROM data_produksi WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>