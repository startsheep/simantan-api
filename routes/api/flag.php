<?php

use App\Http\Controllers\FlagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('flag')->group(function () {
        Route::get('/', [FlagController::class, 'index'])->name('api.flag.index');
        Route::post('/', [FlagController::class, 'store'])->name('api.flag.store');
        Route::get('/{id}', [FlagController::class, 'show'])->name('api.flag.show');
        Route::put('/{id}', [FlagController::class, 'update'])->name('api.flag.update');
        Route::delete('/{id}', [FlagController::class, 'delete'])->name('api.flag.delete');
    });
});
