<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('like')->group(function () {
        Route::get('/', [LikeController::class, 'index'])->name('api.like.index');
        Route::get('/{id}', [LikeController::class, 'show'])->name('api.like.show');
        Route::get('/status/{id}', [LikeController::class, 'status'])->name('api.like.status');
        Route::post('/{id}', [LikeController::class, 'create'])->name('api.like.create');
    });
});
