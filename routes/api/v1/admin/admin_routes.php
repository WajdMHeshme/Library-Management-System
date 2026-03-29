<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Auth Routes
require_once __DIR__ . '/api_auth_routes.php';

Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {

    require_once __DIR__ . '/api_books_routes.php';
    require_once __DIR__ . '/api_category_routes.php';
    require_once __DIR__ . '/api_faq_routes.php';
    require_once __DIR__ . '/api_user_routes.php';
    require_once __DIR__ . '/api_borrow_routes.php';
    require_once __DIR__ . '/api_reviews_routes.php';
});
