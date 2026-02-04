<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GameController extends Controller
{
    use AuthorizesRequests; // ✅ LIGNE CLÉ (OBLIGATOIRE)

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
            'user_id' => Auth::id(), // 🔐 propriétaire
        ]);

        return redirect()->route('dashboard');
    }

    public function edit(Game $game)
    {
        $this->authorize('update', $game); // 🔐 sécurité

        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $this->authorize('update', $game); // 🔐 sécurité

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
        $this->authorize('delete', $game); // 🔐 sécurité

        $game->delete();

        return redirect()->route('dashboard');
    }
}
