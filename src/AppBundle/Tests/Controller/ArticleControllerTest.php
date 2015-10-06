<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{

    public function setUp()
    {

        $this->client = static::createClient();
    }

    public function testGetArticlesStatusCodeAction()
    {

        $this->client->request('GET', sprintf('/articles.json'), array('ACCEPT' => 'application/json'));
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), $this->client->getResponse()->getContent());

    }

}
