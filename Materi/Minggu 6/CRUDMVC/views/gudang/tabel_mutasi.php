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
        <div id="kategori" class="page <?= ($_GET['view'] ?? '')=='mutasi' ? 'active' : '' ?>">
            <h2><i class="fas fa-exchange-alt"></i> Mutasi</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barang ID</th>
                            <th>Tanggal</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)) : ?>
                            <?php foreach ($data as $row) : ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['barang_id']; ?></td>
                                    <td><?= $row['tanggal']; ?></td>
                                    <td><?= $row['tipe']; ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td><?= $row['keterangan']; ?></td>
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
                <a class="btn btn-primary" onclick="window.location.href='index.php?view=tambah_mutasi'"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
    </div>
    <?php require_once 'footer.html'; ?>
</body>
</html>