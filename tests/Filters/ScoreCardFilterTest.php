<?php

declare(strict_types=1);

namespace App\Filters;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use App\Filters\ScoreCardFilter;

/**
 * Test cases for the controller Debug.
 */
class ScoreCardFilterTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateDiceClass()
    {
        $scf = new ScoreCardFilter();
        $this->assertInstanceOf("\App\Filters\ScoreCardFilter", $scf);
        $filters = $scf->getFilters();
        $this->assertIsArray($filters);
        $this->assertInstanceOf("Twig\TwigFilter", $filters[0]);
    }

    public function testFormatScore()
    {
        $scf = new ScoreCardFilter();
        $this->assertEquals($scf->formatScore(0), "");
        $this->assertEquals($scf->formatScore(5), 5);
        $this->assertEquals($scf->formatScore(null), null);
    }
}
