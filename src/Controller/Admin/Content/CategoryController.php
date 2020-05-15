<?php

namespace App\Controller\Admin\Content;

use App\Controller\Admin\Core\CrudController;
use App\Core\Data\CategoryCrudData;
use App\Entity\Category;
use App\Security\Voter\CategoryVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/admin/settings/blog/category", name="category")
 * @IsGranted("ROLE_MANAGE")
 */
class CategoryController extends CrudController
{

    protected string $entity = Category::class;
    protected string $templatePath = 'category';
    protected string $menuItem = 'blog';
    protected string $routePrefix = 'category';
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
        $entity = (new Category())->setAuthor($this->getUser())->setCreatedAt(new \DateTime());
        $data = new CategoryCrudData($entity);
        return  $this->crudNew($data);
    }

    /**
     * @Route("/{id}/edit", name="_edit", methods={"GET","POST"})
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category): Response
    {
        $data = (new CategoryCrudData($category))->setEntityManager($this->em);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}", name="_delete", methods="DELETE")
     * @param Category $category
     * @return Response
     */
    public function delete(Category $category): Response
    {
        return $this->crudDelete($category);
    }

}
