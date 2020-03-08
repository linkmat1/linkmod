<?php

namespace App\Controller\Admin;

use App\Entity\Mods;
use App\Form\ModsType;
use App\Repository\ModsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mods")
 */
class ModsController extends AbstractController
{
    private string $adminPath = 'admin/';
    /**
     * @Route("/", name="mods_index", methods={"GET"})
     * @param ModsRepository $modsRepository
     * @return Response
     */
    public function index(ModsRepository $modsRepository): Response
    {
        return $this->render($this->adminPath.'mods/index.html.twig', [
            'mods' => $modsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mods_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $mod = new Mods();
        $form = $this->createForm(ModsType::class, $mod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mod);
            $entityManager->flush();

            return $this->redirectToRoute('mods_index');
        }

        return $this->render($this->adminPath.'mods/new.html.twig', [
            'mod' => $mod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mods_show", methods={"GET"})
     * @param Mods $mod
     * @return Response
     */
    public function show(Mods $mod): Response
    {
        return $this->render($this->adminPath.'mods/show.html.twig', [
            'mod' => $mod,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mods_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Mods $mod
     * @return Response
     */
    public function edit(Request $request, Mods $mod): Response
    {
        $form = $this->createForm(ModsType::class, $mod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mods_index');
        }

        return $this->render($this->adminPath.'mods/edit.html.twig', [
            'mod' => $mod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mods_delete", methods={"DELETE"})
     * @param Request $request
     * @param Mods $mod
     * @return Response
     */
    public function delete(Request $request, Mods $mod): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mod->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mod);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mods_index');
    }
}
