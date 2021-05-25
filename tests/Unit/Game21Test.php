<?php

namespace App\Models;

use Request;
use Http;
use Tests\TestCase;

/**
 * Test cases for class Dice.
 */
class Game21Test extends TestCase
{
    public function testCreateGameState()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        $game->checkState();
    }

    public function testCheckMoney()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);

        $this->assertNull(session("money"));
        $this->assertNull(session("bank"));
        $game->checkMoney();
        $this->assertEquals(10, session("money"));
        $this->assertEquals(100, session("bank"));

    }

    public function testGoBack()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        $this->call('POST', '', ['back' => 'set']);

        session(["sum" => 12]);
        $this->assertEquals(session("sum"), 12);
        $game->goBack();
        $this->assertNull(session("sum"));
    }

    public function testRollDice()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        $this->call('POST', '', ['roll' => 'set']);

        session(["dh" => new DiceHand(2, 1)]);
        $game->rollDice();

        $die = [1, 1];
        $dieSum = 2;
        $sum = 2;
        $this->assertEquals(session("die"), $die);
        $this->assertEquals(session("dieSum"), $dieSum);
        $this->assertEquals(session("sum"), $sum);
    }

    public function testRollBust()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        $this->call('POST', '', ['roll' => 'set']);

        session(["sum" => 30]);
        $game->rollBust();

        $this->assertEquals(session("win"), 0);
        $this->assertEquals(session("lose"), 1);
    }

    public function testCheckWinLoss()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        session(["sum" => 12]);
        session(["compSum" => 13]);

        $game->checkWin();
        $this->assertEquals(session("win"), 0);
        $this->assertEquals(session("lose"), 1);
    }

    public function testCheckWin()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        session(["sum" => 12]);
        session(["compSum" => 32]);

        $game->checkWin();
        $this->assertEquals(session("win"), 1);
        $this->assertEquals(session("lose"), 0);
    }

    public function testComputerRoll()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);
        $this->call('POST', '', ['stay' => 'set']);
        session(["sum" => 12]);
        session(["dh2" => new DiceHand(20, 1)]);

        $game->computerRoll();
        $this->assertEquals(session("win"), 0);
        $this->assertEquals(session("lose"), 1);
    }
}
