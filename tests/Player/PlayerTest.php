<?php

declare(strict_types=1);

namespace App\Player;

use App\Dice\DiceHand;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for the controller Debug.
 */
class PlayerTest extends TestCase
{
    public function testCreatePlayer()
    {
        $name = "John Doe";
        $diceHand = new DiceHand(3, 7);
        $player = new Player($diceHand, $name);
        $this->assertEquals($player->getName(), $name);
        $newName = "Jonna Smith";
        $player->setName($newName);
        $this->assertEquals($player->getName(), $newName);
    }

    public function testStatus()
    {
        $name = "John Doe";
        $diceHand = new DiceHand(3, 7);
        $player = new Player($diceHand, $name);
        $this->assertEquals($player->getStatus(), 0);
        $player->setStatus(1);
        $this->assertEquals($player->getStatus(), 1);
    }

    public function testThrowDices()
    {
        $name = "John Doe";
        $diceHand = new DiceHand(3, 7);
        $player = new Player($diceHand, $name);
        $player->throwDices();
        $this->assertGreaterThanOrEqual(3, $diceHand->getDiceSum());
    }
}
