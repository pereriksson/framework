<?php

namespace App\Yatzy;

use pereriksson\Player\Player;

/**
 * A score card for a player.
 */
class ScoreCard
{
    private $player;
    private $score;

    public function __construct($player)
    {
        $this->player = $player;
        $this->score = [];
    }

    /**
     * @return object The player of the scorecard.
     */
    public function getPlayer(): object
    {
        return $this->player;
    }

    /**
     * The the sum of ones through sixes (see above).
     * @return int
     */
    public function getSum(): int
    {
        return $this->getOnes() +
            $this->getTwos() +
            $this->getThrees() +
            $this->getFours() +
            $this->getFives() +
            $this->getSixes();
    }

    public function getBonus(): int
    {
        if ($this->getSum() >= 63) {
            return 50;
        }

        return 0;
    }

    public function getTotalScore(): int
    {
        return $this->getSum() +
            $this->score["bonus"] +
            $this->score["onePair"] +
            $this->score["twoPairs"] +
            $this->score["threeNumbers"] +
            $this->score["fourNumbers"] +
            $this->score["smallLadder"] +
            $this->score["bigLadder"] +
            $this->score["house"] +
            $this->score["chance"] +
            $this->score["yatzy"];
    }

    private function calculateBonus()
    {
        if ($this->getSum() >= 63) {
            $this->score["bonus"] = 50;
        }
    }

    /**
     * @param int $ones
     */
    public function setOnes(int $ones): void
    {
        $this->score["ones"] = $ones;
        $this->calculateBonus();
    }

    /**
     * @param int $twos
     */
    public function setTwos(int $twos): void
    {
        $this->score["twos"] = $twos;
        $this->calculateBonus();
    }

    /**
     * @param int $threes
     */
    public function setThrees(int $threes): void
    {
        $this->score["threes"] = $threes;
        $this->calculateBonus();
    }

    /**
     * @param int $fours
     */
    public function setFours(int $fours): void
    {
        $this->score["fours"] = $fours;
        $this->calculateBonus();
    }

    /**
     * @param int $fives
     */
    public function setFives(int $fives): void
    {
        $this->score["fives"] = $fives;
        $this->calculateBonus();
    }

    /**
     * @param int $sixes
     */
    public function setSixes(int $sixes): void
    {
        $this->score["sixes"] = $sixes;
        $this->calculateBonus();
    }

    /**
     * @return int
     */
    public function getOnes()
    {
        return $this->score["ones"] ?? null;
    }

    /**
     * @return int
     */
    public function getTwos()
    {
        return $this->score["twos"] ?? null;
    }

    /**
     * @return int
     */
    public function getThrees()
    {
        return $this->score["threes"] ?? null;
    }

    /**
     * @return int
     */
    public function getFours()
    {
        return $this->score["fours"] ?? null;
    }

    /**
     * @return int
     */
    public function getFives()
    {
        return $this->score["fives"] ?? null;
    }

    /**
     * @return int
     */
    public function getSixes()
    {
        return $this->score["sixes"] ?? null;
    }
}
