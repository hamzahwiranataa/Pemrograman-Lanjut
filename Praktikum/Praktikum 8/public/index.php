<?php
require_once __DIR__ . '/../app/controllers/HomeController.php';

$controller = new HomeController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'add_form':
        $controller->formAdd();
        break;

    case 'edit_form':
        $controller->formEdit($_GET['id']);
        break;

    case 'add_user':
        $controller->addUser($_POST['nama'], $_POST['tipe']);
        break;

    case 'update_user':
        $controller->updateUser($_POST['id'], $_POST['nama'], $_POST['tipe']);
        break;

    case 'delete':
        $controller->deleteUser($_GET['id']);
        break;

    default:
        $controller->index();
        break;
}
