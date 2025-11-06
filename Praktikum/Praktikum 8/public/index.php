<?php
session_start();
require_once '../app/controllers/LoginController.php';
require_once '../app/controllers/SuperAdminController.php';
require_once '../app/controllers/OperatorController.php';
require_once '../app/controllers/PegawaiController.php';

$LoginController = new LoginController();
$SuperAdminController = new SuperAdminController();
$OperatorController = new OperatorController();
$PegawaiController = new PegawaiController();

$action = $_GET['action'] ?? 'index';
$page = $_GET['page'] ?? 'index';

if ($action === 'login') {
    $LoginController->CheckLogin();
    exit;
}

if (isset($_SESSION['username']) && isset($_SESSION['role'])) {

    switch ($_SESSION['role']) {
        case 'superadmin':
            $SuperAdminController->index();
            break;
        case 'operator':
            $OperatorController->index();
            break;
        case 'pegawai':
            $PegawaiController->index();
            break;
        default:
            echo "Role tidak dikenal.";
            break;
    }

} else {
    $LoginController->index();
}
