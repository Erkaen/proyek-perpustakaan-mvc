<?php

class BukuController extends Controller {

     public function __construct() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }
    public function index() {
        $data['judul'] = 'Daftar Buku';
        $data['buku'] = $this->model('BukuModel')->getAllBuku();
        
        $this->view('templates/header', $data);
        $this->view('buku/index', $data);
        $this->view('templates/footer');
    }

    public function hapus($id) {
        if ($this->model('BukuModel')->hapusDataBuku($id) > 0) {
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

    public function tambah() {
    if ($this->model('BukuModel')->tambahDataBuku($_POST) > 0) {
        Flasher::setFlash('Buku', 'berhasil ditambahkan', 'success');
        header('Location: ' . BASEURL . '/buku');
        exit;
    } else {
        Flasher::setFlash('Buku', 'gagal ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/buku');
        exit;
    }
}

}