<?php

namespace App\Tests\Controller\Admin\Content;


use App\Tests\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PostsControllerTest extends WebTestCase
{


     public function testGetBlogCrudWithoutLogin(){
        $this->client->request('GET', '/admin/blog');

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}