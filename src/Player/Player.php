<?php

namespace App\Player;

use App\Dice\DiceHand;

const PLAYER_PLAYING = 0;

class Player
{
    private $diceHand;
    private $name;
    private $status = PLAYER_PLAYING;

    public function __construct(DiceHand $diceHand, string $name)
    {
        $this->diceHand = $diceHand;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function throwDices()
    {
        $this->diceHand->throwDices();
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
