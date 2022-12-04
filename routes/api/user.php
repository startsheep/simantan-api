<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('api.user.index');
        Route::post('/', [UserController::class, 'store'])->name('api.user.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('api.user.show');
        Route::put('/{id}', [UserController::class, 'update'])->name('api.user.update');
        Route::put('/change-password/{id}', [UserController::class, 'changePassword'])->name('api.user.change.password');
        Route::delete('/{id}', [UserController::class, 'delete'])->name('api.user.delete');
        Route::get('/count-post/{id}', [UserController::class, 'countPost'])->name('api.user.count.post');
        Route::get('/count-like/{id}', [UserController::class, 'countLike'])->name('api.user.count.like');
    });
});
