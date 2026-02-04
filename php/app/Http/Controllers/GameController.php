<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'release_date' => 'required|date',
        ]);

        Game::create($request->all());

        return redirect()->route('games.index');
    }
}
