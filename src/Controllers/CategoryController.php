<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    private CategoryService $categoryService;

    private function service() {
        if(! isset($this->categoryService)){
            $this->categoryService = new CategoryService($this->db());
        }

        return $this->categoryService;
    }

    public function create(): void
    {
        $this->view('admin/categories/add');
    }

    public function store(): void
    {

        $validation = $this->request()->validate(
            [
                'name' => ['required', 'min:3', 'max:255'],
            ]
        );

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admen/categories/add');
        }

        $this->service()->store($this->request()->input('name'));

        $this->redirect('/admen');
    }

    public function destroy(): void {

        $this->service()->destroy($this->request()->input('id'));

        $this->redirect('/admen');
    }

    public function edit(): void {

    }
}
