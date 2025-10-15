<?php

class RiwayatController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index() {
        $data['judul'] = 'Riwayat Peminjaman';
        $transaksiModel = $this->model('TransaksiModel');

        $options = [
            'search' => $_GET['search'] ?? null,
            'status' => $_GET['status'] ?? null,
            'start_date' => $_GET['start_date'] ?? null,
            'end_date' => $_GET['end_date'] ?? null,
        ];

        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        
        $totalRecords = $transaksiModel->countHistory($options);
        $data['totalPages'] = ceil($totalRecords / $limit);
        $data['currentPage'] = $page;

        $options['limit'] = $limit;
        $options['offset'] = $offset;

        $data['history'] = $transaksiModel->getHistory($options);
        
        $data['filters'] = [
            'search' => $_GET['search'] ?? null,
            'status' => $_GET['status'] ?? null,
            'start_date' => $_GET['start_date'] ?? null,
            'end_date' => $_GET['end_date'] ?? null,
        ]; 

        $this->view('templates/header', $data);
        $this->view('riwayat/index', $data);
        $this->view('templates/footer');
    }
}