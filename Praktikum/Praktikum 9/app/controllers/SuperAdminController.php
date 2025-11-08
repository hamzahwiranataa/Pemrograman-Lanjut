<?php
require_once  '../app/models/SuperAdminModel.php';

class SuperAdminController {
    private $SuperAdmin;

    public function __construct() {
        $this->SuperAdmin = new SuperAdmin();
    }

    public function index() {
        $username = $_SESSION['username'];
        $row = $this->SuperAdmin->GetUserData($username);

        require_once '../app/views/superadmin/home.php';
    }

    public function data_pengguna() {


        $users = $this->SuperAdmin->GetAllUsers();
        require_once '../app/views/superadmin/data_pengguna.php';
    }

    public function tambah(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $kategori = $_POST['kategori'];
            if($this->SuperAdmin->GetUserData($username)){
                $_SESSION['Message_Invalid'] = [
                    'message' => 'Username atau password sudah ada!',
                    'type' => 'error'
                ];
                header('Location: index.php?action=tambah');
                exit;
            }
            $this->SuperAdmin->tambahAkun($username, $password, $kategori);
            header('Location: index.php?action=data');
            exit;
        }
        $ErrorMessage = null;
        if (isset($_SESSION['Message_Invalid'])) {
            $ErrorMessage = $_SESSION['Message_Invalid'];
            unset($_SESSION['Message_Invalid']);
        }
        require '../app/views/form/superadmin/tambahakun.php';
    }

    public function hapus($username){
        if(!$username){
            header('Location: index.php?action=data');
        }
        $this->SuperAdmin->hapus($username);
        header('Location: index.php?action=data');
    }

    public function edit($username) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $usernameawal = $_POST['usernameawal'];
            $usernameBaru = $_POST['username'];
            $password = $_POST['password'];
            $kategori = $_POST['kategori'];

            if ($usernameawal != $usernameBaru) {
                if ($this->SuperAdmin->GetUserData($usernameBaru)) {
                    $_SESSION['Message_Invalid'] = [
                        'message' => 'Username sudah ada!',
                        'type' => 'error'
                    ];
                    header("Location: index.php?action=edit&username=" . urlencode($usernameawal));
                    exit;
                }
            }

            $this->SuperAdmin->edit($usernameawal, $usernameBaru, $password, $kategori);
            header('Location: index.php?action=data');
            exit;
        }

        $ErrorMessage = null;
        if (isset($_SESSION['Message_Invalid'])) {
            $ErrorMessage = $_SESSION['Message_Invalid'];
            unset($_SESSION['Message_Invalid']);
        } 

        $user = $this->SuperAdmin->GetUserData($username);
        require '../app/views/form/superadmin/editakun.php';     
    }

}
?>