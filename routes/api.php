<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [Authcontroller::class, 'register']);
Route::post('/login', [Authcontroller::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // User Management (Owner Only)
    // Route::middleware('permission:create_user')->post('/users', ...);
    // Route::middleware('permission:edit_user')->post('/users', ...);

    // Room Management (Owner & admin)
    // Route::middleware('permission:view_room')->get('/rooms', ...);
    // Route::middleware('permission:create_room')->post('/rooms', ...);

    // Invoices (Owner & admin)
    // Route::middleware('permission:view_room')->get('/rooms', ...);
    // Route::middleware('permission:create_room')->post('/rooms', ...);

    // logout
    Route::post('/logout', [Authcontroller::class, 'logout']);
    Route::post('/me', [Authcontroller::class, 'me']);

    // route yang butuh login
    Route::apiResource('posts', PostController::class);
});