<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\KeyRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('v1/key_role', KeyRoleController::class)->middleware('auth:sanctum');
