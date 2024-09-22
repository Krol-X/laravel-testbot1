<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TgUserController;

Route::prefix('v1')->group(function() {
    Route::prefix('tg-users')->group(function() {
        Route::get('/', [TgUserController::class, 'index'])->name('tg-users.index');
        Route::post('/', [TgUserController::class, 'store'])->name('tg-users.store');
        Route::get('/{user}', [TgUserController::class, 'show'])->where('user', '[0-9]+')
            ->name('tg-users.show');
        Route::put('/{user}', [TgUserController::class, 'update'])->where('user', '[0-9]+')
            ->name('tg-users.update');
        Route::delete('/{user}', [TgUserController::class, 'destroy'])->where('user', '[0-9]+')
            ->name('tg-users.destroy');
    });
});
