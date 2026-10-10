<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;

class ColorsGameController extends Controller
{
    public function index()
    {
        return view('games.colors.index');
    }
}