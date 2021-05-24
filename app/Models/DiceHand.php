<?php

declare(strict_types=1);

namespace App\Models;

/**
 * DiceHand Functions.
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
}
