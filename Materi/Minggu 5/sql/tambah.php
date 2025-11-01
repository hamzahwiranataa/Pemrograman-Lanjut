<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $query = "INSERT INTO mahasiswa (nama, email, jurusan) VALUES ('$nama', '$email', '$jurusan')";
    mysqli_query($koneksi, $query);
    header("Location: ../tampil.php");
    exit;
}
?>