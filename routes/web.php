<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'site.index')
    ->name('site.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
