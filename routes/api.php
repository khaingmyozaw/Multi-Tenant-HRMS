<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Base\UserController;

Route::get('/user', [UserController::class, 'index']);
Route::get('/user-show', [UserController::class, 'show']);
