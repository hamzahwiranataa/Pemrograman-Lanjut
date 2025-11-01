<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/gudang/styles.css">
</head>
<body> 
    <?php require_once 'header.html'; ?>
    <div class="container">
        <div id="barang" class="page <?= ($_GET['view'] ?? '')=='barang' ? 'active' : '' ?>">
            <h2><i class="fas fa-box"></i> Barang</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Kategori ID</th>
                            <th>Lokasi ID</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td><?= $row['kategori_id']; ?></td>
                                    <td><?= $row['lokasi_id']; ?></td>
                                    <td><?= $row['satuan']; ?></td>
                                    <td><?= $row['stok']; ?></td>   
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=edit_barang&id=<?= $row['id']; ?>'"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" onclick="window.location.href='index.php?view=hapus_barang&id=<?= $row['id']; ?>'"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Belum ada data</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="actions">
                <a href="index.php" class="btn btn-secondary" ></i> Kembali</a>
                <a class="btn btn-primary" onclick="window.location.href='index.php?view=tambah_barang'"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
    </div>
    <?php require_once 'footer.html'; ?>
</body>
</html>