<?php
include 'koneksi.php';

if (isset($_POST['hapus'])) {
    $id = $_POST['hapus_id'];
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");
    header("Location: ../tampil.php");    
    exit();
}
