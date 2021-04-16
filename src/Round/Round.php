<?php

namespace App\Round;

use App\Player\Player;

class Round
{
    private $winner;

    /**
     * @param Player $winner
     */
    public function setWinner(?Player $winner)
    {
        $this->winner = $winner;
    }

    /**
     * @return Player
     */
    public function getWinner(): ?Player
    {
        return $this->winner;
    }
}
