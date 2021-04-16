<?php

namespace App\Filters;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ScoreCardFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('score', [$this, 'formatScore']),
        ];
    }

    public function formatScore($number)
    {
        return $number !== 0 ? $number : "";
    }
}
