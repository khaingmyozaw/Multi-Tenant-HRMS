<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user-show', [UserController::class, 'show']);
});