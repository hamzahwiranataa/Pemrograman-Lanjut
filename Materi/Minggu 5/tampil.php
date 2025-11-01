<?php
include 'sql/koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Data Mahasiswa</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
            <?php
            $query = "SELECT * FROM mahasiswa";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['jurusan'] . "</td>";
                echo "<td>
                    <form method='POST' action='sql/hapus.php' style='display:inline-block; margin:0;'>
                        <input type='hidden' name='hapus_id' value='" . $row['id'] . "'>
                        <button type='submit' name='hapus' class='btn btn-hapus'\">Hapus</button>
                    </form>
                </td>";
                echo "</tr>";
            }
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data.</td></tr>";
            }
            ?>
        </table>

        <?php
        echo "
        <form method='POST' id='addForm' action='sql/tambah.php' style='margin:0;'>
            <div class='form-row single'>
                <input type='text' id='nama' name='nama' placeholder='Nama' required>
            </div>
            <div class='form-row'>
                <input type='text' id='email' name='email' placeholder='Email' required>
                <input type='text' id='jurusan' name='jurusan' placeholder='Jurusan' required>
            </div>
            <div class='form-row'>
                <button type='submit' name='tambah' class='btn btn-tambah'>Tambah</button>
            </div>
        </form>
        ";
        ?>
    </div>
</body>
</html>