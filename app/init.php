<?php
// app/init.php

// Memuat file konfigurasi
require_once 'config/config.php';

// Memuat Flasher agar bisa digunakan di semua halaman
require_once 'core/Flasher.php';

// Autoloader untuk class-class di folder core
// Ini akan secara otomatis memuat file seperti App.php, Controller.php, dll.
spl_autoload_register(function ($className) {
    // Buat path yang benar dan andal menggunakan dirname(__FILE__)
    // Ini memastikan path selalu dimulai dari folder 'app/'
    $file = dirname(__FILE__) . '/core/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});