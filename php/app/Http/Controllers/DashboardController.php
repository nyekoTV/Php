<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'games' => Game::latest()->paginate(5),
            'gamesCount' => Game::count(),
            'usersCount' => User::count(),
        ]);
    }
}
