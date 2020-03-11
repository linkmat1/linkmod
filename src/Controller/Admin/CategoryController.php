<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Helper\UserHelperTrait;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/category")
 */
class CategoryController extends AbstractController
{
    use UserHelperTrait;
    private string $adminPath = 'admin/';
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $em;
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(CategoryRepository $em, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="category_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $query = $this->em->createQueryBuilder('cc')
            ->orderBy('cc.id', 'DESC');
        if ($request->get('q')) {
            $query = $query->where('cc.title LIKE :title')
                ->setParameter('title', "%" . $request->get('q') . "%");
        }
        $page = $request->query->getInt('page', 1);
        $categories = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );
        return $this->render($this->adminPath . 'category/index.html.twig', [
            'categories' => $categories,
            'page' => $page
        ]);
    }

    /**
     * @Route("/new", name="category_new", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setCreatedBy($this->getCurrentUser());
            $category->setCreatedAt($this->getCurrentDate());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Le contenu a bien été modifié');

            return $this->redirectToRoute('category_index');
        }

        return $this->render($this->adminPath.'category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug<[a-z0-9\-]+>}-{id<\d+>}/edit", name="category_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Category $category
     * @param string $slug
     * @return Response
     */
    public function edit(Request $request, Category $category, string $slug): Response
    {
        if ($category->getSlug() !== $slug) {
            return $this->redirectToRoute('category_edit', [
                'id' => $category->getId(),
                'slug' => $category->getSlug(),
            ], 301);
        }
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setUpdatedAt($this->getCurrentDate());
            $category->setCreatedBy($this->getCurrentUser());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_index');
        }

        return $this->render($this->adminPath.'category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="category_delete", methods={"DELETE"})
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index');
    }
}
