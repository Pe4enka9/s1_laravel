<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Слайдер
Route::get('/sliders', [SliderController::class, 'index']);

// Меню
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{menu}', [MenuController::class, 'show']);

// Регистрация
Route::post('/register', [RegisterController::class, 'register']);
// Авторизация
Route::post('/login', [LoginController::class, 'login']);

// Бронирования
Route::post('/bookings', [BookingController::class, 'store']);

// Получение доступных слотов для записи
Route::get('/slots', [BookingController::class, 'getSlots']);

Route::middleware('auth:sanctum')->group(function () {
    // Пользователь
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/bookings', [UserController::class, 'bookings']);

    // Выход
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::middleware('admin')->group(function () {
    // Слайдер
    Route::post('/sliders', [SliderController::class, 'store']);
    Route::patch('/sliders/{slider}', [SliderController::class, 'update']);
    Route::delete('/sliders/{slider}', [SliderController::class, 'destroy']);

    // Меню
    Route::post('/menus', [MenuController::class, 'store']);
    Route::patch('/menus/{menu}', [MenuController::class, 'update']);
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy']);

    // Слайды меню
    Route::get('/slides', [SlideController::class, 'index']);
    Route::post('/slides', [SlideController::class, 'store']);
    Route::patch('/slides/{slide}', [SlideController::class, 'update']);
    Route::delete('/slides/{slide}', [SlideController::class, 'destroy']);

    // Бронирования
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::patch('/bookings/{booking}', [BookingController::class, 'update']);
    Route::get('/bookings/stats', [BookingController::class, 'getStats']);
});
