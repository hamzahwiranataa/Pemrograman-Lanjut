<?php
namespace App\Models;
use App\Interfaces\HasIdentity;
use App\Traits\CanIntroduce;

class Person implements HasIdentity {
	use CanIntroduce;
	protected string $id;
	protected string $name;
	public static int $counter = 0;

	public function __construct(string $id, string $name) {
		$this->id = $id;
		$this->name = $name;
		self::$counter++;
	}
	public static function getJumlah() {
		return self::$counter;
	}
	public function getNama() {
		return $this->name;
	}
	public function getId(): string {
		return $this->id;
	}
}
?>
