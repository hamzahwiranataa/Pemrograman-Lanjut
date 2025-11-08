<?php
require_once '../app/models/OperatorModel.php';

class OperatorController {
    private $Operator;

    public function __construct() {
        $this->Operator = new Operator();
    }

    public function index() {
        $username = $_SESSION['username'];
        $row = $this->Operator->GetUserData($username);
        require_once  '../app/views/operator/home.php';
    }

    public function data_produksi() {
        $datas = $this->Operator->GetAllData();
        require_once '../app/views/Operator/data_produksi.php';
    }

    public function tambah_produksi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal = $_POST['tanggal'];
            $varian = $_POST['varian'];
            $jumlah_lembar = $_POST['jumlah_lembar'];

            $this->Operator->tambah_data_produksi($tanggal, $varian, $jumlah_lembar);
            header('Location: index.php?action=data');
            exit;
        }
        require '../app/views/form/Operator/tambahdata.php';
    }

    public function edit_produksi($id) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = $_POST['id'];
            $tanggal = $_POST['tanggal'];
            $varian = $_POST['varian'];
            $jumlah_lembar = $_POST['jumlah_lembar'];

            $this->Operator->edit_data_produksi($tanggal, $varian, $jumlah_lembar, $id);
            header('Location: index.php?action=data');
            exit;
        }

        $data = $this->Operator->GetDataById($id);
        require '../app/views/form/Operator/editdata.php';     
    }

    public function setuju($id){
        if(!$id){
            header('Location: index.php?action=data');
        }
        $this->Operator->setuju_perunding($id);
        header('Location: index.php?action=data');        

    }

    public function tolak($id){
        if(!$id){
            header('Location: index.php?action=data');
        }
        $this->Operator->tolak_perunding($id);
        header('Location: index.php?action=data');        

    }

    public function hapus_produksi($id) {
        if(!$id){
            header('Location: index.php?action=data');
        }
        $this->Operator->hapus($id);
        header('Location: index.php?action=data');        
    }
}
?>