<?php

class AnggotaController extends Controller {

      public function __construct() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }
    
    public function index() {
        $data['judul'] = 'Daftar Anggota';
        $data['anggota'] = $this->model('AnggotaModel')->getAllAnggota();
        
        $this->view('templates/header', $data);
        $this->view('anggota/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('AnggotaModel')->tambahDataAnggota($_POST) > 0) {
            header('Location: ' . BASEURL . '/anggota');
            exit;
        } else {
            header('Location: ' . BASEURL . '/anggota');
            exit;
        }
    }

    public function hapus($id) {
        if ($this->model('AnggotaModel')->hapusDataAnggota($id) > 0) {
            header('Location: ' . BASEURL . '/anggota');
            exit;
        } else {
            header('Location: ' . BASEURL . '/anggota');
            exit;
        }
    }
}