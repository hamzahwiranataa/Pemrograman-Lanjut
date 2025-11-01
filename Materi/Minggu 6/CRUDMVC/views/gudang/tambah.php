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

    <?php if ($view === 'tambah_kategori'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=kategori" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-tags"></i> Tambah Kategori</h2>
            <form method="POST" action="index.php?view=tambah_kategori">
                <div class="form-group">
                    <label for="nama_kategori">Nama Kategori</label>
                    <input type="text" id="nama" name="nama" placeholder="Nama Kategori" required />
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'tambah_barang'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=barang" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-box"></i>  Tambah Barang</h2>
            <form method="POST" action="index.php?view=tambah_barang">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" placeholder="Nama Barang" required />
                </div>
                <div class="form-group">
                    <label for="deskripsi_barang">Kategori</label>
                    <input type="number" id="kategori_id" name="kategori_id" placeholder="Kategori ID" required /> 
                </div>
                <div class="form-group">
                    <label for="deskripsi_barang">Lokasi</label>                
                    <input type="number" id="lokasi_id" name="lokasi_id" placeholder="Lokasi ID" required />
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select name="satuan" id="satuan">
                        <option value="" disabled selected>Pilih Satuan</option>
                        <option value="pcs">Pcs</option>
                        <option value="kg">Kg</option>
                        <option value="liter">Liter</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" placeholder="Stok" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>

    </div>
    <?php elseif ($view === 'tambah_petugas'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=petugas" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">    
            <h2><i class="fas fa-user-tie"></i> Tambah Petugas</h2>
            <form method="POST" action="index.php?view=tambah_petugas">
                <div class="form-group">
                    <label for="nama_petugas">Nama Petugas</label>
                    <input type="text" id="nama_petugas" name="nama_petugas" placeholder="Nama Petugas" required />
                </div>
                <div class="form-group">
                    <label for="tugas">Tugas</label>
                    <input type="text" id="tugas" name="tugas" placeholder="Tugas" required />
                </div>
                <div class="form-group">
                    <label for="no_telpon">Nomor Telpon</label>
                    <input type="text" id="no_telpon" name="no_telpon" placeholder="Nomor Telpon" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'tambah_mutasi'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=mutasi" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-exchange-alt"></i> Tambah Mutasi</h2>
            <form method="POST" action="index.php?view=tambah_mutasi">
                <div class="form-group">
                    <label for="barang_id">Barang ID</label>
                    <input type="number" id="barang_id" name="barang_id" placeholder="Barang ID" required />
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" required />
                </div>
                <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select name="tipe" id="tipe">
                        <option value="" disabled selected>Pilih Tipe</option>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" id="jumlah" name="jumlah" placeholder="Jumlah" required />
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" id="keterangan" name="keterangan" placeholder="Keterangan" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    <?php elseif ($view === 'tambah_lokasi'): ?>
    <div class="page-wrapper active">
        <a href="index.php?view=lokasi" class="btn btn-secondary" style="position: absolute; top: 115px; left: 10px; z-index: 1000;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="form-container">
            <h2><i class="fas fa-map-marker-alt"></i> Tambah Lokasi</h2>
            <form method="POST" action="index.php?view=tambah_lokasi">
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi" required />
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required />
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
    