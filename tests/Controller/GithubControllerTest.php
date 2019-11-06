<?php

namespace App\Tests\Controller;

use App\Controller\Github\GithubController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GithubControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame($crawler->filter('title')->text(), 'Testio');
        $this->assertContains('Login With Github', $client->getResponse()->getContent());
    }
}