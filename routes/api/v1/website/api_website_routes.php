<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;



Route::prefix('user')->middleware('auth:sanctum')->group(function () {
    require_once __DIR__ . '/api_borrow_routes.php';
});
