<?php

class UserModel {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email = :email');
        $this->db->bind('email', $email);

        return $this->db->single();
    }
}