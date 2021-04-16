<?php

namespace App\Yatzy;

use App\Dice\DiceHand;
use App\Player\Player;
use App\Round\Round;

class Yatzy
{
    const PLAYING = 0;
    const FINISHED = 1;
    const STOPPED = 3;

    private $players;
    private $status = self::PLAYING;
    private $rounds = [];
    private $currentRound;
    private $diceHand;
    private $scoreCards = [];
    private $throwRound = 0;

    public function __construct()
    {
        $this->diceHand = new DiceHand(5, 6);
    }

    /**
     * Add a player and a score card to the game.
     *
     * @param string $name The name of the player.
     */
    public function addPlayer(string $name)
    {
        $player = new Player($this->diceHand, $name);
        $this->players[] = $player;
        $scoreCard = new ScoreCard($player);
        $this->scoreCards[] = $scoreCard;
    }

    public function getScoreCards()
    {
        return $this->scoreCards;
    }

    public function newRound()
    {
        $this->currentRound = new Round();
        $this->status = self::PLAYING;

        foreach ($this->players as $player) {
            $player->setStatus(self::PLAYING);
        }
    }

    /**
     * @return int
     */
    public function getThrowRound(): int
    {
        return $this->throwRound;
    }

    /**
     * @param int $throwRound
     */
    public function setThrowRound(int $throwRound): void
    {
        $this->throwRound = $throwRound;
    }

    public function throwDices(int $player)
    {
        if ($this->throwRound >= 3) {
            return false;
        }

        if (!$this->currentRound) {
            return false;
        }

        // TODO: Move playing status to the Round class?
        if ($this->status !== self::PLAYING) {
            return false;
        }

        if ($this->players[$player]->getStatus() !== self::PLAYING) {
            return false;
        }

        $this->diceHand->throwDices();
        $this->throwRound++;

        $this->finishGame();
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function getPlayers()
    {
        return $this->players;
    }

    public function getDiceHand(): DiceHand
    {
        return $this->diceHand;
    }

    public function finishGame()
    {
        // TODO: To be built.
    }

    public function resetScore()
    {
        $this->newRound();
        $this->diceHand->resetHand();
        $this->rounds = [];
        $this->throwRound = 0;
        $this->scoreCards = [];

        foreach ($this->players as $player) {
            $player->setStatus(self::PLAYING);

            $scoreCard = new ScoreCard($player);
            $this->scoreCards[] = $scoreCard;
        }
    }
}
