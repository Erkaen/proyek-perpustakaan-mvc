<?php
// KODE INI WAJIB ADA DI PALING ATAS UNTUK MELIHAT ERROR
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Memulai session
if (!session_id()) {
    session_start();
}

// Memuat file inisialisasi (autoloader, config, flasher)
require_once '../app/init.php';

// Menjalankan kelas App (Router)
$app = new App();