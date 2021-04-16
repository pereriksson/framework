<?php

namespace App\TwentyOne;

class ScoreCard
{
    private $score = [];

    public function setScore($player, $score)
    {
        $this->score[$player] = $score;
    }

    public function resetScore()
    {
        $this->score = [];
    }

    public function getScore($player)
    {
        if (!isset($this->score[$player])) {
            return 0;
        }

        return $this->score[$player];
    }
}
