<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighscoresController extends Controller
{
    public function show()
    {
        $highscores = DB::table('highscores')
            ->orderBy('money', 'desc')
            ->limit(10)
            ->get();

        $data = [
            "title" => "Highscores",
            "hiscores" => $highscores
        ];

        return view("hiscore", $data);
    }
}
