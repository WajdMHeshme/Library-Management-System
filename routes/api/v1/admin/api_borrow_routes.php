<?php

use App\Http\Controllers\API\v1\Admin\Borrowing\BorrowingController;
use Illuminate\Support\Facades\Route;

Route::prefix('borrowings')->group(function () {
    Route::get('/pending', [BorrowingController::class, 'pending']);
    Route::put('{id}/approve', [BorrowingController::class, 'approve']);
    Route::put('{id}/reject', [BorrowingController::class, 'reject']);
    Route::put('{id}/return', [BorrowingController::class, 'returnBook']);
});
