<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
</head>
<body>
    <h2>Tambah User</h2>
    <form method="POST" action="index.php?action=add_user"> <!-- post action nya di perhatikan -->
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>
        
        <label>Tipe:</label><br>
        <select name="tipe" required>
            <option value="1">Admin</option>
            <option value="2">User</option>
        </select><br><br>

        <button type="submit">Simpan</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
