<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use Illuminate\Http\Request;

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
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'release_date' => 'required|date',
    ]);

    Game::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'release_date' => $validated['release_date'],
        'user_id' => Auth::id(), // 👈 LIGNE CLÉ
    ]);

    return redirect()->route('dashboard');
}


    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'release_date' => 'required|date',
        ]);

        $game->update($request->only([
            'title',
            'description',
            'release_date',
        ]));

        return redirect()->route('games.index');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index');
    }
}
