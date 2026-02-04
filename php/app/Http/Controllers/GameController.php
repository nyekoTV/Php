<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
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
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard');
    }

    public function edit(Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            abort(403);
        }

        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'release_date' => 'required|date',
        ]);

        $game->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroy(Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            abort(403);
        }

        $game->delete();

        return redirect()->route('dashboard');
    }
}
