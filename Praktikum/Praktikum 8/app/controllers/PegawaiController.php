<?php
require_once '../app/models/PegawaiModel.php';

class PegawaiController {
    private $Pegawai;

    public function __construct() {
        $this->Pegawai = new Pegawai();
    }
    public function index() {
        require_once  '../app/views/pegawai/home.php';
    }
}
?>