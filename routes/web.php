<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');
Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/colors', fn () => view('colors.index'))->name('colors');
Route::get('/games', [AnimalController::class, 'game'])->name('games');
