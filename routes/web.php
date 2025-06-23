<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'dashboard')->name('dashboard');
    Volt::route('recipes', 'recipes.search')->name('recipes.search');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('my-recipes', 'recipes.index')->name('recipes.index');
    Volt::route('my-recipes/create', 'recipes.create')->name('recipes.create');
    Volt::route('recipes/favourites', 'recipes.favourites')->name('recipes.favourites');
    Volt::route('my-recipes/edit/{recipe}', 'recipes.edit')->name('recipes.edit');
    Volt::route('my-recipes/view/{recipe}', 'recipes.view')->name('recipes.view');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
