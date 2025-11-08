<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Kembali</a>
    <br><br><br><br>
    <center>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Nomor</td>
                <td>Tanggal</td>
                <td>Varian</td>
                <td>Jumlah Lembar</td>
                <td>Status</td>
                <td>Perundingan</td>
                <td>Aksi</td>
            </tr>
            <?php if (!empty($datas)): ?>
                <?php $no = 1; ?>
                <?php foreach ($datas as $data): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><?= $data['varian'] ?></td>
                        <td><?= $data['jumlah_lembar'] ?></td>
                        <td><?php if ($data['status'] == 0): ?>
                                <a>Menunggu Persetujuan</a>
                            <?php elseif ($data['status'] == 1): ?>
                                <a>Disetujui</a>
                            <?php elseif ($data['status'] == 2): ?>
                                <a>Ditolak</a>
                            <?php endif; ?>
                        </td>
                        <td><?php if ($data['status'] == 0): ?>
                                <a href="index.php?action=setuju&id=<?= $data['id'] ?>">Setuju</a> |
                                <a href="index.php?action=tolak&id=<?= $data['id'] ?>">Tolak</a>
                            <?php elseif ($data['status'] == 1): ?>
                                <a href="index.php?action=tolak&id=<?= $data['id'] ?>">Tolak</a>
                            <?php elseif ($data['status'] == 2): ?>
                                <a href="index.php?action=setuju&id=<?= $data['id'] ?>">Setuju</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?action=edit&id=<?= $data['id'] ?>">Edit</a> |
                            <a href="index.php?action=hapus&id=<?= $data['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">Belum ada data.</td></tr>
            <?php endif; ?>
        </table>
        <br><br>
        <a href="index.php?action=tambah">Tambah Data</a>
    </center>
</body>
</html>