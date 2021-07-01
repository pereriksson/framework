<?php

declare(strict_types=1);

namespace App\TwentyOne;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the controller Debug.
 */
class ScoreCardTest extends TestCase
{
    public function testCreateScoreCard()
    {
        $scc = new ScoreCard();
        $scc->setScore(0, 10);
        $this->assertEquals(10, $scc->getScore(0));
        $this->assertEquals(0, $scc->getScore(1));
        $scc->resetScore();
        $this->assertEquals(0, $scc->getScore(0));
    }
}
