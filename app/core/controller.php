<?php
class Controller {
    public function view($view, $data = []) {
        if (file_exists(APPROOT . '/views/' . $view . '.php')) {
            require_once APPROOT . '/views/' . $view . '.php';
        } else {
            die('ERROR: File view tidak ditemukan di: ' . APPROOT . '/views/' . $view . '.php');
        }
    }

    public function model($model) {
        require_once APPROOT . '/models/' . $model . '.php';
        return new $model();
    }
}