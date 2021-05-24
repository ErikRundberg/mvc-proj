<?php

namespace App\Models;

use Request;
use App\Models\DiceHand;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// dh = DiceHand
class Game21 extends Model
{
    public function checkState(): void
    {
        $this->checkMoney();

        $this->startGame();
        $this->goBack();
        $this->rollDice();
        $this->rollBust();
        $this->computerRoll();
        $this->submitScore();
    }

    public function checkMoney(): void
    {
        if (session("money") === null) {
            session(["money" => 10]);
            session(["bank" => 100]);
        }
    }

    public function startGame(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("start")) {
            $diceHand = new DiceHand(Request::input("start"));
            session(["dh" => $diceHand]);
            session(["dh2" => $diceHand]);
            session(["bet" => intval(Request::input("bet"))]);
            if (session("name") === null) {
                session(["name" => Request::input("name")]);
            }
        }
    }

    public function goBack(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("back")) {
            session()->forget(['sum', 'compSum', 'dh', 'die', 'winner']);
        }
    }

    public function rollDice(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("roll")) {
            $diceHand = session("dh");
            $diceHand->rollAll();
            session(["die" => $diceHand->getThrows()]);
            session(["dieSum" => $diceHand->getThrowSum()]);
            session(["sum" => $diceHand->getSum()]);
        }
    }

    public function rollBust(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("roll")) {
            if (session("sum") > 21) {
                session(["compSum" => 21]);
                $this->checkWin();
            }
        }
    }

    public function checkWin(): void
    {
        if (session("win") === null) {
            session(["win" => 0]);
        }
        if (session("lose") === null) {
            session(["lose" => 0]);
        }

        $win = session("win") + 1;
        $lose = session("lose") + 1;
        $bankWin = session("bank") + session("bet");
        $bankLose = session("bank") - session("bet");
        $moneyWin = session("money") + session("bet");
        $moneyLose = session("money") - session("bet");

        if (session("sum") > 21) {
            session(["winner" => "Computer"]);
            session(["lose" => $lose]);
            session(["bank" => $bankWin]);
            session(["money" => $moneyLose]);
            return;
        } elseif (session("compSum") > 21) {
            session(["winner" => "Player"]);
            session(["win" => $win]);
            session(["bank" => $bankLose]);
            session(["money" => $moneyWin]);
            return;
        }
        session(["winner" => "Computer"]);
        session(["lose" => $lose]);
        session(["bank" => $bankWin]);
        session(["money" => $moneyLose]);
    }

    public function computerRoll(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("stay")) {
            $diceHand = session("dh2");

            while (session("compSum") <= session("sum") and session("compSum") <= 21) {
                $diceHand->rollAll();
                session(["compSum" => $diceHand->getSum()]);
            }
            $this->checkWin();
        }
    }

    public function submitScore(): void
    {
        if (Request::server("REQUEST_METHOD") == "POST" and Request::has("reset")) {
            DB::insert('insert into highscores (name, money, win, lose) values (?, ?, ?, ?)', [session("name"), session("money"), session("win"), session("lose")]);
            session()->forget(['win', 'lose', 'money', 'bank', 'name']);
            $this->checkMoney();
        }
    }
}
