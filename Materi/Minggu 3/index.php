<?php 
class Hewan {
    protected $nama_hewan;
    protected $jenis_hewan;
    private $umur_hewan;

    public function __construct($nama, $jenis, $umur) {
        $this->nama_hewan = $nama;
        $this->jenis_hewan = $jenis;
        $this->setUmur($umur);
    }

    public function getUmur() {
        return $this->umur;
    }


    public function setUmur($umur) {
        if ($umur >= 0) {
            $this->umur_hewan = $umur;
        } else {
            echo "Umur harus angka positif.";
        }
    }

    public function infoHewan() {
        echo "Nama: {$this->nama_hewan}<br>";
        echo "Jenis: {$this->jenis_hewan}<br>";
        echo "Umur: {$this->umur_hewan} tahun<br>";
    }
}

class Kucing extends Hewan {
    public function Suara() {
        return "Meong!";
    }

    public function infoHewan() {
        parent::InfoHewan();
        echo " Suara: " . $this->Suara() . "<br>";
    }
}

class Anjing extends Hewan {
    public function Suara() {
        return "Guk Guk!";
    }
    public function infoHewan() {
        parent::infoHewan();
        echo " Suara: " . $this->Suara() . "<br>";
    }
}

$hewan = new Hewan("Hewan", "Umum", 5);
$hewan->infoHewan();
echo "<br>";

$kucing = new Kucing("Kucing", "Mamalia", 1);
$kucing->infoHewan();
echo "<br>";

$anjing = new Anjing("Anjing", "Mamalia", 3);
$anjing->infoHewan();
echo "<br>";
?>