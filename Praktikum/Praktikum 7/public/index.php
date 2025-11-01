<?php
require_once '../app/controllers/produksi_uang.php';

$app = new Produksi_Uang();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

if (method_exists($app, $action)) {
    $app->$action($id);
} else {
    echo "Halaman Tidak Ditemukan!";
}
?>