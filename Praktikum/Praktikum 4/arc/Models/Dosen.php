<?php
namespace App\Models;

use App\Traits\CanIntroduce;
use App\Traits\CanTeach;
use App\Interfaces\HasIdentity;
use App\Interfaces\HasContact;

class Dosen extends Person implements HasIdentity, HasContact {
    use CanIntroduce, CanTeach;
    private string $nidn;
    private string $keahlian;
    private string $email;

    public function __construct(string $id, string $name, string $nidn, string $keahlian) {
        parent::__construct($id, $name);
        $this->nidn = $nidn;
        $this->keahlian = $keahlian;
        $this->email = strtolower(str_replace(' ', '.', $name)) . '@kampus.ac.id';
    }
    public function getRole(): string {
        return 'Dosen';
    }
    public function deskripsi(): string {
        return $this->nidn . ' - ' . $this->getNama() . ' (' . $this->keahlian . ')';
    }
    public function getNidn(): string {
        return $this->nidn;
    }
    public function getKeahlian(): string {
        return $this->keahlian;
    }
    public function getEmail(): string {
        return $this->email;
    }
}
