<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [Authcontroller::class, 'logout']);
    Route::post('/me', [Authcontroller::class, 'me']);

    // route yang butuh login
    Route::apiResource('posts', PostController::class);
});