<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
     <form method="POST" action="index.php?action=update_user">  <!-- post action nya di perhatikan -->
        <!-- biar id nya kesimpan soalnya pas update ke database kan butuh id sumber -->
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $user['nama'] ?>" required><br><br>

        <label>Tipe:</label><br>
        <select name="tipe" required>
            <option value="1" <?= $user['tipe'] == 1 ? 'selected' : '' ?>>Admin</option>
            <option value="2" <?= $user['tipe'] == 2 ? 'selected' : '' ?>>User</option>
        </select><br><br>
        
        <button type="submit">Update</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
