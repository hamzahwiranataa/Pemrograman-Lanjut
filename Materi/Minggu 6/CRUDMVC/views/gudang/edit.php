<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../views/gudang/styles.css" />
    <link rel="stylesheet" href="../views/gudang/styles_input.css" />
    <?php
    $view = isset($_GET['view']) ? $_GET['view'] : '';
    ?>
</head>
<body>

    <?php require_once 'header.html'; ?>

    <?php if ($view === 'edit_kategori'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=kategori" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-tags"></i> Edit Kategori</h2>
            <form method="POST" action="index.php?view=edit_kategori&id=<?= $_GET['id']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" name="nama" value="<?= $detailKategori['nama_kategori']; ?>" />
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" value="<?= $detailKategori['deskripsi']; ?>" />
                </div>
                <button type="submit">Edit</button>
            </form>

        </div>
    </div>

    <?php elseif ($view === 'edit_barang'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=barang" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-box"></i>  Edit Barang</h2>
            <form method="POST" action="index.php?view=edit_barang&id=<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" value="<?= $detailBarang['nama_barang']; ?>" />
        
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <input type="number" name="kategori_id" value="<?= $detailBarang['kategori_id']; ?>" />
                </div>

                <div class="form-group">
                    <label for="deskripsi_barang">Lokasi</label>                
                    <input type="number" name="lokasi_id" value="<?= $detailBarang['lokasi_id']; ?>" />
                </div>

                <?php
                // Jika ini halaman edit, ambil nilai satuan dari data barang
                $satuan = isset($detailBarang['satuan']) ? $detailBarang['satuan'] : '';
                ?>

                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan">
                        <option value="" disabled <?= !$satuan ? 'selected' : '' ?>>Pilih Satuan</option>
                        <option value="pcs" <?= ($satuan == 'pcs') ? 'selected' : '' ?>>Pcs</option>
                        <option value="sak" <?= ($satuan == 'sak') ? 'selected' : '' ?>>Sak</option>
                        <option value="botol" <?= ($satuan == 'botol') ? 'selected' : '' ?>>Botol</option>
                        <option value="pasang" <?= ($satuan == 'pasang') ? 'selected' : '' ?>>Pasang</option>
                        <option value="unit" <?= ($satuan == 'unit') ? 'selected' : '' ?>>Unit</option>
                        <option value="roll" <?= ($satuan == 'roll') ? 'selected' : '' ?>>Roll</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" value="<?= $detailBarang['stok'] ?>" required />
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>

    </div>
    <?php elseif ($view === 'edit_petugas'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=petugas" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">    
            <h2><i class="fas fa-user-tie"></i> Edit Petugas</h2>
            <form method="POST" action="index.php?view=edit_petugas&id=<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="nama_petugas">Nama Petugas</label>
                    <input type="text" id="nama_petugas" name="nama_petugas" value="<?= $detailPetugas['nama_petugas'] ?>" required />
                </div>
                <div class="form-group">
                    <label for="tugas">Tugas</label>
                    <input type="text" id="tugas" name="tugas" value="<?= $detailPetugas['tugas'] ?>" required />
                </div>
                <div class="form-group">
                    <label for="nomor_telpon">Nomor Telpon</label>
                    <input type="text" id="nomor_telpon" name="nomor_telpon" value="<?= $detailPetugas['no_telpon'] ?>" required />
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'edit_lokasi'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=lokasi" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-map-marker-alt"></i> Edit Lokasi</h2>
            <form method="POST" action="index.php?view=edit_lokasi&id=<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" value="<?= $detailLokasi['lokasi'] ?>" required />
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi" value="<?= $detailLokasi['deskripsi'] ?>" required />
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
    