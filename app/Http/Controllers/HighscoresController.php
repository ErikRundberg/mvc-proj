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

        $histograms = DB::table('histograms')->get();

        $data = [
            "title" => "Highscores",
            "hiscores" => $highscores,
            "histograms" => $histograms[0]
        ];

        return view("hiscore", $data);
    }
}
