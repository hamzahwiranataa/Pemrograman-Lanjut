<?php
session_start();
$_SESSION['role'] = $_SESSION['role'] ?? null;
require_once '../app/controllers/LoginController.php';
require_once '../app/controllers/SuperAdminController.php';
require_once '../app/controllers/OperatorController.php';
require_once '../app/controllers/PegawaiController.php';

$LoginController = new LoginController();
$SuperAdminController = new SuperAdminController();
$OperatorController = new OperatorController();
$PegawaiController = new PegawaiController();

$action = $_GET['action'] ?? 'default';
$page = $_GET['page'] ?? 'index';


if ($_SESSION['role'] == null){
    switch ($action) {
        case 'login':
            $LoginController->CheckLogin();
            break;

        default:
            $LoginController->index();
            exit;
    }
}

else {
    if ($_SESSION['role'] == 'superadmin') {
        switch($action) {
            case 'logout':
                session_destroy(); 
                $LoginController->index();
                header('Location: index.php');
                break;
            case 'data':
                $SuperAdminController->data_pengguna();
                break;

            case 'tambah':
                $SuperAdminController->tambah();
                break;

            case 'edit':
                $SuperAdminController->edit($_GET['username']);
                break;  

            case 'hapus':
                $SuperAdminController->hapus($_GET['username']);
                break;

            default:
                $SuperAdminController->index();
        }
    }

    elseif ($_SESSION['role'] == 'pegawai') {
        switch($action) {
            case 'logout':
                session_destroy();
                $LoginController->index();
                header('Location: index.php');
                break;

            case 'data':
                $PegawaiController->data_produksi();
                break;

            case 'tambah':
                $PegawaiController->tambah_produksi();
                break;

            case 'edit':
                $PegawaiController->edit_produksi($_GET['id']);
                break;

            default:
                $PegawaiController->index();
        }
    }

    elseif ($_SESSION['role'] == "operator") {
        switch($action) {
            case 'logout':
                session_destroy();
                $LoginController->index();
                header('Location: index.php');
                break;

            case 'data':
                $OperatorController->data_produksi();
                break;

            case 'tambah':
                $OperatorController->tambah_produksi();
                break;

            case 'edit':
                $OperatorController->edit_produksi($_GET['id']);
                break;

            case 'setuju':
                $OperatorController->setuju($_GET['id']);
                break;

            case 'tolak':
                $OperatorController->tolak($_GET['id']);
                break;

            case 'hapus':
                $OperatorController->hapus_produksi($_GET['id']);
                break;

            default:
                $OperatorController->index();
        }
    }
}
