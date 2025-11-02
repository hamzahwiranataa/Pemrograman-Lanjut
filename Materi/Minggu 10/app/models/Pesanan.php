<?php
require_once '../app/core/QueryBuilder.php';

class Pesanan {
    private $db;

    public function __construct() {
        $this->db = new QueryBuilder();
    }

    public function getAll(): array {
        return $this->db->table('pesanan')
                        ->select(['*'])
                        ->get();

    }

    public function getById($id) {
        return $this->db->table("pesanan")
                        ->select(['*'])
                        ->where('id', '=', $id)
                        ->get();
    }

    public function create($data)
    {
        return $this->db->table('pesanan')->insert([
            'nama_klien' => $data['nama_klien'],
            'email' => $data['email'],
            'jenis_jasa' => $data['jenis_jasa'],
            'deskripsi' => $data['deskripsi']
        ]);
    }


    public function update($id, $data)
    {
        return $this->db->table('pesanan')
                        ->update([
                            'nama_klien' => $data['nama_klien'],
                            'email' => $data['email'],
                            'jenis_jasa' => $data['jenis_jasa'],
                            'deskripsi' => $data['deskripsi']])
                        ->where('id', '=', $id)
                        ->execute();
    }


    public function delete($id) {
        return $this->db->table("pesanan")
                        ->delete()
                        ->where('id', '=', $id)
                        ->execute();
    }
}
?>