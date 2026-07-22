<?php

use Illuminate\Support\Facades\Route;
use Src\Auth\Infrastructure\Http\Controllers\LoginController;
use Src\Auth\Infrastructure\Http\Controllers\RegisterController;


Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);
