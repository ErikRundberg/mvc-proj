<?php

namespace App\Http\Controllers;

use App\Models\Game21;
use Illuminate\Http\Request;

class Game21Controller extends Controller
{
    public function show()
    {
        $game = new Game21();
        $game->checkState();

        $data = [
            "title" => "Game 21"
        ];

        return view("game21", $data);
    }
}
