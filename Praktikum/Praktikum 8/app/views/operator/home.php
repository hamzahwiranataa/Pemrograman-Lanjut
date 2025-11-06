<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <br><br><br><br><br><br>
  <center>
    <table border="1" cellpadding="20" cellspacing="0">
      <tr>
        <td>
          <center>
            <h2>Home Dashboard</h2>
              <table cellpadding="10">
                <tr>
                  <td>Username:</td>
                  <td><?= $row['username']; ?></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td><?php 
                    if($row['kategori'] == 0) { 
                        echo "Super Admin"; 
                        } elseif($row['kategori'] == 1) {
                            echo "Operator"; 
                        } elseif($row['kategori'] == 2) {
                            echo "Pegawai"; 
                        } ?>
                </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <a href="index.php?action=logout">Logout</a>
                    </td>
                </tr>
              </table>
          </center>
        </td>
      </tr>
    </table>
  </center>
</body>
</html>