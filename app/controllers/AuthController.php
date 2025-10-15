<?php

class AuthController extends Controller {

   public function index() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $data['judul'] = 'Login';
        $this->view('templates/header_auth', $data);
        $this->view('auth/login');
        $this->view('templates/footer_auth');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = $this->model('UserModel');
            $user = $userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nama'] = $user['nama'];
                $_SESSION['user_role'] = $user['role'];
                
                if ($user['role'] == 'admin') {
                    header('Location: '. BASEURL); 
                } else {
                    header('Location: '. BASEURL . '/member'); 
                }
                exit;

            } else {
                Flasher::setFlash('Email atau password', 'salah', 'danger');
                header('Location: ' . BASEURL . '/auth');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}