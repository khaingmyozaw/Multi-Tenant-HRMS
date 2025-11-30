<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->prefix('v1')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth'])->group(function() {
        Route::get('/user', [UserController::class, 'index']);
    });
});
