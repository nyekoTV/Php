<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;

class GamePolicy
{
    /**
     * Un utilisateur peut supprimer SON jeu
     */
    public function delete(User $user, Game $game): bool
    {
        return $user->id === $game->user_id || $user->is_admin;
    }

    /**
     * Un utilisateur peut modifier SON jeu
     */
    public function update(User $user, Game $game): bool
    {
        return $user->id === $game->user_id || $user->is_admin;
    }
}
