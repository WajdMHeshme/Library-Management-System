<?php

use App\Http\Controllers\API\v1\Admin\Books\BooksController;
use Illuminate\Support\Facades\Route;



Route::prefix('books')->group(function () {

    Route::get('/', [BooksController::class, 'index']);
    Route::get('{book_id}', [BooksController::class, 'show']);
});
