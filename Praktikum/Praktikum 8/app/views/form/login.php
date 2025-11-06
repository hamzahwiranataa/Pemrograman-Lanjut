<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Login</title>
</head>
<body>

  <br><br><br><br><br><br>
  <center>
    <table border="1" cellpadding="20" cellspacing="0">
      <tr>
        <td>
          <center>
            <h2>Sistem Login</h2>
            <form method="POST" action="index.php?action=login">
              <table cellpadding="10">
                <tr>
                  <td>Username:</td>
                  <td><input type="text" name="username" size="30" required></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="password" name="password" size="30" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="color:red;">
                        <?php if (!empty($flash)) : ?>
                            <?= htmlspecialchars($flash['message']); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
                    <input type="submit" value="Login">
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
