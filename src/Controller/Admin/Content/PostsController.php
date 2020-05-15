<?php

namespace App\Controller\Admin\Content;

use App\Controller\Admin\Core\CrudController;
use App\Core\Data\PostCrudData;
use App\Core\Helper\Cloner\BlogCloner;
use App\Entity\Posts;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/admin/blog", name="posts")
 * @IsGranted("ROLE_ADMIN")
 */
class PostsController extends CrudController
{

    protected string $entity = Posts::class;
    protected string $templatePath = 'blog';
    protected string $menuItem = 'blog';
    protected string $routePrefix = 'posts';
    protected string $searchField = 'title';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null,
    ];

    /**
     * @Route("/", name="_index", methods={"GET"})
     */
    public function index(): Response
    {
        return  $this->crudIndex();
    }

    /**
     * @Route("/new", name="_new", methods={"GET","POST"})

     */
    public function new(): Response
    {
        $entity = (new Posts())->setAuthor($this->getUser())->setCreatedAt(new \DateTime());
        $data = new PostCrudData($entity);
        return  $this->crudNew($data);
    }

    /**
     * @Route("/{id}/edit", name="_edit", methods={"GET","POST"})
     * @param Posts $post
     * @return Response
     */
    public function edit(Posts $post): Response
    {
        $this->denyAccessUnlessGranted('edit', $post);
        $data = (new PostCrudData($post))->setEntityManager($this->em);

        return $this->crudEdit($data);



    }

    /**
     * @Route("/{id}", name="_delete", methods="DELETE")
     * @param Posts $post
     * @return Response
     */
    public function delete(Posts $post): Response
    {
        return $this->crudDelete($post);
    }

    /**
     * @Route("/{id}/clone", name="_clone", methods={"GET","POST"})
     * @param Posts $posts
     * @return Response
     */
    public function clone(Posts $posts): Response
    {

        $posts = BlogCloner::clone($posts);
        $data = new PostCrudData($posts);
        return $this->crudNew($data);
    }
    
}
