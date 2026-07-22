<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Src\Auth\Infrastructure\Http\Controllers\AuthController;
use Src\Auth\Infrastructure\Http\Controllers\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});


Route::post('/auth/register', RegisterController::class);
