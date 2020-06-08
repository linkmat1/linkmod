<?php

namespace App\Http\Controller\Admin\Core;


use App\Domain\Blog\Entity\Post;
use App\Http\Data\Blog\PostCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/blog", name="admin_")
 */
class PostController extends CrudController {

    protected string $entity = Post::class;
    protected string $templatePath = 'blog';
    protected string $menuItem = 'blog';
    protected string $routePrefix = 'admin_blog';
    protected string $searchField = 'title';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null
    ];
    /**
     * @Route("/", name="blog_index")
     * @return Response
     */
    public function index(): Response{

        return $this->crudIndex();
    }

    /**
     * @Route("/new", name="blog_new", methods={"POST", "GET"})
     * @return Response
     */
    public function new(): Response
    {
        $post = new Post();
        $data = new PostCrudData($post);
         return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="blog_edit", methods={"POST", "GET"})
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post): Response
    {
        $data = new PostCrudData($post);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param Post $post
     * @return Response
     */
    public function delete(Post $post): Response {
        return $this->crudDelete($post, 'admin_blog_index');
    }

}