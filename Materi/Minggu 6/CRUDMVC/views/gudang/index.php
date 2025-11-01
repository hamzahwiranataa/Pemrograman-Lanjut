<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Viewer - Manajemen Gudang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../views/gudang/styles.css">
    <?php
    $view = isset($_GET['view']) ? $_GET['view'] : '';
    ?>
</head>
<body>
    <?php require_once 'header.html'; ?> 
    <div class="container">
       <div id="main-page" class="page <?= isset($_GET['view']) ? '' : 'active' ?>">
            <div class="cards-container">
                <div class="cards-row-top">
                    <div class="card" onclick="window.location.href='index.php?view=kategori'"> 
                        <i class="fas fa-tags"></i>
                        <h3>Kategori</h3>
                        <p>Kelola dan lihat daftar kategori barang.</p>
                    </div>
                    <div class="card" onclick="window.location.href='index.php?view=barang'">
                        <i class="fas fa-box"></i>
                        <h3>Barang</h3>
                        <p>Daftar lengkap barang beserta stok, kategori, dan satuan pengukuran.</p>
                    </div>
                    <div class="card" onclick="window.location.href='index.php?view=petugas'">
                        <i class="fas fa-user-tie"></i>
                        <h3>Petugas</h3>
                        <p>Informasi petugas termasuk nama, tugas, dan kontak telepon.</p>
                    </div>

                </div>
                <div class="cards-row-bottom">
                    <div class="card" onclick="window.location.href='index.php?view=mutasi'">
                        <i class="fas fa-exchange-alt"></i>
                        <h3>Mutasi</h3>
                        <p>Catatan perubahan stok barang, termasuk tipe dan keterangan.</p>
                    </div>
                    <div class="card" onclick="window.location.href='index.php?view=lokasi'">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Lokasi</h3>
                        <p>Daftar lokasi gudang dan deskripsi masing-masing fasilitas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'footer.html'; ?>
</body>
</html>