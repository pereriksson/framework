<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

const TEST_GRAPHICAL_REPRESENTATIONS = [
    1 => "\2680",
    2 => "\2681",
    3 => "\2682",
    4 => "\2683",
    5 => "\2684",
    6 => "\2685",
];

/**
 * Test cases for the controller Debug.
 */
class GraphicalDiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateDiceClass()
    {
        $numberOfFaces = 6;
        $dice = new GraphicalDice($numberOfFaces);
        $this->assertInstanceOf("\App\Dice\Dice", $dice);
    }

    public function testKept()
    {
        $numberOfFaces = 6;
        $dice = new GraphicalDice($numberOfFaces);
        $dice->setKept(true);
        $this->assertEquals(true, $dice->getKept());
    }

    public function testThrow()
    {
        $numberOfFaces = 6;
        $dice = new GraphicalDice($numberOfFaces);
        $dice->throw();
        $this->assertGreaterThanOrEqual(1, $dice->getValue());
        $this->assertLessThanOrEqual($numberOfFaces, $dice->getValue());
    }

    public function testResetValue()
    {
        $numberOfFaces = 6;
        $dice = new GraphicalDice($numberOfFaces);
        $this->assertEquals($dice->getValue(), null);
        $dice->resetValue();
        $this->assertEquals($dice->getValue(), null);
    }

    public function testGraphicalRepresentation()
    {
        $numberOfFaces = 6;
        $dice = new GraphicalDice($numberOfFaces);
        $dice->throw();
        $this->assertEquals($dice->getGraphicalRepresentation(), TEST_GRAPHICAL_REPRESENTATIONS[$dice->getValue()]);
    }
}
