<?php
require_once '../app/models/LoginModel.php';

class LoginController {
    private $LoginModel;

    public function __construct() {
        $this->LoginModel = new Login();
    }

    public function index() {
        $ErrorMessage = null;
        if (isset($_SESSION['Message_Invalid'])) {
            $ErrorMessage = $_SESSION['Message_Invalid'];
            unset($_SESSION['Message_Invalid']);
        }
        require_once '../app/views/form/login.php';
    }

    public function CheckLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->LoginModel->CheckUser($username, $password);

        if ($user) {
            $kategori = $this->LoginModel->CheckKategoriUser($username);
            $KategoriUser = $kategori['kategori'];

            $_SESSION['username'] = $username;

            if ($KategoriUser == 0) {
                $_SESSION['role'] = 'superadmin';
                header('Location: index.php');
                exit;
            } elseif ($KategoriUser == 1) {
                $_SESSION['role'] = 'operator';
                header('Location: index.php');
                exit;
            } elseif ($KategoriUser == 2) {
                $_SESSION['role'] = 'pegawai';
                header('Location: index.php ');
                exit;
            }
        } else {
            $_SESSION['Message_Invalid'] = [
                'message' => 'Username atau password salah!',
                'type' => 'error'
            ];
            header('Location: index.php');
            exit;
        }
    }
}