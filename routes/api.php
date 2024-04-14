<?php

use App\Http\Controllers\Dashboard\BlockController;
use App\Http\Controllers\Dashboard\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Auth required routes
Route::prefix('admin')->group(function () {
    Route::middleware(['auth:api'])->group(function () {

        // Blog blocks and contents
        Route::post('blocks-index', [BlockController::class, 'index'])->name('blocks.index');
        Route::apiResource('blocks', BlockController::class)->except('index', 'show');

        // Images
        Route::post('images-index', [ImageController::class, 'index'])->name('images.index');
        Route::apiResource('images', ImageController::class)->only(['store', 'destroy']);
    });
});

// Public routes
Route::prefix('public')->group(function () {
    //
});
