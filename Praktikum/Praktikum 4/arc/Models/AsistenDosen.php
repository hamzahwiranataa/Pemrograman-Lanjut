<?php
namespace App\Models;

use App\Interfaces\HasContact;
use App\Interfaces\CanAssist;

class AsistenDosen extends Mahasiswa implements HasContact, CanAssist {
    private string $email;
    private string $bidangAsistensi;

    public function __construct(string $id, string $name, string $nim, string $jurusan, string $bidangAsistensi) {
        parent::__construct($id, $name, $nim, $jurusan);
        $this->bidangAsistensi = $bidangAsistensi;
        $this->email = strtolower(str_replace(' ', '.', $name)) . '@kampus.ac.id';
    }
    public function getRole(): string {
        return 'Asisten Dosen';
    }
    public function deskripsi(): string {
        return $this->getNim() . ' - ' . $this->getNama() . ' (Asisten ' . $this->bidangAsistensi . ')';
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function assist(): string {
        return $this->getNama() . ' membantu dosen di bidang ' . $this->bidangAsistensi;
    }
}
