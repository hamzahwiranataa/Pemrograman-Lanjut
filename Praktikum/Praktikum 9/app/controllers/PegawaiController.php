<?php
require_once '../app/models/PegawaiModel.php';

class PegawaiController {
    private $Pegawai;

    public function __construct() {
        $this->Pegawai = new Pegawai();
    }
    public function index() {
        $username = $_SESSION['username'];
        $row = $this->Pegawai->GetUserData($username);

        require_once '../app/views/pegawai/home.php';
    }

    public function data_produksi() {
        $datas = $this->Pegawai->GetAllData();
        require_once '../app/views/pegawai/data_produksi.php';
    }

    public function tambah_produksi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $_POST['tanggal'];
            $varian = $_POST['varian'];
            $jumlah_lembar = $_POST['jumlah_lembar'];

            $this->Pegawai->tambah_data_produksi($tanggal, $varian, $jumlah_lembar);
            header('Location: index.php?action=data');
            exit;
        }
        require '../app/views/form/pegawai/tambahdata.php';
    }

    public function edit_produksi($id) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = $_POST['id'];
            $tanggal = $_POST['tanggal'];
            $varian = $_POST['varian'];
            $jumlah_lembar = $_POST['jumlah_lembar'];

            $this->Pegawai->edit_data_produksi($tanggal, $varian, $jumlah_lembar, $id);
            header('Location: index.php?action=data');
            exit;
        }

        $data = $this->Pegawai->GetDataById($id);
        require '../app/views/form/pegawai/editdata.php';     
    }
}
?>