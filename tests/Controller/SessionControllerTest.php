<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for the controller Debug.
 */
class SessionControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();
        $client->request("GET", "/session");
        $this->assertSelectorTextContains("h1", "Session");
    }
}
