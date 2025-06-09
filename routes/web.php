<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('my-recipes', 'recipes.index')->name('recipes.index');
    Volt::route('my-recipes/create', 'recipes.create')->name('recipes.create');
    Volt::route('saved-recipes', 'recipes.saved')->name('recipes.saved');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
