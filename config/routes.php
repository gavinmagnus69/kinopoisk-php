<?php

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\MovieController;
use App\Controllers\RegisterController;
use App\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/register', [RegisterController::class, 'index']),
    Route::post('/register', [RegisterController::class, 'register']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::get('/admen', [AdminController::class, 'index']),
    Route::get('/admen/categories/add', [CategoryController::class, 'create']),
    Route::post('/admen/categories/add', [CategoryController::class, 'store']),
    Route::post('/admen/categories/destroy', [CategoryController::class, 'destroy']),
    Route::post('/admen/categories/update', [CategoryController::class, 'update']),
    Route::get('/admen/categories/update', [CategoryController::class, 'edit']),
    Route::get('/admen/movies/add', [MovieController::class, 'create']),



];
