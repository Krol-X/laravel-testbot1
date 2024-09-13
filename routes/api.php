<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TgUserController;

Route::prefix('v1')->group(function() {
    Route::prefix('tg-users')->group(function() {
        Route::get('list', [TgUserController::class, 'list']);
    });
});
