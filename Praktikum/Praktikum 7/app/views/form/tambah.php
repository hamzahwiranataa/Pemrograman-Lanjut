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

    <?php if ($view === 'tambah_mesin'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=mesin" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-gear"></i> Tambah Mesin</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="background: #ffdddd; color: #a33; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $field => $msgs): ?>
                            <?php foreach ($msgs as $msg): ?>
                                <li><?= htmlspecialchars($msg) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="index.php?view=tambah_mesin">
                <div class="form-group">
                    <label for="nama_mesin">Nama Mesin</label>
                    <input type="text" id="nama_mesin" name="nama_mesin" minlength="13" placeholder="Nama Mesin" required />
                </div>
                <div class="form-group">
                    <label for="kapasitas_per_jam">Kapasitas Per Jam</label>
                    <input type="number" id="kapasitas_per_jam" name="kapasitas_per_jam" placeholder="Kapasitas Per Jam" required />
                </div>
                <div class="form-group">
                    <label for="tahun_pembuatan">Tahun Pembuatan</label>
                    <input type="number" id="tahun_pembuatan" name="tahun_pembuatan" placeholder="Tahun Pembuatan" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'tambah_bahan_baku'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=bahan_baku" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fa-solid fa-boxes-stacked"></i> Tambah Bahan Baku</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="background: #ffdddd; color: #a33; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $field => $msgs): ?>
                            <?php foreach ($msgs as $msg): ?>
                                <li><?= htmlspecialchars($msg) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="index.php?view=tambah_bahan_baku">
                <div class="form-group">
                    <label for="nama_bahan">Nama Bahan</label>
                    <input type="text" id="nama_bahan" name="nama_bahan" placeholder="Nama Bahan" required />
                </div>
                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <input type="text" id="jenis" name="jenis" placeholder="Jenis" required /> 
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>                
                    <input type="number" id="stok" name="stok" placeholder="Stok" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>

    </div>
    <?php elseif ($view === 'tambah_operator'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=operator" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">    
            <h2><i class="fa-solid fa-users"></i> Tambah Operator</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="background: #ffdddd; color: #a33; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $field => $msgs): ?>
                            <?php foreach ($msgs as $msg): ?>
                                <li><?= htmlspecialchars($msg) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="index.php?view=tambah_operator">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="nama" required />
                </div>
                <div class="form-group">
                    <label for="nomor">Nomor</label>
                    <input type="text" id="nomor" name="nomor" placeholder="Nomor" required />  
                </div>
                <div class="form-group">
                    <label for="nomor">Nomor Confirm</label>
                    <input type="text" id="nomor" name="nomor" placeholder="Nomor" required />  
                </div>
                <div class="form-group">
                    <label for="shift">Shift</label>
                    <select name="shift" id="shift">
                        <option value="" disabled selected>Pilih Shift</option>
                        <option value="Pagi">Pagi</option>
                        <option value="Siang">Siang</option>
                        <option value="Malam">Malam</option>
                    </select>
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'tambah_produksi'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=produksi" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fa-solid fa-cogs"></i> Tambah Produksi</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="background: #ffdddd; color: #a33; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $field => $msgs): ?>
                            <?php foreach ($msgs as $msg): ?>
                                <li><?= htmlspecialchars($msg) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="index.php?view=tambah_produksi">
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"  required />
                </div>
                <div class="form-group">
                    <label for="jumlah_lembar">Jumlah Lembar</label>
                    <input type="number" min="4" id="jumlah_lembar" name="jumlah_lembar" required />
                </div>
                <div class="form-group">
                    <label for="mesin_id">Mesin ID</label>
                    <input type="number" id="mesin_id" name="mesin_id" placeholder="Mesin ID" required />
                </div>
                <div class="form-group">
                    <label for="bahan_id">Bahan ID</label>
                    <input type="number" id="bahan_id" name="bahan_id" placeholder="Bahan ID" required />
                </div>
                <div class="form-group">
                    <label for="operator_id">Operator ID</label>
                    <input type="text" id="operator_id" name="operator_id" placeholder="Operator ID" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'tambah_quality_check'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=quality_check" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fa-solid fa-circle-check"></i> Tambah Quality Check</h2>
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger" style="background: #ffdddd; color: #a33; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $field => $msgs): ?>
                            <?php foreach ($msgs as $msg): ?>
                                <li><?= htmlspecialchars($msg) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="POST" action="index.php?view=tambah_quality_check">
                <div class="form-group">
                    <label for="produksi_id">Produksi ID</label>
                    <input type="number" id="produksi_id" name="produksi_id" placeholder="Produksi ID" required />
                </div>

                <div class="form-group">
                    <label for="tingkat_cacat">Tingkat Cacat</label>
                    <input type="number" id="tingkat_cacat" name="tingkat_cacat" placeholder="Tingkat Cacat" required />
                </div>

                <div class="form-group">
                    <label for="Jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" placeholder="Jumlah" required />
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Ulang">Ulang</option>
                    </select>
                </div>

                <div class ="form-group">
                    <label for="catatan">Catatan</label>
                    <input type="text" id="catatan" name="catatan" placeholder="Catatan" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
    