<?php

use App\Http\Controllers\API\v1\Website\Reviews\ReviewController;
use Illuminate\Support\Facades\Route;



    Route::post('/books/{book_id}/reviews', [ReviewController::class, 'store']);
    Route::get('/books/{book_id}/reviews', [ReviewController::class, 'index']);


