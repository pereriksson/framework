<?php

declare(strict_types=1);

namespace pereriksson\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for the controller Debug.
 */
class TwentyOneControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request("GET", "/twentyone");
        $this->assertSelectorTextContains("h1", "Tjugoett");
    }
}
