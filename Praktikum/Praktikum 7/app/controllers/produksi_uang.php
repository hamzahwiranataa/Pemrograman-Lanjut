<?php
require_once '../app/models/produksi_uang_model.php';


class Produksi_Uang {
    private $model;

    public function __construct() {
        $this->model = new Produksi_Uang_Model();
    }

    public function index() {
        $view = $_GET['view'] ?? null;
        $data = [];
        

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $records_per_page = 10; 
        $offset = ($page - 1) * $records_per_page;

        switch ($view) {
            case 'mesin':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getMesin($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/produksi/tabel_data.php"; 
                break;
            case 'bahan_baku':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getBahanBaku($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/produksi/tabel_data.php";
                break;
            case 'operator':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getOperator($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/produksi/tabel_data.php";
                break;
            case 'produksi':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getProduksi($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/produksi/tabel_data.php";
                break;
            case 'quality_check':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getQualityCheck($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/produksi/tabel_data.php";
                break;

            case 'mesin_restore':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getMesinRestore($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                $total_pages = ceil($total_records / $records_per_page);
                $current_page = $page;
                require_once "../app/views/produksi/tabel_restore.php"; 
                break;
            case 'bahan_baku_restore':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getBahanBakuRestore($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                $total_pages = ceil($total_records / $records_per_page);
                $current_page = $page;
                require_once "../app/views/produksi/tabel_restore.php";
                break;
            case 'operator_restore':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getOperatorRestore($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                $total_pages = ceil($total_records / $records_per_page);
                $current_page = $page;
                require_once "../app/views/produksi/tabel_restore.php";
                break;
            case 'produksi_restore':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getProduksiRestore($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                $total_pages = ceil($total_records / $records_per_page);
                $current_page = $page;
                require_once "../app/views/produksi/tabel_restore.php";
                break;
            case 'quality_check_restore':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }   
                $result = $this->model->getQualityCheckRestore($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                $total_pages = ceil($total_records / $records_per_page);
                $current_page = $page;
                require_once "../app/views/produksi/tabel_restore.php";
                break;


            case 'tambah_mesin':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_mesin = $_POST['nama_mesin'];
                    $kapasitas_per_jam = $_POST['kapasitas_per_jam'];
                    $tahun_pembuatan = $_POST['tahun_pembuatan'];
                    $this->model->addMesin($nama_mesin, $kapasitas_per_jam, $tahun_pembuatan);
                    header("Location: index.php?view=mesin");
                    exit;
                }
                require_once "../app/views/produksi/tambah.php";
                break;
            case 'tambah_bahan_baku':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_bahan = $_POST['nama_bahan'];
                    $jenis = $_POST['jenis'];
                    $stok = $_POST['stok'];
                    $this->model->addBahanBaku($nama_bahan, $jenis, $stok);
                    header("Location: index.php?view=bahan_baku");
                    exit;
                }
                require_once "../app/views/produksi/tambah.php";
                break;
            case 'tambah_operator':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama = $_POST['nama'];
                    $shift = $_POST['shift'];
                    $this->model->addOperator($nama, $shift);
                    header("Location: index.php?view=operator");
                    exit;
                }
                require_once "../app/views/produksi/tambah.php";
                break;
            case 'tambah_produksi':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $tanggal = $_POST['tanggal'];
                    $jumlah_lembar = $_POST['jumlah_lembar'];
                    $mesin_id = $_POST['mesin_id'];
                    $bahan_id = $_POST['bahan_id'];
                    $operator_id = $_POST['operator_id'];

                    if (!$this->model->isMesinAvailable($mesin_id)) {
                        echo "<script>
                            alert('Mesin dengan ID $mesin_id tidak tersedia.');
                            window.location.href='index.php?view=tambah_produksi';
                        </script>";
                        exit;
                    }

                    if (!$this->model->isBahanBakuAvailable($bahan_id)) {
                        echo "<script>
                            alert('Bahan Baku dengan ID $bahan_id tidak tersedia.');
                            window.location.href='index.php?view=tambah_produksi';
                        </script>";
                        exit;
                    }

                    if (!$this->model->isOperatorAvailable($operator_id)) {
                        echo "<script>
                            alert('Operator dengan ID $operator_id tidak tersedia.');
                            window.location.href='index.php?view=tambah_produksi';
                        </script>";
                        exit;
                    }

                    $this->model->addProduksi($tanggal, $jumlah_lembar, $mesin_id, $bahan_id, $operator_id);
                    header("Location: index.php?view=produksi");
                    exit;
                }
                require_once "../app/views/produksi/tambah.php";
                break;
            case 'tambah_quality_check':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $produksi_id = $_POST['produksi_id'];
                    $kondisi = $_POST['tingkat_cacat'];
                    $jumlah = $_POST['jumlah'];
                    $status = $_POST['status'];
                    $catatan = $_POST['catatan'];
                    $this->model->addQualityCheck($produksi_id, $kondisi, $jumlah, $status, $catatan);
                    header("Location: index.php?view=quality_check");
                    exit;
                }
                require_once "../app/views/produksi/tambah.php";
                break;

            case 'edit_mesin':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailMesin = $this->model->getMesinById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_mesin = $_POST['nama_mesin'];
                    $kapasitas_per_jam = $_POST['kapasitas_per_jam'];
                    $tahun_pembuatan = $_POST['tahun_pembuatan'];
                    $this->model->updateMesin($id, $nama_mesin, $kapasitas_per_jam, $tahun_pembuatan);
                    header("Location: index.php?view=mesin");
                    exit;
                }
                require_once "../app/views/produksi/edit.php";
                break;
 

            case 'edit_bahan_baku':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailBahanBaku = $this->model->getBahanBakuById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_bahan = $_POST['nama_bahan'];
                    $jenis = $_POST['jenis'];
                    $stok = $_POST['stok'];
                    $this->model->updateBahanBaku($id, $nama_bahan, $jenis, $stok);
                    header("Location: index.php?view=bahan_baku");
                    exit;
                }
                require_once "../app/views/produksi/edit.php";
                break;
            case 'edit_operator':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailOperator = $this->model->getOperatorById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama = $_POST['nama'];
                    $shift = $_POST['shift'];
                    $this->model->updateOperator($id, $nama, $shift);
                    header("Location: index.php?view=operator");
                    exit;
                }
                require_once "../app/views/produksi/edit.php";
                break;
            case 'edit_quality_check':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailQualityCheck = $this->model->getQualityControlById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $produksi_id = $_POST['produksi_id'];
                    $jumlah = $_POST['jumlah'];
                    $tingkat_cacat = $_POST['tingkat_cacat'];
                    $status = $_POST['status'];
                    $catatan = $_POST['catatan'];
                    $this->model->updateQualityCheck($id ,$produksi_id, $jumlah, $tingkat_cacat, $status, $catatan);
                    header("Location: index.php?view=quality_check");
                    exit;
                }
                require_once "../app/views/produksi/edit.php";
                break;

            case 'hapus_mesin':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteMesin($id);
                }
                header("Location: index.php?view=mesin");
                exit;
                break;
            case 'hapus_bahan_baku':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteBahanBaku($id);
                }
                header("Location: index.php?view=bahan_baku");
                exit;
                break;
            case 'hapus_operator':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteOperator($id);
                }
                header("Location: index.php?view=operator");
                exit;
                break;

            case 'hapus_produksi':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteProduksi($id);
                }
                header("Location: index.php?view=produksi");
                exit;
                break;

            case 'hapus_quality_check':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteQualityCheck($id);
                }
                header("Location: index.php?view=quality_check");
                exit;
                break;

            case 'mesin_restore_data':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->restoreMesin($id);
                }
                header("Location: index.php?view=mesin_restore");
                exit;
                break;

            case 'bahan_baku_restore_data':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->restoreBahanBaku($id);
                }
                header("Location: index.php?view=bahan_baku_restore");
                exit;
                break;

            case 'operator_restore_data':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->restoreOperator($id);
                }
                header("Location: index.php?view=operator_restore");
                exit;
                break;

            case 'produksi_restore_data':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->restoreProduksi($id);
                }
                header("Location: index.php?view=produksi_restore");
                exit;
                break;

            case 'quality_check_restore_data':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->restoreQualityCheck($id);
                }
                header("Location: index.php?view=quality_check_restore");
                exit;
                break;
            default:
                $view = 'dashboard';
        }

        


        require '../app/views/produksi/index.php';
    }
}
?>
