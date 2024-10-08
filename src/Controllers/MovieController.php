<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function create(): void
    {
        $this->view('admin/movies/add');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store(): void
    {

        // dd($this->request()->file('image'));

        $file = $this->request()->file('image');

        $filePath = $file->move('movies');

        dd($this->storage()->url($filePath));

        $validation = $this->request()->validate(['name' => ['required', 'min:3', 'max:50']]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {

                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/movies/add');
        }

        $id = $this->db()->insert('uwu', ['login' => $this->request()->input('name'),
            'password' => 'nigga']);

        dd("successful insertion with id = $id");
    }
}
