<?php

use App\Http\Controllers\API\v1\Admin\Borrowings\BorrowingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('borrowings')
    ->group(function () {


        Route::get('/', [BorrowingController::class, 'index']);
        Route::get('/pending', [BorrowingController::class, 'pending']);
        Route::patch('{id}/approve', [BorrowingController::class, 'approve']);
        Route::patch('{id}/reject', [BorrowingController::class, 'reject']);
        Route::patch('{id}/return', [BorrowingController::class, 'returnBook']);
    });
