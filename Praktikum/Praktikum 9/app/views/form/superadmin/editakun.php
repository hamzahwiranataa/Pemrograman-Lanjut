<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Login</title>
</head>
<body>
<a href="index.php?action=data">Kembali</a>
  <br><br><br><br><br><br>
  <center>
    <table border="1" cellpadding="20" cellspacing="0">
      <tr>
        <td>
          <center>
            <h2>Edit Akun</h2>
            <form method="POST" action="index.php?action=edit">
            <input type="hidden" name="usernameawal" value="<?= $user['username'] ?>">
              <table cellpadding="10">
                <tr>
                  <td>Username:</td>
                  <td><input type="text" name="username" value="<?= $user['username']; ?>" size="30" required></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="text" name="password" value="<?= $user['password']; ?>" size=    "30" required></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>
                        <select name="kategori">
                            <option value="0" <?= ($user['kategori'] == "0") ? 'selected' : '' ?>>Super Admin</option>
                            <option value="1" <?= ($user['kategori'] == "1") ? 'selected' : '' ?>>Operator</option>
                            <option value="2" <?= ($user['kategori'] == "2") ? 'selected' : '' ?>>Pegawai</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="color:red;">
                        <?php if (!empty($ErrorMessage)) : ?>
                            <?= htmlspecialchars($ErrorMessage['message']); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
                    <input type="submit" value="Edit">
                  </td>
                </tr>
              </table>
            </form>
          </center>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>