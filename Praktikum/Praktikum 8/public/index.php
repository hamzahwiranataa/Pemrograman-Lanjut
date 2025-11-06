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

$action = $_GET['action'] ?? 'default';
$page = $_GET['page'] ?? 'index';

switch ($action) {
    case 'login':
        $LoginController->CheckLogin();
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php');
        break;

    default:
        if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'superadmin') {
                $SuperAdminController->index();
                exit;
            }
            elseif ($_SESSION['role'] == 'operator') {
                $OperatorController->index();
                exit;
            }
            elseif ($_SESSION['role'] == 'pegawai') {
                $PegawaiController->index();
                exit;
            }
        }
        $LoginController->index();
        exit;
}