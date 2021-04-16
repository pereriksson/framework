<?php

namespace App\Dice;

class DiceHand
{
    private $dices = [];

    public function __construct(int $numberOfDices, int $numberOfFaces)
    {
        for ($i = 0; $i < $numberOfDices; $i++) {
            $this->dices[] = new Dice($numberOfFaces);
        }
    }

    public function keepDice(string $uniqid)
    {
        foreach ($this->dices as $dice) {
            if ($dice->getId() === $uniqid) {
                $dice->setKept(true);
                break;
            }
        }
    }

    public function resetHand()
    {
        foreach ($this->dices as $dice) {
            $dice->resetValue();
            $dice->setKept(false);
        }
    }

    public function throwDices()
    {
        foreach ($this->dices as $dice) {
            $dice->throw();
        }
    }

    /**
     * @return array
     */
    public function getDices(): array
    {
        return $this->dices;
    }

    public function getDiceValues()
    {
        $diceValues = [];

        foreach ($this->dices as $dice) {
            $diceValues[$dice->getId()] = $dice->getValue();
        }

        return $diceValues;
    }

    public function getDiceSum()
    {
        $diceSum = 0;

        foreach ($this->dices as $dice) {
            $diceSum += $dice->getValue();
        }

        return $diceSum;
    }
}
