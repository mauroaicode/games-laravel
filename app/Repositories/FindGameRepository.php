<?php

namespace App\Repositories;

use App\Models\Game;
use App\Contracts\Game\FindGameInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindGameRepository implements FindGameInterface
{

    public function findGame($id)
    {
        $game = Game::find($id);
        if ($game === null) {
            throw new ModelNotFoundException('Juego no Encontrado');
        }
        return $game;
    }
}
