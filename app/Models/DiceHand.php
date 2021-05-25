<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * DiceHand Functions.
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

class DiceHand extends GraphicalDice
{

    private $dices = [];
    private $allThrows = [];
    private $sumThrows;
    private $sum;

    public function __construct($dices, $sides = 6)
    {
        for ($i = 0; $i < $dices; $i++) {
            $this->dices[$i] = new GraphicalDice($sides);
        }
    }

    public function rollAll(): void
    {
        $this->allThrows = [];
        $this->sumThrows = 0;
        foreach ($this->dices as $dice) {
            $dice->roll();
            $dice->makeDie();
            $this->sum += $dice->getLastRoll();
            $this->sumThrows += $dice->getLastRoll();
            $this->allThrows[] = $dice->getLastRoll();
            $this->insertIntoDb($dice->getLastRoll());
        }
    }

    public function getThrows(): array
    {
        return $this->allThrows;
    }

    public function getThrowSum(): int
    {
        return $this->sumThrows;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function insertIntoDb($int): void
    {
        switch ($int) {
            case 1:
                DB::table('histograms')->where('id', 1)->update([
                    'one' => DB::raw('one+1')
                ]);
                break;

            case 2:
                DB::table('histograms')->where('id', 1)->update([
                    'two' => DB::raw('two+1')
                ]);

            case 3:
                DB::table('histograms')->where('id', 1)->update([
                    'three' => DB::raw('three+1')
                ]);
                break;

            case 4:
                DB::table('histograms')->where('id', 1)->update([
                    'four' => DB::raw('four+1')
                ]);
                break;

            case 5:
                DB::table('histograms')->where('id', 1)->update([
                    'five' => DB::raw('five+1')
                ]);
                break;

            case 6:
                DB::table('histograms')->where('id', 1)->update([
                    'six' => DB::raw('six+1')
                ]);
                break;
        }
    }
}
