<?php

class AnggotaModel {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAnggota() {
        $this->db->query('SELECT id, nama, email FROM ' . $this->table . " WHERE role = 'member'");
        return $this->db->resultSet();
    }

    public function tambahDataAnggota($data) {
        $query = "INSERT INTO users (nama, email, password, role) 
                  VALUES (:nama, :email, :password, :role)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('email', $data['email']);
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->bind('password', $hashedPassword);

        $this->db->bind('role', 'member'); 

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataAnggota($id) {
        $query = "DELETE FROM users WHERE id = :id AND role = 'member'";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function countAnggota() {
        $this->db->query("SELECT COUNT(id) as total FROM " . $this->table . " WHERE role = 'member'");
        return $this->db->single()['total'];
    }
}