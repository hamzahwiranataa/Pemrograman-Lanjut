<?php
require_once __DIR__ . '/../../config/database.php';

class User extends Database {

    // 1. GET ALL USERS
    public function getAll() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        $data = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // 2. GET USER BY ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 3. ADD USER
    public function addUser($nama, $tipe) {
        $stmt = $this->conn->prepare("INSERT INTO users (nama, tipe) VALUES (?, ?)");
        $stmt->bind_param("si", $nama, $tipe);
        return $stmt->execute();
    }

    // 4. UPDATE USER
    public function updateUser($id, $nama, $tipe) {
        $stmt = $this->conn->prepare("UPDATE users SET nama = ?, tipe = ? WHERE id = ?");
        $stmt->bind_param("sii", $nama, $tipe, $id);
        return $stmt->execute();
    }

    // 5. DELETE USER
    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
