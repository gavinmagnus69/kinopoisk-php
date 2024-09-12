<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class AdminController extends Controller
{

    private CategoryService $categoryService;

    public function index(): void
    {
        $this->categoryService = new CategoryService($this->db());   
        $categories = $this->categoryService->all();
        $this->view('admin/index', [
            'categories' => $categories
        ]);
    }
}
