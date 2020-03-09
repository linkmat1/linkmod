<?php

namespace App\Controller\Admin\Forums;

use App\Entity\Forums\ForumCategory;
use App\Form\Forums\ForumCategoryType;
use App\Helper\UserHelperTrait;
use App\Repository\Forums\ForumCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/forums/forum/category")
 */
class ForumCategoryController extends AbstractController
{
    use UserHelperTrait;
    private string $adminPath = 'admin/';

    /**
     * @Route("/", name="forums_forum_category_index", methods={"GET"})
     * @param ForumCategoryRepository $forumCategoryRepository
     * @return Response
     */
    public function index(ForumCategoryRepository $forumCategoryRepository): Response
    {

        return $this->render($this->adminPath . 'forums/forum_category/index.html.twig', [
            'forum_categories' => $forumCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forums_forum_category_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $forumCategory = new ForumCategory();
        $form = $this->createForm(ForumCategoryType::class, $forumCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumCategory);
            $entityManager->flush();

            return $this->redirectToRoute('forums_forum_category_index');
        }

        return $this->render($this->adminPath . 'forums/forum_category/new.html.twig', [
            'forum_category' => $forumCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forums_forum_category_show", methods={"GET"})
     */
    public function show(ForumCategory $forumCategory): Response
    {
        return $this->render($this->adminPath . 'forums/forum_category/show.html.twig', [
            'forum_category' => $forumCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forums_forum_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForumCategory $forumCategory): Response
    {
        $form = $this->createForm(ForumCategoryType::class, $forumCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($this->adminPath . 'forums_forum_category_index');
        }

        return $this->render($this->adminPath . 'forums/forum_category/edit.html.twig', [
            'forum_category' => $forumCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forums_forum_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ForumCategory $forumCategory): Response
    {
        if ($this->isCsrfTokenValid('delete' . $forumCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forums_forum_category_index');
    }
}
