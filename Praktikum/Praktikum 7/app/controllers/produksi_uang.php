<?php
session_start();
require_once '../app/models/produksi_uang_model.php';
require_once '../app/core/validator.php';
require_once '../app/core/Csrf.php';
require_once '../app/repositories/ProduksiRepository.php';
require_once '../app/helpers/Sanitizer.php';
require_once '../app/helpers/DateHelper.php';


class Produksi_Uang {
    private $model;
    private $validator;

    public function __construct() {
        $this->model = new Produksi_Uang_Model();
        $this->validator = new Validator();
        $this->repository = new Repository();
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
                require_once "../app/views/tabel/tabel_data/mesin.php"; 
                break;
            case 'bahan_baku':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getBahanBaku($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/tabel/tabel_data/bahan_baku.php";
                break;
            case 'operator':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getOperator($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/tabel/tabel_data/operator.php";
                break;
            case 'produksi':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getProduksi($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/tabel/tabel_data/produksi.php";
                break;
            case 'quality_check':
                if (isset($_POST['search'])) {
                    $_POST['search'] = trim($_POST['search']);
                }
                $result = $this->model->getQualityCheck($records_per_page, $offset);
                $data = $result['data'];
                $total_records = $result['total_records'];
                require_once "../app/views/tabel/tabel_data/quality_check.php";
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
                require_once "../app/views/tabel/tabel_restore/mesin.php"; 
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
                require_once "../app/views/tabel/tabel_restore/bahan_baku.php";
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
                require_once "../app/views/tabel/tabel_restore/operator.php";
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
                require_once "../app/views/tabel/tabel_restore/produksi.php";
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
                require_once "../app/views/tabel/tabel_restore/quality_check.php";
                break;


            case 'tambah_mesin':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    csrf::verifyOrFail($_POST['csrf_token'] ?? '');
                    $nama_mesin = $_POST['nama_mesin'];
                    $kapasitas_per_jam = Sanitizer::alphanumeric($_POST['kapasitas_per_jam']);
                    $tahun_pembuatan = $_POST['tahun_pembuatan'];

                    $Opsi_Kapasitas_Per_Jam = [500, 1000, 1500, 2000, 2500];
                    $this->validator->in($kapasitas_per_jam, 'Kapasitas Per Jam', $Opsi_Kapasitas_Per_Jam);
                    $this->validator->between($tahun_pembuatan, 2010, date('Y'), 'Tahun Pembuatan');

                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }

                    $this->model->addMesin($nama_mesin, $kapasitas_per_jam, $tahun_pembuatan);
                    header("Location: index.php?view=mesin");
                    exit;
                }
                require_once "../app/views/form/tambah.php";
                break;
            case 'tambah_bahan_baku':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    csrf::verifyOrFail($_POST['csrf_token'] ?? '');
                    $nama_bahan = $_POST['nama_bahan'];
                    $jenis = $_POST['jenis'];
                    $stok = Sanitizer::alphanumeric($_POST['stok']);

                    $this->validator->between($stok, 5000, 20000, 'Stok');

                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }

                    $this->model->addBahanBaku($nama_bahan, $jenis, $stok);
                    header("Location: index.php?view=bahan_baku");
                    exit;
                }
                require_once "../app/views/form/tambah.php";
                break;
            case 'tambah_operator':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama = Sanitizer::name($_POST['nama']);
                    $nomor = Sanitizer::phone($_POST['nomor']);
                    $shift = $_POST['shift'];

