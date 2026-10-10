<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;

class CatchGameController extends Controller
{
    public function index()
    {
        return view('games.catch.index');
    }
}