<?php

namespace App\Http\Controllers;

use App\Models\Game;

class DashboardController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('dashboard', compact('games'));
    }
}
