<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Rute untuk operasi POST
Route::middleware('api')->prefix('post')->group(function () {
    Route::post('/users', [UserController::class, 'create']);
});

// Rute untuk operasi GET
Route::middleware('api')->prefix('get')->group(function () {
    Route::get('/users', [UserController::class, 'get']);
});
