<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');
Route::livewire('/menus/{menu}', 'pages::menus.show')->name('menus.show');
Route::livewire('/profile', 'pages::users.profile')->name('users.profile');
