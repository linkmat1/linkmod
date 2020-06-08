<?php

namespace App\Http\Controller\Admin\Core;


use App\Domain\Blog\Entity\Category;
use App\Http\Data\Blog\CategoryCrudData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/blog/category", name="admin_blog_")
 */
class CategoryController extends CrudController {

    protected string $entity = Category::class;
    protected string $templatePath = 'category';
    protected string $menuItem = 'category';
    protected string $routePrefix = 'admin_blog_category';
    protected string $searchField = 'title';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null
    ];
    /**
     * @Route("/", name="category_index")
     * @return Response
     */
    public function index(): Response{

        return $this->crudIndex();
    }

    /**
     * @Route("/new", name="category_new", methods={"POST", "GET"})
     * @return Response
     */
    public function new(): Response
    {
        $category = new Category();
        $data = new CategoryCrudData($category);
        return $this->crudNew($data);
    }

    /**
     * @Route("/{id}", name="category_edit", methods={"POST", "GET"})
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category): Response
    {
        $data = new CategoryCrudData($category);
        return $this->crudEdit($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param Category $category
     * @return Response
     */
    public function delete(Category $category): Response {
        return $this->crudDelete($category, 'admin_blog_index');
    }

}