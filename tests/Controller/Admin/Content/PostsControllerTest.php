<?php

namespace App\Tests\Controller\Admin\Content;

use App\Entity\Posts;
use App\Entity\User;
use App\Tests\FixturesTrait;
use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class PostsControllerTest extends WebTestCase
{
    use FixturesTrait;

   public function testAdminAccessIfManage(): void
    {
        $users = $this->loadFixtures(['users']);
        $this->login($users['user_admin']);
        $this->client->request('GET', '/admin/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testAdminAccessIfAdmin(): void
    {
        $users = $this->loadFixtures(['users']);
        $this->login($users['user_admin']);
        $this->client->request('GET', '/admin/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testAdminAccessDenied(): void
    {
        $users = $this->loadFixtures(['users']);
        $this->login($users['user1']);
        $this->client->request('GET', '/admin/');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
    public function testGetGoodTitle(){
        $users = $this->loadFixtures(['users']);
        $this->login($users['user_admin']);
        $this->client->request('GET', '/admin/blog/');
        $this->expectTitle('Administration Gestion du blog');
    }
    public function testGetContent(){
        $post2 = $this->loadFixtures(['posts']);
        self::bootKernel();
        $this->assertCount(2, $post2);
    }
}