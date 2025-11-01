<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/gudang/styles.css">
</head>
<body>  
    <?php require_once 'header.html'; ?>
        <!-- Tabel Kategori -->
    <div class="container">
        <div id="kategori" class="page <?= ($_GET['view'] ?? '')=='kategori' ? 'active' : '' ?>">
            <h2><i class="fas fa-tags"></i> Kategori Barang</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                            <?php if (!empty($data)) : ?>
                                <?php foreach ($data as $row) : ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['nama_kategori']; ?></td>
                                        <td><?= $row['deskripsi']; ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" onclick="window.location.href='index.php?view=edit_kategori&id=<?= $row['id']; ?>'"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="window.location.href='index.php?view=hapus_kategori&id=<?= $row['id']; ?>'"><i class="fas fa-trash"></i></button>
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
                <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <a class="btn btn-primary" onclick="window.location.href='index.php?view=tambah_kategori'"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
    </div>
    <?php require_once 'footer.html'; ?>
</body>
</html>