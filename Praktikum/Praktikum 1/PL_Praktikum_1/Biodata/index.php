<?php
$nama = "Hamzah Wiranata";
$nim = "10241035";
$jurusan = "Fakultas Sains dan Teknologi Informasi";
$prodi = "Sistem Informasi";
$tahun_lahir = 2006;
$umur = 2025 - $tahun_lahir;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="magic_touch.css"></link>
    <title>Tugas Pemrograman Lanjut - Minggu 2</title>
</head>
<body>
    <div class="kotak" role="main" aria-label="Biodata Hamzah Wiranata">
        <h2><span text-aligh class="kuning_emas"><?= htmlspecialchars($nama) ?></span><br></br></h2>
        <p><span class="kuning_emas">NIM</span> <?= htmlspecialchars($nim) ?></p>
        <p><span class="kuning_emas">Jurusan</span> <?= htmlspecialchars($jurusan) ?></p>
        <p><span class="kuning_emas">Prodi</span> <?= htmlspecialchars($prodi) ?></p>
        <p><span class="kuning_emas">Umur</span> <?= htmlspecialchars($umur) ?> tahun (<?= htmlspecialchars($tahun_lahir) ?>)</p>
    </div>
</body>
</html>
