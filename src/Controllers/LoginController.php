<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }

    public function login()
    {
        // dd($this->auth());

        $login = $this->request()->input('email');
        $password = $this->request()->input('password');
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $in = $this->auth()->attempt($login, $password);

        if (! $in) {
            $this->redirect('/login');
        }

        $this->redirect('/home');
    }

    public function logout()
    {
        $this->auth()->logout();

        return $this->redirect('/login');
    }
}
