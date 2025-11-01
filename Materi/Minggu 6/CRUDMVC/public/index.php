<?php
require_once '../controllers/gudang.php';

$app = new Gudang();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

if (method_exists($app, $action)) {
    $app->$action($id);
} else {
    echo "Halaman Tidak Ditemukan!";
}
?>