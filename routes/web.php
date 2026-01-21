<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('home', 'home')
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::redirect('dashboard', 'home')->name('dashboard');

Route::view('nostalgia', 'nostalgia')
    ->middleware(['auth', 'verified'])
    ->name('nostalgia');

Route::view('bridge', 'bridge')
    ->middleware(['auth', 'verified'])
    ->name('bridge');

Route::view('date-roulette', 'date-roulette')
    ->middleware(['auth', 'verified'])
    ->name('date-roulette');

Route::view('growth-space', 'growth-space')
    ->middleware(['auth', 'verified'])
    ->name('growth-space');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
