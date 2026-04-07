<?php

use App\Http\Controllers\API\v1\Website\Favorites\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::prefix('favorites')->group(function () {

    Route::get('/', [FavoriteController::class, 'index']);
    Route::post('/', [FavoriteController::class, 'store']);
    Route::delete('/{id}', [FavoriteController::class, 'destroy']);
});
