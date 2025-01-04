<?php

use App\Livewire\Releases;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('site.index'))
    ->name('site.index');

Route::get('releases', Releases::class)
    ->name('releases.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
