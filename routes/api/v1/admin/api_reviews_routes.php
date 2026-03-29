<?php

use App\Http\Controllers\API\v1\Admin\Reviews\ReviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('reviews')->group(function () {

    Route::get('/pending',  [ReviewController::class, 'pending']);
    Route::get('/approved', [ReviewController::class, 'approved']);
    Route::get('/rejected', [ReviewController::class, 'rejected']);
    Route::put('{id}/approve', [ReviewController::class, 'approve']);
    Route::put('{id}/reject',  [ReviewController::class, 'reject']);
    Route::delete('{id}', [ReviewController::class, 'destroy']);
});
