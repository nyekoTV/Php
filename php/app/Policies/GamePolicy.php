<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;

class GamePolicy
{
    /**
     * Un utilisateur peut modifier un jeu s’il en est le propriétaire
     */
    public function update(User $user, Game $game): bool
    {
        return $user->id === $game->user_id;
    }

    /**
     * Un utilisateur peut supprimer un jeu s’il en est le propriétaire
     */
    public function delete(User $user, Game $game): bool
    {
        return $user->id === $game->user_id;
    }
}
