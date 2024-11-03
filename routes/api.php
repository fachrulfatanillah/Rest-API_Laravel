<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatMessageController;

// Rute untuk operasi POST
Route::middleware('api')->prefix('post')->group(function () {
    Route::post('/users', [UserController::class, 'create']);
    Route::post('/message', [ChatMessageController::class, 'create']);
});

// Rute untuk operasi GET
Route::middleware('api')->prefix('get')->group(function () {
    Route::get('/users', [UserController::class, 'get']);
    Route::get('/message/{sender_id}/{receiver_id}', [ChatMessageController::class, 'get']);
});
