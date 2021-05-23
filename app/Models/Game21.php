<?php

namespace App\Models;

use Request;
use App\Models\DiceHand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game21 extends Model
{
    public $diceHand;

    public function checkState(): void
    {
        $this->startGame();
        // $this->postRoll();
        // $this->postReset();
        // $this->postStop();
        // $this->postBack();
    }

    public function startGame(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("start")) {
            $dieAmount = Request::input("start");
            session(["start" => "yes"]);
            session(["die" => ["dice-1", "dice-3"]]);
            session(["sum" => 19]);
            $this->diceHand = new DiceHand($dieAmount);
        }
    }

    public function forceRoll(): void
    {
        $diceHand = new DiceHand($_SESSION["diceAmt"]);
        $diceHand->rollAll();
        $_SESSION["dices"] = $diceHand->getResult();
        $_SESSION["sum"] += $diceHand->getSum();
        $_SESSION["message"] = $diceHand->calculateWin();
    }

    public function postReset(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["reset"])) {
            $_SESSION["wins"] = null;
            $_SESSION["lose"] = null;
        };
    }

    public function postRoll(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["roll"])) {
            $diceHand = new DiceHand($_SESSION["diceAmt"]);
            $diceHand->rollAll();
            $_SESSION["dices"] = $diceHand->getResult();
            $_SESSION["sum"] += $diceHand->getSum();
            $_SESSION["message"] = $diceHand->calculateWin();
        };
    }

    public function postStop(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["stop"])) {
            $diceHand = new DiceHand($_SESSION["diceAmt"]);
            $_SESSION["compSum"] = $diceHand->computerRoll();
            $_SESSION["message"] = $diceHand->calculateWin();
        };
    }

    public function postBack(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["back"])) {
            $_SESSION["message"] = null;
            $_SESSION["diceAmt"] = null;
            $_SESSION["sum"] = null;
            $_SESSION["compSum"] = null;
            $_SESSION["dices"] = null;
        };
    }
}
