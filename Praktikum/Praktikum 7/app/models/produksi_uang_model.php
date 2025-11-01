<?php

require_once '../app/core/database.php';
class Produksi_Uang_Model extends Database {
    
    public function countMesin() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM mesin WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_mesin LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countBahanBaku() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM bahan_baku WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_bahan LIKE '$search' OR jenis LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countOperator() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM operator WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama LIKE '$search' OR shift LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countProduksi() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM produksi WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (jumlah_lembar LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countQualityCheck() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM quality_check WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (status LIKE '$search' OR catatan LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }


    public function isMesinAvailable($mesin_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM mesin WHERE id = ? AND hapus = false");
        $stmt->bind_param("i", $mesin_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function isBahanBakuAvailable($bahan_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM bahan_baku WHERE id = ? AND hapus = false");
        $stmt->bind_param("i", $bahan_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function isOperatorAvailable($operator_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as count FROM operator WHERE id = ? AND hapus = false");
        $stmt->bind_param("i", $operator_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function getMesin($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['nama_mesin', 'kapasitas_per_jam', 'tahun_pembuatan'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM mesin WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_mesin LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        return [
            'data' => $data,
            'total_records' => $this->countMesin()
        ];
    }

    public function getBahanBaku($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['nama_bahan', 'jenis', 'stok'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM bahan_baku WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_bahan LIKE '$search' OR jenis LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countBahanBaku()
        ];
    }

    public function getOperator($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['nama', 'shift'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM operator WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama LIKE '$search' OR shift LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countOperator()
        ];
    }

    public function getProduksi($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['tanggal', 'jumlah_lembar', 'mesin_id', 'bahan_id', 'operator_id'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM produksi WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (jumlah_lembar LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countProduksi()
        ];
    }

    public function getQualityCheck($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['produksi_id', 'tingkat_cacat', 'jumlah', 'status', 'catatan'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM quality_check WHERE hapus = false";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (status LIKE '$search' OR catatan LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countQualityCheck()
        ];
    }

    public function countMesinRestore() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM mesin WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_mesin LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countBahanBakuRestore() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM bahan_baku WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_bahan LIKE '$search' OR jenis LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countOperatorRestore() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM operator WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama LIKE '$search' OR shift LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countProduksiRestore() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM produksi WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (jumlah_lembar LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function countQualityCheckRestore() {
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $sql = "SELECT COUNT(*) as total FROM quality_check WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (status LIKE '$search' OR catatan LIKE '$search')";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()['total'];
    }

    public function getMesinRestore($limit = null, $offset = null){
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['nama_mesin', 'kapasitas_per_jam', 'tahun_pembuatan'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM mesin WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_mesin LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countMesinRestore()
        ];

    }

    public function getBahanBakuRestore($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['nama_bahan', 'jenis', 'stok'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM bahan_baku WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama_bahan LIKE '$search' OR jenis LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countBahanBakuRestore()
        ];
    }

    public function getOperatorRestore($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['nama', 'shift'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM operator WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (nama LIKE '$search' OR shift LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countOperatorRestore()
        ];
    }

    public function getProduksiRestore($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['tanggal', 'jumlah_lembar', 'mesin_id', 'bahan_id', 'operator_id'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM produksi WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (jumlah_lembar LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countProduksiRestore()
        ];
    }
    public function getQualityCheckRestore($limit = null, $offset = null) {
        $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'id';
        $sort_dir = isset($_GET['sort_dir']) ? $_GET['sort_dir'] : 'ASC';
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        
        $allowed_columns = ['produksi_id', 'tingkat_cacat', 'jumlah', 'status', 'catatan'];
        
        if (!in_array($sort_col, $allowed_columns)) {
            $sort_col = 'id';
        }
        
        if (!in_array(strtoupper($sort_dir), ['ASC', 'DESC'])) {
            $sort_dir = 'ASC';
        }
        
        $sql = "SELECT * FROM quality_check WHERE hapus = true";
        if (!empty($search)) {
            $search = "%" . $this->conn->real_escape_string($search) . "%";
            $sql .= " AND (status LIKE '$search' OR catatan LIKE '$search')";
        }
        $sql .= " ORDER BY $sort_col $sort_dir";
        
        if ($limit !== null && $offset !== null) {
            $sql .= " LIMIT $offset, $limit";
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return [
            'data' => $data,
            'total_records' => $this->countQualityCheckRestore()
        ];
    }

    public function getMesinById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM mesin WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getBahanBakuById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM bahan_baku WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getOperatorById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM operator WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getQualityControlById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM quality_check WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addMesin($nama_mesin, $kapasitas_per_jam, $tahun_pembuatan) {
        $stmt = $this->conn->prepare("INSERT INTO mesin (nama_mesin, kapasitas_per_jam, tahun_pembuatan) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $nama_mesin, $kapasitas_per_jam, $tahun_pembuatan);
        return $stmt->execute();
    }
    public function addBahanBaku($nama_bahan, $jenis, $stok) {
        $stmt = $this->conn->prepare("INSERT INTO bahan_baku (nama_bahan, jenis, stok) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nama_bahan, $jenis, $stok);
        return $stmt->execute();
    }
    public function addOperator($nama, $shift) {
        $stmt = $this->conn->prepare("INSERT INTO operator (nama, shift) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $shift);
        return $stmt->execute();
    }
    public function addProduksi($tanggal, $jumlah_lembar, $mesin_id, $bahan_id, $operator_id) {
        $stmt = $this->conn->prepare("INSERT INTO produksi (tanggal, jumlah_lembar, mesin_id, bahan_id, operator_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiii", $tanggal, $jumlah_lembar, $mesin_id, $bahan_id, $operator_id);
        return $stmt->execute();
    }
    public function addQualityCheck($produksi_id, $tingkat_cacat, $jumlah, $status, $catatan) {
        $stmt = $this->conn->prepare("INSERT INTO quality_check (produksi_id, tingkat_cacat, jumlah, status, catatan) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $produksi_id, $tingkat_cacat, $jumlah, $status, $catatan);
        return $stmt->execute();
    }

    public function updateMesin($id, $nama_mesin, $kapasitas_per_jam, $tahun_pembuatan) {
        $stmt = $this->conn->prepare("UPDATE mesin SET nama_mesin = ?, kapasitas_per_jam = ?, tahun_pembuatan = ? WHERE id = ?");
        $stmt->bind_param("siii", $nama_mesin, $kapasitas_per_jam, $tahun_pembuatan, $id);
        return $stmt->execute();
    }

    public function updateBahanBaku($id, $nama_bahan, $jenis, $stok) {
        $stmt = $this->conn->prepare("UPDATE bahan_baku SET nama_bahan = ?, jenis = ?, stok = ? WHERE id = ?");
        $stmt->bind_param("ssii", $nama_bahan, $jenis, $stok, $id);
        return $stmt->execute();
    }

    public function updateOperator($id, $nama, $shift) {
        $stmt = $this->conn->prepare("UPDATE operator SET nama = ?, shift = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nama, $shift, $id);
        return $stmt->execute();
    }
    
    public function updateQualityCheck($id, $produksi_id, $jumlah, $tingkat_cacat, $status, $catatan) {
        $stmt = $this->conn->prepare("UPDATE quality_check SET produksi_id = ?, jumlah = ?, tingkat_cacat = ?, status = ?, catatan = ? WHERE id = ?");
        $stmt->bind_param("iiissi", $produksi_id, $jumlah, $tingkat_cacat, $status, $catatan , $id);
        return $stmt->execute();
    }
    public function deleteMesin($id) {
        $stmt = $this->conn->prepare("UPDATE mesin SET hapus = true WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function deleteBahanBaku($id) {
        $stmt = $this->conn->prepare("UPDATE bahan_baku SET hapus = true WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function deleteOperator($id) {
        $stmt = $this->conn->prepare("UPDATE operator SET hapus = true WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function deleteProduksi($id) {
        $stmt = $this->conn->prepare("UPDATE produksi SET hapus = true WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function deleteQualityCheck($id) {
        $stmt = $this->conn->prepare("UPDATE quality_check SET hapus = true WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function restoreMesin($id) {
        $stmt = $this->conn->prepare("UPDATE mesin SET hapus = false WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function restoreBahanBaku($id) {
        $stmt = $this->conn->prepare("UPDATE bahan_baku SET hapus = false WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function restoreOperator($id) {
        $stmt = $this->conn->prepare("UPDATE operator SET hapus = false WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function restoreProduksi($id) {
        $stmt = $this->conn->prepare("UPDATE produksi SET hapus = false WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function restoreQualityCheck($id) {
        $stmt = $this->conn->prepare("UPDATE quality_check SET hapus = false WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
