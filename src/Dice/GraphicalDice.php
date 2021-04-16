<?php

namespace App\Dice;

const GRAPHICAL_REPRESENTATIONS = [
    1 => "\2680",
    2 => "\2681",
    3 => "\2682",
    4 => "\2683",
    5 => "\2684",
    6 => "\2685",
];

class GraphicalDice extends Dice
{

    public function __construct()
    {
        parent::__construct(6);
    }

    public function getGraphicalRepresentation()
    {
        return GRAPHICAL_REPRESENTATIONS[$this->getValue()];
    }
}
