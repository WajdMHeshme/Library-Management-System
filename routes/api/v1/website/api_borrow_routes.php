<?php

use App\Http\Controllers\API\v1\Website\Borrowings\BorrowingController;
use Illuminate\Support\Facades\Route;


    Route::post('/borrowings', [BorrowingController::class, 'store']);
    Route::get('/borrowings', [BorrowingController::class, 'myBorrowings']);

