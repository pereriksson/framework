<?php

declare(strict_types=1);

namespace App\Round;

use App\Dice\DiceHand;
use PHPUnit\Framework\TestCase;
use App\Player\Player;

/**
 * Test cases for the controller Debug.
 */
class RoundTest extends TestCase
{
    public function testRound()
    {
        $diceHand = new DiceHand(2, 6);
        $player = new Player($diceHand, "John Smith");
        $round = new Round();
        $round->setWinner($player);
        $this->assertEquals($round->getWinner(), $player);
    }
}
