<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/styles_input.css" />
    <link rel="stylesheet" href="assets/styles.css" />
    <?php
    $view = isset($_GET['view']) ? $_GET['view'] : '';
    ?>
</head>
<body>

    <?php require_once '../app/views/home/header.html'; ?>

    <?php if ($view === 'edit_mesin'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=mesin" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-tags"></i> Edit Kategori</h2>
            <form method="POST" action="index.php?view=edit_mesin&id=<?= $_GET['id']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="nama_mesin">Nama Mesin</label>
                    <input type="text" name="nama_mesin" value="<?= $detailMesin['nama_mesin']; ?>" />
                </div>
                <div class="form-group">
                    <label for="kapasitas_per_jam">Kapasitas Per Jam</label>
                    <input type="number" name="kapasitas_per_jam" value="<?= $detailMesin['kapasitas_per_jam']; ?>" />
                </div>
                <div class="form-group">
                    <label for="tahun_pembuatan">Tahun Pembuatan</label>
                    <input type="number" name="tahun_pembuatan" value="<?= $detailMesin['tahun_pembuatan']; ?>" />
                </div>
                <button type="submit">Edit</button>
            </form>

        </div>
    </div>

    <?php elseif ($view === 'edit_bahan_baku'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=bahan_baku" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-box"></i> Edit Bahan Baku</h2>
            <form method="POST" action="index.php?view=edit_bahan_baku&id=<?= $_GET['id']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="nama_bahan">Nama Bahan</label>
                    <input type="text" name="nama_bahan" value="<?= $detailBahanBaku['nama_bahan']; ?>" />
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" name="jenis" value="<?= $detailBahanBaku['jenis']; ?>" />
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" name="stok" value="<?= $detailBahanBaku['stok']; ?>" />
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'edit_operator'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=operator" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-user"></i> Edit Operator</h2>
            <form method="POST" action="index.php?view=edit_operator&id=<?= $_GET['id']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="<?= $detailOperator['nama']; ?>" />
                </div>
                <div class="form-group">
                    <label for="nomor">Nomor</label>    
                    <input type="text" id="nomor" name="nomor" value=<?= $detailOperator['nomor']; ?> required />  
                </div>
                <div class="form-group">
                    <label for="shift">Shift</label>
                    <select name="shift" id="shift">
                        <option value="">Pilih Shift</option>
                        <option value="Pagi" <?= $detailOperator['shift'] === 'pagi' ? 'selected' : '' ?>>pagi</option>
                        <option value="Siang" <?= $detailOperator['shift'] === 'siang' ? 'selected' : '' ?>>siang</option>
                        <option value="Malam" <?= $detailOperator['shift'] === 'malam' ? 'selected' : '' ?>>malam</option>
                    </select>
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'edit_produksi'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=produksi" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-industry"></i> Edit Produksi</h2>
            <form method="POST" action="index.php?view=edit_produksi&id=<?= $_GET['id']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" value="<?= $detailProduksi['tanggal']; ?>" />
                </div>
                <div class="form-group">
                    <label for="jumlah_lembar">Jumlah Lembar</label>
                    <input type="number" name="jumlah_lembar" value="<?= $detailProduksi['jumlah_lembar']; ?>" />
                </div>
                <div class="form-group">
                    <label for="mesin_id">Mesin ID</label>
                    <input type="number" name="mesin_id" value="<?= $detailProduksi['mesin_id']; ?>" />
                </div>
                <div class="form-group">
                    <label for="bahan_id">Bahan ID</label>
                    <input type="number" name="bahan_id" value="<?= $detailProduksi['bahan_id']; ?>" />
                </div>
                <div class="form-group">
                    <label for="operator_id">Operator ID</label>
                    <input type="number" name="operator_id" value="<?= $detailProduksi['operator_id']; ?>" />
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'edit_quality_check'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=quality_check" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-check-circle"></i> Edit Quality Check</h2>
            <form method="POST" action="index.php?view=edit_quality_check&id=<?= $_GET['id']; ?>">
                <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                <div class="form-group">
                    <label for="produksi_id">Produksi ID</label>
                    <input type="number" name="produksi_id" value="<?= $detailQualityCheck['produksi_id']; ?>" />
                </div>
                <div class="form-group">
                    <label for="tingkat_cacat">Tingkat Cacat</label>
                    <input type="number" name="tingkat_cacat" value="<?= $detailQualityCheck['tingkat_cacat']; ?>" />
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" value="<?= $detailQualityCheck['jumlah']; ?>" />
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="lulus" <?= $detailQualityCheck['status'] === 'lulus' ? 'selected' : '' ?>>lulus</option>
                        <option value="ulang" <?= $detailQualityCheck['status'] === 'ulang' ? 'selected' : '' ?>>ulang</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="catatan">Catatan</label>
                    <input type="text" name="catatan" value="<?= $detailQualityCheck['catatan']; ?>" />
                </div>
                <button type="submit">Edit</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>