<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Models\Animal;

class AnimalGameController extends Controller
{
    public function index()
    {
        $animals = Animal::orderBy('id')->get();

        return view('games.animals.index', compact('animals'));
    }
}