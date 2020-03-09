<?php

namespace App\Controller\Admin\Forums;

use App\Entity\Forums\ForumForums;
use App\Form\Forums\ForumForumsType;
use App\Repository\Forums\ForumForumsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forums/forum/forums")
 */
class ForumForumsController extends AbstractController
{
    /**
     * @Route("/", name="forums_forum_forums_index", methods={"GET"})
     * @param ForumForumsRepository $forumForumsRepository
     * @return Response
     */
    public function index(ForumForumsRepository $forumForumsRepository): Response
    {

        return $this->render('forums/forum_forums/index.html.twig', [
            'forum_forums' => $forumForumsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forums_forum_forums_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $forumForum = new ForumForums();
        $form = $this->createForm(ForumForumsType::class, $forumForum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forumForum);
            $entityManager->flush();

            return $this->redirectToRoute('forums_forum_forums_index');
        }

        return $this->render('forums/forum_forums/new.html.twig', [
            'forum_forum' => $forumForum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forums_forum_forums_show", methods={"GET"})
     * @param ForumForums $forumForum
     * @return Response
     */
    public function show(ForumForums $forumForum): Response
    {
        return $this->render('forums/forum_forums/show.html.twig', [
            'forum_forum' => $forumForum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forums_forum_forums_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ForumForums $forumForum
     * @return Response
     */
    public function edit(Request $request, ForumForums $forumForum): Response
    {
        $form = $this->createForm(ForumForumsType::class, $forumForum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forums_forum_forums_index');
        }

        return $this->render('forums/forum_forums/edit.html.twig', [
            'forum_forum' => $forumForum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="forums_forum_forums_delete", methods={"DELETE"})
     * @param Request $request
     * @param ForumForums $forumForum
     * @return Response
     */
    public function delete(Request $request, ForumForums $forumForum): Response
    {
        if ($this->isCsrfTokenValid('delete' . $forumForum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forumForum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('forums_forum_forums_index');
    }
}
