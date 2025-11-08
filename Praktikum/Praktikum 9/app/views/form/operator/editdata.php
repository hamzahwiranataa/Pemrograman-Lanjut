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
            <h2>Edit Data</h2>
            <form method="POST" action="index.php?action=edit">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
              <table cellpadding="10">
                <tr>
                  <td>Tanggal:</td>
                  <td><input type="date" name="tanggal" size="30" value="<?= $data['tanggal'] ?>" required></td>
                </tr>
                <tr>
                  <td>Varian:</td>
                  <td>
                    <select name="varian">
                        <option value="10" <?= ($data['varian'] == "10") ? 'selected' : '' ?>>10</option>
                        <option value="20" <?= ($data['varian'] == "20") ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= ($data['varian'] == "50") ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= ($data['varian'] == "100") ? 'selected' : '' ?>>100</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Lembar:</td>
                  <td><input type="text" name="jumlah_lembar" size="30" value="<?= $data['jumlah_lembar'] ?>" required></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
                    <input type="submit" value="Tambah">
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