<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class AdminController extends Controller
{
    private CategoryService $categoryService;

    private function service()
    {
        if (! isset($this->categoryService)) {
            $this->categoryService = new CategoryService($this->db());
        }

        return $this->categoryService;
    }

    public function index(): void
    {

        $categories = $this->service()->all();

        $this->view('admin/index', [
            'categories' => $categories,
        ]);
    }
}
