<?php

use Illuminate\Support\Facades\Route;

// 1. Contextos Públicos
Route::prefix('v1/auth')->group(base_path('routes/contexts/auth.php'));

// 2. Contextos Protegidos (Carga dinámica de todo lo demás)
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    foreach (glob(base_path('routes/contexts/*.php')) as $file) {
        $context = basename($file, '.php');

        if ($context !== 'auth') {
            Route::prefix($context)->group($file);
        }
    }
});
