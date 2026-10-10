<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Games\AnimalGameController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Games\CountingGameController;
use App\Http\Controllers\Games\CatchGameController;
use App\Http\Controllers\Games\ColorsGameController;
use App\Http\Controllers\Games\ShapesGameController;
use App\Http\Controllers\Games\MemoryGameController;

Route::get('/', fn () => view('home'))->name('home');
Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');
Route::get('/animals/{animal}', [AnimalController::class, 'show'])->name('animals.show');
Route::get('/colors', fn () => view('colors.index'))->name('colors');
Route::prefix('games')->name('games.')->group(function () {

    Route::get('/', [GameController::class, 'index'])
        ->name('index');

    Route::get('/animals', [AnimalGameController::class, 'index'])
        ->name('animals');

    Route::get('/counting', [CountingGameController::class, 'index'])
        ->name('counting');

    Route::get('/catch', [CatchGameController::class, 'index'])
    ->name('catch');

    Route::get('/colors', [ColorsGameController::class, 'index'])
        ->name('colors');

    Route::get('/shapes', [ShapesGameController::class, 'index'])
        ->name('shapes');

    Route::get('/memory', [MemoryGameController::class, 'index'])
        ->name('memory');
   
});