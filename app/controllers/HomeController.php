<?php

class HomeController extends Controller {
    
    public function index() {
        $data['judul'] = 'Dashboard';

        if (isset($_SESSION['user_id'])) {
            $data['nama_user'] = $_SESSION['user_nama'];
            $data['total_buku'] = $this->model('BukuModel')->countBuku();
            $data['total_anggota'] = $this->model('AnggotaModel')->countAnggota();
            $data['peminjaman_aktif'] = $this->model('TransaksiModel')->countTransaksiAktif();
        } else {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
        
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}