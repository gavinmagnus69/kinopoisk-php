<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller {
    public function index(): void {
        $this->view('login');
    }

    public function login() {
        // dd($this->auth());

        $login = $this->request()->input('email');
        $password = password_hash($this->request()->input('password'), PASSWORD_DEFAULT);

        // $this->auth()->attempt($login, $password)

        $result = $this->db()->first('users', ['email' => $login, 'password' => $password]);
        
        dd($result);
    }
}
