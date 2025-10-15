<?php

class GuestController extends Controller {

    public function index() {
        $data['judul'] = 'Daftar Buku Tersedia';
        $data['buku'] = $this->model('BukuModel')->getBukuTersedia();
        
        $this->view('templates/header_auth', $data); 
        $this->view('guest/index', $data);
        $this->view('templates/footer_auth');
    }
}