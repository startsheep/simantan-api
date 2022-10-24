<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('api.post.index');
        Route::post('/', [PostController::class, 'store'])->name('api.post.store');
        Route::get('/{id}', [PostController::class, 'show'])->name('api.post.show');
        Route::put('/{id}', [PostController::class, 'update'])->name('api.post.update');
        Route::delete('/{id}', [PostController::class, 'delete'])->name('api.post.delete');
    });
});
