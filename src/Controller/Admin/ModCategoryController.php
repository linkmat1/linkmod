<?php

namespace App\Controller\Admin;

use App\Entity\ModCategory;
use App\Form\ModCategoryType;
use App\Repository\ModCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/superadmin/mods/category")
 *@IsGranted("ROLE_ADMIN")
 */
class ModCategoryController extends AbstractController
{
    /**
     * @Route("/", name="mod_category_index", methods={"GET"})
     * @param ModCategoryRepository $modCategoryRepository
     * @return Response
     */
    public function index(ModCategoryRepository $modCategoryRepository): Response
    {
        return $this->render('mod_category/index.html.twig', [
            'mod_categories' => $modCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mod_category_new", methods={"GET","POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $modCategory = new ModCategory();
        $form = $this->createForm(ModCategoryType::class, $modCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modCategory);
            $entityManager->flush();


            return $this->redirectToRoute('mod_category_index');

        }

        return $this->render('mod_category/new.html.twig', [
            'mod_category' => $modCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mod_category_show", methods={"GET"})
     * @param ModCategory $modCategory
     * @return Response
     */
    public function show(ModCategory $modCategory): Response
    {
        return $this->render('mod_category/show.html.twig', [
            'mod_category' => $modCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mod_category_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ModCategory $modCategory
     * @return Response
     */
    public function edit(Request $request, ModCategory $modCategory): Response
    {
        $form = $this->createForm(ModCategoryType::class, $modCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mod_category_index');
        }

        return $this->render('mod_category/edit.html.twig', [
            'mod_category' => $modCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mod_category_delete", methods={"DELETE"})
     * @param Request $request
     * @param ModCategory $modCategory
     * @return Response
     */
    public function delete(Request $request, ModCategory $modCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mod_category_index');
    }
}
