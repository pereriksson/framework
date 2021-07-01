<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class DiceHandTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateDiceClass()
    {
        $numberOfFaces = 6;
        $numberOfDices = 2;
        $diceHand = new DiceHand($numberOfDices, $numberOfFaces);
        $this->assertInstanceOf("\App\Dice\DiceHand", $diceHand);
    }

    public function testGetDiceValues()
    {
        $numberOfFaces = 6;
        $numberOfDices = 2;
        $diceHand = new DiceHand($numberOfDices, $numberOfFaces);
        $diceHand->throwDices();
        $this->assertEquals(count($diceHand->getDiceValues()), $numberOfDices);
        $diceSum = array_sum($diceHand->getDiceValues());
        $this->assertEquals($diceHand->getDiceSum(), $diceSum);
    }
}
