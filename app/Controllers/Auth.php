<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected  $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (isLoggedIn())
            return redirect()->to(base_url('home'));

        $data = [
            'title' => 'judul',
        ];
        return view('auth/login', $data);
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        if (empty($password))
            session()->setFlashdata('error', 'Silahkan masukkan password');
        if (empty($email))
            session()->setFlashdata('error', 'Silahkan masukkan email atau username');
        $password = $this->request->getPost('password');

        $where = "(email = '{$email}' OR username = '{$email}')";
        $user = $this->userModel->where($where)->first();
        if (!$user) {
            session()->setFlashdata('error', 'Username atau password anda salah.');
        } else {
            if (!password_verify($password, $user['password']))
                session()->setFlashdata('error', 'Username atau password anda salah.');
            else {
                session()->set('user', $user);
                return redirect()->to(base_url('home'));
            }
        }

        return redirect()->to(base_url('/'));
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
