<?php
class MataKuliah {
    private $kode;
    private $nama;
    private $sks;

    public function __construct($kode, $nama, $sks) {
        $this->kode = $kode;
        $this->nama = $nama;
        $this->sks = $sks;
    }

    public function getSks() {
        return $this->sks;
    }

    public function getKode() {
        return $this->kode;
    }

    public function getNama() {
        return $this->nama;
    }

    public function ringkas() {
        return "{$this->kode} - {$this->nama} ({$this->sks} SKS)";
    }
}

class KRS {
    private $matkul = [];

    public function tambah(MataKuliah $mk) {
        if ($this->totalSks() + $mk->getSks() > 24) {
            echo "Tidak bisa menambah {$mk->ringkas()} karena total SKS melebihi 24.<br>";
            return;
        }
        $this->matkul[] = $mk;
        echo "Berhasil menambah: " . $mk->ringkas() . "<br>";
    }

    public function totalSks() {
        $total = 0;
        foreach ($this->matkul as $mk) {
            $total += $mk->getSks();
        }
        return $total;
    }

    public function daftar() {
        echo "<div style='align: center;'>";
        echo "<table border='1' cellpadding='8' cellspacing='0'>";
        echo "<tr>
                <th>Kode</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
              </tr>";

        foreach ($this->matkul as $mk) {
            echo "<tr>
                    <td>{$mk->getKode()}</td>
                    <td>{$mk->getNama()}</td>
                    <td>{$mk->getSks()}</td>
                  </tr>";
        }

        echo "<tr>
                <td colspan='2' align='right'><strong>Total SKS</strong></td>
                <td><strong>" . $this->totalSks() . "</strong></td>
              </tr>";
        echo "</table>";
        echo "</div>";
    }
}

$krs = new KRS();

$mk1 = new MataKuliah("SI101", "Desain Proses Bisnis", 4);
$mk2 = new MataKuliah("SI102", "Pemrograman Lanjut", 3);
$mk3 = new MataKuliah("SI103", "Desain Manajemen dan Komputer", 4);
$mk4 = new MataKuliah("SI104", "Interaksi Manusia dan Komputer", 3);
$mk5 = new MataKuliah("SI105", "Basis Data", 3);
$mk6 = new MataKuliah("SI106", "Konsep Sistem Informasi", 2);
$mk7 = new MataKuliah("SI107", "Statistika Sistem Informasi", 3);
$mk8 = new MataKuliah("SI108", "Matematika Diskrit 2", 3);

$krs->tambah($mk1);
$krs->tambah($mk2);
$krs->tambah($mk3);
$krs->tambah($mk4);
$krs->tambah($mk5);
$krs->tambah($mk6);
$krs->tambah($mk7);
$krs->tambah($mk8);

echo "<hr>";
$krs->daftar();
?>