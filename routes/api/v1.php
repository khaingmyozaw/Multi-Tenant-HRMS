<?php

use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\DepartmentController;
use App\Http\Controllers\Api\V1\IndustryController;
use App\Http\Controllers\Api\V1\PositionController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->prefix('v1')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware(['auth:api'])->prefix('v1')->group(function() {
    Route::get('/user', [UserController::class, 'index']);
    
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('/industries', IndustryController::class);
    Route::apiResource('/companies', CompanyController::class);
    Route::apiResource('/departments', DepartmentController::class);
    Route::apiResource('/positions', PositionController::class);

    Route::apiResource('/attendances', AttendanceController::class);
});
