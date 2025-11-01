<?php

namespace App\Models;
use App\Interfaces\HasContact;

class Mahasiswa extends Person implements HasContact {
	private string $email;
	private string $nim;
	private string $jurusan;

	public function __construct(string $id, string $name, string $nim, string $jurusan) {
		parent::__construct($id, $name);
		$this->nim = $nim;
		$this->jurusan = $jurusan;
		$this->email = strtolower(str_replace(' ', '.', $name)) . '@kampus.ac.id';
	}
	public function getEmail(): string {
		return $this->email;
	}
	public function getRole(): string {
		return 'Mahasiswa';
	}
	public function deskripsi(): string {
		return $this->nim . ' - ' . $this->getNama() . ' (' . $this->jurusan . ')';
	}
	public function getNim(): string {
		return $this->nim;
	}
}
?>
