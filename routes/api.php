<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('api')->group(function () {
    Route::post('/users', [UserController::class, 'create']);
});