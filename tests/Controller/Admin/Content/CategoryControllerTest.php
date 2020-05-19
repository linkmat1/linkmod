<?php

namespace App\Tests\Controller\Admin\Content;

use App\Tests\FixturesTrait;
use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class CategoryControllerTest extends WebTestCase
{
    use FixturesTrait;


    public function testGetGoodTitle(){
        $users = $this->loadFixtures(['users']);
        $this->login($users['user_admin']);
        $this->client->request('GET', '/admin/blog/category/');
        $this->expectTitle('Administration Gestion des Category');
    }
    public function testIfAccessNotGranted() {
        $users = $this->loadFixtures(['users']);
        $this->login($users['user_admin1']);
        $this->client->request('GET', '/admin/blog/category/');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        }
    public function testIfAccessIsGranted() {
        $users = $this->loadFixtures(['users']);
        $this->login($users['user_admin']);
        $this->client->request('GET', '/admin/blog/category/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

}