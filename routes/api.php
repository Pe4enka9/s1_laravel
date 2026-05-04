<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/sliders', [SliderController::class, 'index']);

Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{menu}', [MenuController::class, 'show']);

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/bookings', [BookingController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/bookings', [UserController::class, 'bookings']);

    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::middleware('admin')->group(function () {
    Route::post('/sliders', [SliderController::class, 'store']);
    Route::patch('/sliders/{slider}', [SliderController::class, 'update']);
    Route::delete('/sliders/{slider}', [SliderController::class, 'destroy']);

    Route::post('/menus', [MenuController::class, 'store']);
    Route::patch('/menus/{menu}', [MenuController::class, 'update']);
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);
});
