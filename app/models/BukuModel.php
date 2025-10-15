<?php

class BukuModel {
    private $table = 'books';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBuku() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getBukuById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataBuku($data) {
        $query = "INSERT INTO books (judul, penulis, tahun_terbit, stok) 
                  VALUES (:judul, :penulis, :tahun_terbit, :stok)";
        
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('penulis', $data['penulis']);
        $this->db->bind('tahun_terbit', $data['tahun_terbit']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataBuku($id) {
        $query = "DELETE FROM books WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function countBuku() {
        $this->db->query('SELECT COUNT(id) as total FROM ' . $this->table);
        return $this->db->single()['total'];
    }

    public function getBukuTersedia() {
        $this->db->query('SELECT judul, penulis, tahun_terbit, stok FROM ' . $this->table . ' WHERE stok > 0 ORDER BY judul ASC');
        return $this->db->resultSet();
    }
}