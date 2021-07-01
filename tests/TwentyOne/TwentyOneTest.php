<?php

declare(strict_types=1);

namespace App\TwentyOne;

use App\TwentyOne\TwentyOne;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for the controller Debug.
 */
class TwentyOneTest extends TestCase
{
    public function testCreateTwentyOne()
    {
        $two = new TwentyOne(2, 6);
        $two->addPlayer("John");
        $two->addPlayer("Jane");
        $two->newRound();
        $this->assertEquals(2, count($two->getPlayers()));
    }

    public function testThrow()
    {
        $two = new TwentyOne(2, 6);
        $two->addPlayer("John");
        $two->addPlayer("Jane");
        $two->newRound();
        $two->throwDices(0);
        $this->assertGreaterThanOrEqual(1, $two->getScoreCard()->getScore(0));
    }
}
