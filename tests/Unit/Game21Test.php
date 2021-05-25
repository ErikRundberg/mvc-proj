<?php

namespace App\Models;

use Request;
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
        $this->checkState();
    }

    public function testStartGame()
    {
        $game = new Game21();
        $this->assertInstanceOf("App\Models\Game21", $game);

        $this->withSession(["REQUEST_METHOD" => "POST"]);
        $this->call('POST', '', ['start' => 'set']);
        $this->call('POST', '', ['bet' => '12']);
        $game->startGame();

        $this->assertEquals(session("bet"), 12);
    }
}
