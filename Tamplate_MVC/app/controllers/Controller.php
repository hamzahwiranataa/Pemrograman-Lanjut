<?php
require_once __DIR__ . '/../models/User.php';

class Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // 1. Buat nampilin data di home
    public function index() {
        $users = $this->userModel->getAll();
        require __DIR__ . '/../views/home.php';
    }

    // 2. buat masuk ke form tambah
    public function formAdd() {
        require __DIR__ . '/../views/add.php';
    }

    // 3. buat masuk ke form edit
    public function formEdit($id) {
        $user = $this->userModel->getById($id);
        require __DIR__ . '/../views/edit.php';
    }

    // 4. buat fungsi tambah
    public function addUser($nama, $tipe) {
        $this->userModel->addUser($nama, $tipe);
        header("Location: index.php");
    }

    // 5. buat fungsi update
    public function updateUser($id, $nama, $tipe) {
        $this->userModel->updateUser($id, $nama, $tipe);
        header("Location: index.php");
    }

    // 6. buat fungsi delete
    public function deleteUser($id) {
        $this->userModel->deleteUser($id);
        header("Location: index.php");
    }
}
