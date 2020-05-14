<?php

namespace App\Tests\Controller;


use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{


    public function testLoginController()
    {
            $title = "Se connectée";
            $crawler = $this->client->request('GET', '/login');
            $this->assertResponseStatusCodeSame(Response::HTTP_OK);
            $this->assertEquals($title, $crawler->filter('h1')->text());
    }
    public function testRegisterController()
    {
        $title = "Register";
        $crawler = $this->client->request('GET', '/register');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertEquals($title, $crawler->filter('h1')->text());
    }

}
