<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Apply CORS middleware to all API routes
Route::middleware('api',)->group(function (): void {
    // Auth Routes
    require_once __DIR__ . '/auth/api_auth_routes.php';
    require_once __DIR__ . '/admin/admin_routes.php';
    require_once __DIR__ . '/website/api_website_routes.php';
});
