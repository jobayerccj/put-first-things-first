<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\GoalController;
use App\Http\Controllers\api\v1\KeyRoleController;
use App\Http\Middleware\VerifyOwnership;
use Illuminate\Support\Facades\Route;

Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');;

Route::middleware(['auth:sanctum', VerifyOwnership::class])->group(function () {
    Route::resource('v1/key_role', KeyRoleController::class);
    Route::resource('v1/goal', GoalController::class);
});

// ownership should be checked using middleware only for show, edit, destroy endpoints

// other endpoints will only use auth middleware
