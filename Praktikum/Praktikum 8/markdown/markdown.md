## Identitas Mahasiswa

- Nama: Hamzah Wiranata
- NIM: 10241035
- Kelas: PL-A
- Program Studi: Sistem Informasi
- Minggu ke-: 8
- Tanggal Praktikum: 2/11/2025
---
- Github : https://github.com/hamzahwiranataa/Pemrograman-Lanjut
---

## Login 3 Role

Di bagian login ini pengguna hanya di minta Username dan password saja lalu login
![alt text](image.png)

- Username atau Password tidak Terdaftar\
jika username atau password tidak terdaftar di database maka akan menampilkan tulisan di bawah field password 'Username atau password salah'
![alt text](image-1.png)


- Username atau password terdaftar\
jika username dan password telah terdaftar di database maka tampilan akan di alihkan ke masing masing dahsboard role

    - Super Admin
![alt text](image-2.png)
    - Operator
![alt text](image-3.png)
    - Pegawai
![alt text](image-4.png)

## Cara kerja sistem ini
### Login
cara kerja sistem login ini adalah mengirim input pengguna ke `LoginController.php` lalu di lakukan pengecekan di `LoginModel.php`
- Bagian Controller
```php
    public function CheckLogin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->LoginModel->CheckUser($username, $password);

        if ($user) {
            $row = $this->LoginModel->CheckKategoriUser($username);
            $Role = $row['kategori'];

            $_SESSION['username'] = $username;

            if ($Role == 0) {
                $_SESSION['role'] = 'superadmin';
                
                header('Location: index.php');
                exit;
            } elseif ($Role == 1) {
                $_SESSION['role'] = 'operator';
                header('Location: index.php');
                exit;
            } elseif ($Role == 2) {
                $_SESSION['role'] = 'pegawai';
                header('Location: index.php ');
                exit;
            }
        } else {
            $_SESSION['Message_Invalid'] = [
                'message' => 'Username atau password salah!',
                'type' => 'error'
            ];
            header('Location: index.php');
            exit;
        }
    }
```
Lebih tepatnya pada `$user = $this->LoginModel->CheckUser($username, $password);` lalu dilakukan perkondisian di bawahnya. jika di models mendapatkan hasil dari maka akan di lajutkan di `if` jika tidak akan ada di `else` untuk menampilkan pesan `Username atau password salah!`

- Bagian Models
```php
    public function CheckUser($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
```
Di bagian models ini lah untuk mengecek apakah input `username` dan `password` yang di masukan pengguna itu cocok dengan data yang ada di database
`$sql = "SELECT * FROM users WHERE username = ? AND password = ?";`

### Pemisahan Role pada tampilan setelah Login

Cara kerja sistem bisa mengetahui role pengguna adalah saat sistem sudah menemukan data yang match dengan input pengguna di login, pada perkondisian di controller selanjutnya akan mengecek kolom data `kategori` dari username pengguna `0` berarti Super Admin, `1` berarti Operator, `2` berarti Pegawai. Lalu setelah itu akan kembali ke public untuk memberikan sistem perintah untuk menampilkan tampilan home pada masing masing role.

- Pada Controllers

```php
if ($user) {
    $row = $this->LoginModel->CheckKategoriUser($username);
    $Role = $row['kategori'];

    $_SESSION['username'] = $username;

    if ($Role == 0) {
        $_SESSION['role'] = 'superadmin';
        
        header('Location: index.php');
        exit;
    } elseif ($Role == 1) {
        $_SESSION['role'] = 'operator';
        header('Location: index.php');
        exit;
    } elseif ($Role == 2) {
        $_SESSION['role'] = 'pegawai';
        header('Location: index.php ');
        exit;
    }
```

- Pada Public
```
    default:
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'superadmin') {
                $SuperAdminController->index();
                exit;
            }
            elseif ($_SESSION['role'] == 'operator') {
                $OperatorController->index();
                exit;
            }
            elseif ($_SESSION['role'] == 'pegawai') {
                $PegawaiController->index();
                exit;
            }
        }
```

### Akun yang ada di dalam SQL

- Super Admin
Username : Wiranata
Password : 1234

- Operator
Username : Moses
Password : 1234

- Pegawai
Username : Jovanka
Password : 1234