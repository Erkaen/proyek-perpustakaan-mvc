<?php
// app/controllers/MemberController.php

class MemberController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'member') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Buku Pinjaman Saya';
        $data['peminjaman'] = $this->model('TransaksiModel')->getTransaksiByUserId($_SESSION['user_id']);
        
        $this->view('templates/header', $data);
        $this->view('member/index', $data);
        $this->view('templates/footer');
    }

    public function daftarBuku() {
        $data['judul'] = 'Daftar Buku Tersedia';
        $data['buku'] = $this->model('BukuModel')->getBukuTersedia(); 

        $this->view('templates/header', $data);
        $this->view('member/daftar_buku', $data); 
        $this->view('templates/footer');
    }
}