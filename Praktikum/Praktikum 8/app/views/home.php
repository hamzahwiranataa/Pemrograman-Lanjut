<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <br>
    <br>
    <table border="1" cellpadding="10" cellspacing="5">
        <tr>
            <th>ID</th>
            <th>NO</th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Aksi</th>
        </tr>
        <?php if (!empty($users)): ?>
            <?php $no = 1; ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($user['nama']) ?></td>
                    <td>
                        <?php if ($user['tipe'] == 1): ?>
                            <a>Admin</a>
                        <?php elseif ($user['tipe'] == 2): ?>
                            <a>User</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?action=edit_form&id=<?= $user['id'] ?>">Edit</a> | 
                        <a href="index.php?action=delete&id=<?= $user['id'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Belum ada data.</td></tr>
        <?php endif; ?>
    </table>
    <br>
    <br>
    <a href="index.php?action=add_form">Tambah User</a>
</body>
</html>
