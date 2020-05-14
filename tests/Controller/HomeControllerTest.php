<?php

namespace App\Tests\Controller;


use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{


    public function testHomePage()
    {
       // $title = "HOME";
        $this->client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
      //  $this->assertEquals($title, $crawler->filter('h1')->text());
    }
}
