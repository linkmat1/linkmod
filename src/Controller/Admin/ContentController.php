<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/content")
 * @IsGranted("ROLE_ADMIN")
 */
class ContentController extends AbstractController
{
    private string $adminPath = "admin/";

    /**
     * @Route("/", name="content_index", methods={"GET"})
     * @param ContentRepository $contentRepository
     * @return Response
     */
    public function index(ContentRepository $contentRepository): Response
    {
        return $this->render($this->adminPath .'content/index.html.twig', [
            'contents' => $contentRepository->collectAdminView(),
        ]);
    }

    /**
     * @Route("/new", name="content_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();
            $this->addFlash('success', 'Le contenu a bien été Crée');
            return $this->redirectToRoute('content_index');
        }

        return $this->render($this->adminPath . 'content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{slug<[a-z0-9\-]+>}-{id<\d+>}/edit", name="content_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Content $content
     * @param string $slug
     * @return Response
     */
    public function edit(Request $request, Content $content, string  $slug): Response
    {
        if ($content->getSlug() !== $slug) {
            return $this->redirectToRoute('content_edit', [
                'id' => $content->getId(),
                'slug' => $content->getSlug()
            ], 301);
        }
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le contenu a bien été Modifier');
            return $this->redirectToRoute('content_index');
        }

        return $this->render($this->adminPath . 'content/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="content_delete", methods={"DELETE"})
     * @param Request $request
     * @param Content $content
     * @return Response
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete'.$content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Le contenu a bien été Suprimée');
        return $this->redirectToRoute('content_index');
    }
}
