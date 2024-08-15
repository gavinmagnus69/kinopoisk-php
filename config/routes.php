<?php
    use App\Kernel\Router\Route;
    use App\Controllers\HomeController;
    use App\Controllers\MovieController;
    return [
        Route::get('/home', [HomeController::class, 'index']),
        Route::get('/movies', [MovieController::class, 'index'])
    ];
?>