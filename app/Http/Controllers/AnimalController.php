<?php

namespace App\Http\Controllers;

use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::orderBy('id')->get();
        return view('animals.index', compact('animals'));
    }

    public function show(Animal $animal)
{
    $previousAnimal = Animal::where('id', '<', $animal->id)
        ->orderBy('id', 'desc')
        ->first();

    $nextAnimal = Animal::where('id', '>', $animal->id)
        ->orderBy('id')
        ->first();

    // La primul animal, Back merge la ultimul
    if (!$previousAnimal) {
        $previousAnimal = Animal::orderBy('id', 'desc')->first();
    }

    // La ultimul animal, Next merge la primul
    if (!$nextAnimal) {
        $nextAnimal = Animal::orderBy('id')->first();
    }

    return view('animals.show', compact(
        'animal',
        'previousAnimal',
        'nextAnimal'
    ));
}


    public function game()
{
    $animals = Animal::orderBy('id')->get();

    return view('games.index', compact('animals'));
}
}
