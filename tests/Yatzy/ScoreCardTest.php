<?php

declare(strict_types=1);

namespace App\Yatzy;

use App\Dice\DiceHand;
use App\Player\Player;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for the controller Debug.
 */
class ScoreCardTest extends TestCase
{
    public function testCreateScoreCard()
    {
        $diceHand = new DiceHand(2, 6);
        $player = new Player($diceHand, "John");
        $scc = new ScoreCard($player);
        $this->assertEquals($player, $scc->getPlayer());
    }

    public function testNumbers()
    {
        $diceHand = new DiceHand(2, 6);
        $player = new Player($diceHand, "John");
        $scc = new ScoreCard($player);
        $scc->setOnes(5);
        $scc->setTwos(5);
        $scc->setThrees(5);
        $scc->setFours(5);
        $scc->setFives(5);
        $scc->setSixes(5);
        $this->assertEquals(30, $scc->getSum());
    }
}
