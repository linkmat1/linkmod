<?php

namespace App\Controller\Admin\Content;

use App\Controller\Admin\Core\BaseController;
use App\Controller\Admin\Core\CrudController;
use App\Core\Data\PostCrudData;
use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\PostsRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/blog", name="posts")
 */
class PostsController extends CrudController
{
    /**
     * @var class-string<E> $entity
     */
    protected string $entity = Posts::class;
    protected string $templatePath = 'blog';
    protected string $menuItem = 'blog';
    protected string $routePrefix = 'posts';
    //protected string $searchField = 'title';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null
    ];
    /**
     * @Route("/", name="_index", methods={"GET"})
     * @param PostsRepository $postsRepository
     * @return Response
     */
    public function index(PostsRepository $postsRepository): Response
    {
       return  $this->crudIndex();
    }

    /**
     * @Route("/new", name="_new", methods={"GET","POST"})
 */
    public function new(): Response
    {
        $data = new PostCrudData();
        $data->author = $this->getUser();
        $data->entity = new Posts();

       return  $this->crudNew($data);
    }



    /**
     * @Route("/{id}/edit", name="_edit", methods={"GET","POST"})
     * @param Posts $post
     * @return Response
     */
    public function edit( Posts $post): Response
    {
        $data = PostCrudData::makeFromPost($post);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}", name="_delete", methods={"DELETE"})
      * @param Posts $post
     * @return Response
     */
    public function delete(Posts $post): Response
    {

        return $this->crudDelete($post);
    }

}
