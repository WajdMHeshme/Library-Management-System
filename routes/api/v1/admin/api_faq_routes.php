<?php

use App\Http\Controllers\API\v1\Admin\FAQ\FAQController;
use Illuminate\Support\Facades\Route;



    Route::prefix('faqs')->middleware('auth:sanctum')->group(function () {
        Route::get('/', [FAQController::class, 'index']);
        // Get all faqs
        Route::get('/{id}', [FAQController::class, 'show']);
        // Get single faq
        Route::post('/', [FAQController::class, 'store']);
        // Create faq
        Route::put('/{id}', [FAQController::class, 'update']);
        // Update faq
        Route::delete('/{id}', [FAQController::class, 'destroy']);
        // Delete faq
    });

