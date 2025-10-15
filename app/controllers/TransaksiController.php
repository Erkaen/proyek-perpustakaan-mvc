<?php

class TransaksiController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Data Peminjaman';
        $data['transaksi'] = $this->model('TransaksiModel')->getTransaksiAktif();
        
        $this->view('templates/header', $data);
        $this->view('transaksi/index', $data);
        $this->view('templates/footer');
    }

    public function pinjam() {
        $data['judul'] = 'Form Peminjaman Buku';
        $data['anggota'] = $this->model('AnggotaModel')->getAllAnggota();
        $data['buku'] = $this->model('BukuModel')->getAllBuku();

        $this->view('templates/header', $data);
        $this->view('transaksi/pinjam', $data);
        $this->view('templates/footer');
    }

    public function prosesPinjam() {
        if ($this->model('TransaksiModel')->pinjamBuku($_POST) > 0) {
            header('Location: ' . BASEURL . '/transaksi');
            exit;
        } else {
            header('Location: ' . BASEURL . '/transaksi/pinjam');
            exit;
        }
    }
    public function kembalikan($id) {
        if ($this->model('TransaksiModel')->kembalikanBuku($id) > 0) {
            header('Location: ' . BASEURL . '/transaksi');
            exit;
        } else {
            header('Location: ' . BASEURL . '/transaksi');
            exit;
        }
    }
}