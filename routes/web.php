<?php

use App\Livewire\Playlists;
use App\Livewire\Releases;
use Illuminate\Support\Facades\Route;

Route::get('/', Releases::class)
    ->name('site.index');

Route::get('playlists', Playlists::class)
    ->name('playlist.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
