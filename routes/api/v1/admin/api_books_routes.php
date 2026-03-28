<?php

use App\Http\Controllers\API\v1\Admin\Books\BooksController;
use Illuminate\Support\Facades\Route;



Route::prefix('books')->group(function () {

    Route::get('/', [BooksController::class, 'index']);
    Route::post('/', [BooksController::class, 'store']);
    Route::get('{book_id}', [BooksController::class, 'show']);
    Route::put('{book_id}', [BooksController::class, 'update']);
    Route::delete('{book_id}', [BooksController::class, 'destroy']);

});
