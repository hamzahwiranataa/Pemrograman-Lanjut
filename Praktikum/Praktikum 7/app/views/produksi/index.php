<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produksi Uang Kertas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/styles.css">

</head>
<body>
    <?php require_once 'header.html'; ?> 
    <div class="container">
       <div id="main-page" class="page <?= isset($_GET['view']) ? '' : 'active' ?>">
            <div class="cards-container">
                <div class="cards-row-top">
                    <div class="card" onclick="window.location.href='index.php?view=mesin'"> 
                        <i class="fas fa-gear"></i>
                        <h3>Mesin</h3>
                        <p>Kelola dan lihat daftar Mesin.</p>
                    </div>
                    <div class="card" onclick="window.location.href='index.php?view=bahan_baku'">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <h3>Bahan Baku</h3>
                        <p>Daftar lengkap barang beserta stok, kategori, dan satuan pengukuran.</p>
                    </div>
                    <div class="card" onclick="window.location.href='index.php?view=operator'">
                        <i class="fa-solid fa-users"></i>
                        <h3>Operator</h3>
                        <p>Informasi petugas termasuk nama, tugas, dan kontak telepon.</p>
                    </div>

                </div>
                <div class="cards-row-bottom">
                    <div class="card" onclick="window.location.href='index.php?view=produksi'">
                        <i class="fa-solid fa-cogs"></i>
                        <h3>Produksi</h3>
                        <p>Catatan perubahan stok barang, termasuk tipe dan keterangan.</p>
                    </div>
                    <div class="card" onclick="window.location.href='index.php?view=quality_check'">
                        <i class="fa-solid fa-circle-check"></i>
                        <h3>Quality Check</h3>
                        <p>Daftar Quality Check dari hasil produksi uang kertas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'footer.html'; ?>
</body>
</html>