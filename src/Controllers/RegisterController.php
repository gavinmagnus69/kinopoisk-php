<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $this->view('register');
    }

    public function register()
    {
        $validation = $this->request()->validate(['email' => ['required', 'email'],
            'password' => ['required', 'min:8']]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {

                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        $email = $this->request()->input('email');
        // $password = password_hash($this->request()->input('password'), PASSWORD_DEFAULT);
        $password = $this->request()->input('password');
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        // dd($email, $password, $hashed);

        $userId = $this->db()->insert('users', [
            'email' => $email,
            'password' => $hashed]);

        // dd($email, $password);

        dd("User created with id $userId");
    }
}