                    $this->validator->unique($nomor, 'Nomor', 'operators', 'nomor');

                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }                    
                    $this->model->addOperator($nama, $nomor, $shift);
                    header("Location: index.php?view=operator");
                    exit;
                }
                require_once "../app/views/form/tambah.php";
                break;
            case 'tambah_produksi':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    csrf::verifyOrFail($_POST['csrf_token'] ?? '');
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

                    $this->validator->dateFormat($tanggal, 'Tanggal', 'Y-m-d');
                    $this->validator->between($jumlah_lembar, 10000, 50000, 'Jumlah Lembar');


                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }

                    $this->model->addProduksi($tanggal, $jumlah_lembar, $mesin_id, $bahan_id, $operator_id);
                    header("Location: index.php?view=produksi");
                    exit;
                }
                require_once "../app/views/form/tambah.php";
                break;
            case 'tambah_quality_check':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    csrf::verifyOrFail($_POST['csrf_token'] ?? '');
                    $produksi_id = $_POST['produksi_id'];
                    $kondisi = $_POST['tingkat_cacat']; 
                    $jumlah = Sanitizer::alphanumeric($_POST['jumlah']);
                    $status = $_POST['status'];
                    $catatan = $_POST['catatan'];
                    $this->model->addQualityCheck($produksi_id, $kondisi, $jumlah, $status, $catatan);
                    header("Location: index.php?view=quality_check");
                    exit;
                }
                require_once "../app/views/form/tambah.php";
                break;

            case 'edit_mesin':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailMesin = $this->model->getMesinById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_mesin = $_POST['nama_mesin'];
                    $kapasitas_per_jam = Sanitizer::alphanumeric($_POST['kapasitas_per_jam']);
                    $tahun_pembuatan = $_POST['tahun_pembuatan'];

                    $Opsi_Kapasitas_Per_Jam = [500, 1000, 1500, 2000, 2500];
                    $this->validator->in($kapasitas_per_jam, 'Kapasitas Per Jam', $Opsi_Kapasitas_Per_Jam);
                    $this->validator->between($tahun_pembuatan, 2010, date('Y'), 'Tahun Pembuatan');

                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }

                    $this->model->updateMesin($id, $nama_mesin, $kapasitas_per_jam, $tahun_pembuatan);
                    header("Location: index.php?view=mesin");
                    exit;
                }
                require_once "../app/views/form/edit.php";
                break;
 

            case 'edit_bahan_baku':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailBahanBaku = $this->model->getBahanBakuById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_bahan = $_POST['nama_bahan'];
                    $jenis = $_POST['jenis'];
                    $stok = Sanitizer::alphanumeric($_POST['stok']);

                    $this->validator->between($stok, 5000, 20000, 'Stok');

                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }

                    $this->model->updateBahanBaku($id, $nama_bahan, $jenis, $stok);
                    header("Location: index.php?view=bahan_baku");
                    exit;
                }
                require_once "../app/views/form/edit.php";
                break;
            case 'edit_operator':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailOperator = $this->model->getOperatorById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama = Sanitizer::name($_POST['nama']);
                    $nomor = Sanitizer::phone($_POST['nomor']);
                    $shift = $_POST['shift'];

                    $this->validator->unique($nomor, 'Nomor', 'operators', 'nomor');

                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form/tambah.php";
                        break;
                    }          

                    $this->model->updateOperator($id, $nama, $nomor, $shift);
                    header("Location: index.php?view=operator");
                    exit;
                }
                require_once "../app/views/form/edit.php";
                break;

            case 'edit_produksi':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailProduksi = $this->model->getProduksiById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $tanggal = $_POST['tanggal'];
                    $jumlah_lembar = Sanitizer::alphanumeric($_POST['jumlah_lembar']);
                    $mesin_id = $_POST['mesin_id'];
                    $bahan_id = $_POST['bahan_id'];
                    $operator_id = $_POST['operator_id'];
                    $this->validator->dateFormat($tanggal, 'Tanggal', 'Y-m-d');
                    $this->validator->between($jumlah_lembar, 10000, 50000, 'Jumlah Lembar');
                    if (!empty($this->validator->errors())) {
                        $errors = $this->validator->errors();
                        require_once "../app/views/form /edit.php";
                        break;
                    }
                    $this->model->updateProduksi($id, $tanggal, $jumlah_lembar, $mesin_id, $bahan_id, $operator_id);
                    header("Location: index.php?view=produksi");
                    exit;
                }
                require_once "../app/views/form/edit.php";
                break;

            case 'edit_quality_check':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailQualityCheck = $this->model->getQualityControlById($id);
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $produksi_id = $_POST['produksi_id'];
                    $jumlah = Sanitizer::alphanumeric($_POST['jumlah']);
                    $tingkat_cacat = $_POST['tingkat_cacat'];
                    $status = $_POST['status'];
                    $catatan = $_POST['catatan'];


                    $this->model->updateQualityCheck($id ,$produksi_id, $jumlah, $tingkat_cacat, $status, $catatan);
                    header("Location: index.php?view=quality_check");
                    exit;
                }
                require_once "../app/views/form/edit.php";
                break;

            case 'hapus_mesin':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $result = $this->model->deleteMesin($id);
                    $_SESSION['flash_message'] = $result['message'];
                    $_SESSION['flash_type'] = $result['success'] ? 'success' : 'error';
                }
                header("Location: index.php?view=mesin");
                exit;
                break;
            case 'hapus_bahan_baku':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $result = $this->model->deleteBahanBaku($id);
                    $_SESSION['flash_message'] = $result['message'];
                    $_SESSION['flash_type'] = $result['success'] ? 'success' : 'error';
                }
                header("Location: index.php?view=bahan_baku");
                exit;
                break;
            case 'hapus_operator':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $result = $this->model->deleteOperator($id);
                    $_SESSION['flash_message'] = $result['message'];
                    $_SESSION['flash_type'] = $result['success'] ? 'success' : 'error';
                }
                header("Location: index.php?view=operator");
                exit;
                break;

            case 'hapus_produksi':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $result = $this->model->deleteProduksi($id);
                    $_SESSION['flash_message'] = $result['message'];
                    $_SESSION['flash_type'] = $result['success'] ? 'success' : 'error';
                }
                header("Location: index.php?view=produksi");
                exit;
                break;

            case 'hapus_quality_check':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $result = $this->model->deleteQualityCheck($id);
                    $_SESSION['flash_message'] = $result['message'];
                    $_SESSION['flash_type'] = $result['success'] ? 'success' : 'error';
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

            case 'bulk_action':
                $ids = isset($_POST['ids']) && is_array($_POST['ids']) ? array_map('intval', $_POST['ids']) : [];
                $action = $_POST['action'] ?? '';
                $view = $_POST['view'] ?? '';
                

                $table = '';
                if (strpos($view, 'mesin') !== false) $table = 'mesin';
                elseif (strpos($view, 'bahan_baku') !== false) $table = 'bahan_baku';
                elseif (strpos($view, 'operator') !== false) $table = 'operator';
                elseif (strpos($view, 'produksi') !== false) $table = 'produksi';
                elseif (strpos($view, 'quality_check') !== false) $table = 'quality_check';
                
                if (!empty($ids) && !empty($table)) {
                    if (strpos($view, '_restore') !== false) {

                        if ($action === 'restore') {
                            $result = $this->repository->restoreBulk($table, $ids);
                        } elseif ($action === 'delete') {
                            $result = $this->repository->forceDeleteBulk($table, $ids);
                        }
                    } else {

                        if ($action === 'delete') {
                            $result = $this->model->softDeleteBulk($table, $ids);
                        }
                    }
                    
                    if (isset($result)) {
                        $_SESSION['flash_message'] = $result['message'];
                        $_SESSION['flash_type'] = $result['success'] ? 'success' : 'error';
                    }
                } else {
                    $_SESSION['flash_message'] = 'Please select at least one item.';
                    $_SESSION['flash_type'] = 'error';
                }

                header("Location: index.php?view={$view}");
                exit;
                break;
            
            case 'auto_delete':
                $days = isset($_GET['days']) ? (int)$_GET['days'] : 30;
                $result = $this->repository->autoDeleteOld($days);
                
                if ($result['success']) {
                    $_SESSION['flash_message'] = "Successfully deleted {$result['count']} old records";
                    $_SESSION['flash_type'] = 'success';
                } else {
                    $_SESSION['flash_message'] = $result['message'];
                    $_SESSION['flash_type'] = 'error';
                }
                
                header("Location: " . $_SERVER['HTTP_REFERER'] ?? 'index.php');
                exit;
                break;
                
            default:
                require '../app/views/home/index.php';
        }
    }
}
?>
