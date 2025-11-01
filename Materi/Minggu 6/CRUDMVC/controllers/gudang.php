<?php
require_once '../models/gudang_model.php';

class Gudang {
    private $model;

    public function __construct() {
        $this->model = new Gudang_Model();
    }

    public function index() {
        $view = $_GET['view'] ?? null;
        $data = [];

        switch ($view) {
            case 'kategori':
                $data = $this->model->getKategori();
                require_once "../views/gudang/tabel_kategori.php";
                break;
            case 'barang':
                $data = $this->model->getBarang();
                require_once "../views/gudang/tabel_barang.php";
                break;
            case 'petugas':
                $data = $this->model->getPetugas();
                require_once "../views/gudang/tabel_petugas.php";
                break;
            case 'mutasi':
                $data = $this->model->getMutasi();
                require_once "../views/gudang/tabel_mutasi.php";
                break;
            case 'lokasi':
                $data = $this->model->getLokasi();
                require_once "../views/gudang/tabel_lokasi.php";
                break;

            case 'tambah_kategori':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];

                    $this->model->addKategori($nama, $deskripsi);

                   
                    header("Location: index.php?view=kategori");
                    exit;
                }
                require_once "../views/gudang/tambah.php";
                break;


            case 'tambah_barang':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_barang = $_POST['nama_barang'];
                    $kategori_id = $_POST['kategori_id'];
                    $lokasi_id = $_POST['lokasi_id'];
                    $satuan = $_POST['satuan'];
                    $stok = $_POST['stok'];

                    $this->model->addBarang($nama_barang, $kategori_id, $lokasi_id, $satuan, $stok);

                   
                    header("Location: index.php?view=barang");
                    exit;
                }
                require_once "../views/gudang/tambah.php";
                break;
            
            case 'tambah_petugas':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $nama_petugas = $_POST['nama_petugas'];
                    $tugas = $_POST['tugas'];
                    $no_telpon = $_POST['no_telpon'];

                    $this->model->addPetugas($nama_petugas, $tugas, $no_telpon);

                  
                    header("Location: index.php?view=petugas");
                    exit;
                }
                require_once "../views/gudang/tambah.php";
                break;

            case 'tambah_mutasi':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $barang_id = $_POST['barang_id'];
                    $tanggal = $_POST['tanggal'];
                    $tipe = $_POST['tipe'];
                    $jumlah = $_POST['jumlah'];
                    $keterangan = $_POST['keterangan'];
                   
                    $this->model->addMutasi($barang_id, $tanggal, $tipe, $jumlah, $keterangan);

               
                    header("Location: index.php?view=mutasi");
                    exit;
                }
                require_once "../views/gudang/tambah.php";
                break;

            case 'tambah_lokasi':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $lokasi = $_POST['lokasi'];
                    $deskripsi = $_POST['deskripsi'];

                    $this->model->addLokasi($lokasi, $deskripsi);

             
                    header("Location: index.php?view=lokasi");
                    exit;
                }
                require_once "../views/gudang/tambah.php";
                break;

            case 'edit_kategori':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $detailKategori = $this->model->getKategoriById($id); 
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_GET['id'];
                    $nama = $_POST['nama'];
                    $deskripsi = $_POST['deskripsi'];

                    $this->model->updateKategori($id, $nama, $deskripsi);

                 
                    header("Location: index.php?view=kategori");
                    exit;
                }
                require_once "../views/gudang/edit.php";
                break;

            case 'edit_barang':
                $id = $_GET['id'] ?? null;
                if ($id) {
            
                    $detailBarang = $this->model->getBarangById($id); 
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_GET['id'];
                    $nama_barang = $_POST['nama_barang'];
                    $kategori_id = $_POST['kategori_id'];
                    $lokasi_id = $_POST['lokasi_id'];
                    $satuan = $_POST['satuan'];
                    $stok = $_POST['stok'];

                    $this->model->updateBarang($id, $nama_barang, $kategori_id, $lokasi_id, $satuan, $stok);

                
                    header("Location: index.php?view=barang");
                    exit;
                }
                require_once "../views/gudang/edit.php";
                break;

            case 'edit_petugas':
                $id = $_GET['id'] ?? null;
                if ($id) {
            
                    $detailPetugas = $this->model->getPetugasById($id); 
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_GET['id'];
                    $nama_petugas = $_POST['nama_petugas'];
                    $tugas = $_POST['tugas'];
                    $no_telpon = $_POST['nomor_telpon'];

                    $this->model->updatePetugas($id, $nama_petugas, $tugas, $no_telpon);

             
                    header("Location: index.php?view=petugas");
                    exit;
                }
                require_once "../views/gudang/edit.php";
                break;

            case 'edit_lokasi':
                $id = $_GET['id'] ?? null;
                if ($id) {
     
                    $detailLokasi = $this->model->getLokasiById($id); 
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id = $_GET['id'];
                    $lokasi = $_POST['lokasi'];
                    $deskripsi = $_POST['deskripsi'];

                    $this->model->updateLokasi($id, $lokasi, $deskripsi);

                    header("Location: index.php?view=lokasi");
                    exit;
                }
                require_once "../views/gudang/edit.php";
                break;

            
                
            case 'hapus_kategori':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteKategori($id);
                }
                header("Location: index.php?view=kategori");
                exit;
                break;
            case 'hapus_barang':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteBarang($id);
                }
                header("Location: index.php?view=barang");
                exit;
                break;
            case 'hapus_petugas':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deletePetugas($id);
                }

                header("Location: index.php?view=petugas");
                exit;
                break;

            case 'hapus_lokasi':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->model->deleteLokasi($id);
                }
   
                header("Location: index.php?view=lokasi");
                exit;
                break;
            default:
                $view = 'dashboard';
        }

        require '../views/gudang/index.php';
    }
}
?>
