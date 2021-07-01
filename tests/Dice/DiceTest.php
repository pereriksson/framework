<?php

declare(strict_types=1);

namespace App\Dice;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Debug.
 */
class DiceTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateDiceClass()
    {
        $numberOfFaces = 6;
        $dice = new Dice($numberOfFaces);
        $this->assertInstanceOf("\App\Dice\Dice", $dice);
    }

    public function testKept()
    {
        $numberOfFaces = 6;
        $dice = new Dice($numberOfFaces);
        $dice->setKept(true);
        $this->assertEquals(true, $dice->getKept());
    }

    public function testThrow()
    {
        $numberOfFaces = 6;
        $dice = new Dice($numberOfFaces);
        $dice->throw();
        $this->assertGreaterThanOrEqual(1, $dice->getValue());
        $this->assertLessThanOrEqual($numberOfFaces, $dice->getValue());
    }

    public function testResetValue()
    {
        $numberOfFaces = 6;
        $dice = new Dice($numberOfFaces);
        $this->assertEquals($dice->getValue(), null);
        $dice->resetValue();
        $this->assertEquals($dice->getValue(), null);
    }
}
