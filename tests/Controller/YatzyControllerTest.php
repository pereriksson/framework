<?php

declare(strict_types=1);

namespace App\Controllers;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for the controller Debug.
 */
class YatzyControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request("GET", "/yatzy");
        $this->assertSelectorTextContains("h1", "Yatzy");
    }

    public function testLeave()
    {
        $client = static::createClient();
        $client->request("GET", "/yatzy");
        $client->submitForm('Starta spelet');
        $client->request("GET", "/yatzy");
        $client->submitForm('Avsluta spelet');
        $client->request("GET", "/yatzy");
        $this->assertSelectorNotExists("h2");
    }

    public function testStart()
    {
        $client = static::createClient();
        $client->request("GET", "/yatzy");
        $client->submitForm('Starta spelet');
        $client->request("GET", "/yatzy");
        $this->assertSelectorTextContains("h2", "Nuvarande rond");
    }
}
