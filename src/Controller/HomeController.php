<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PostRepository $posts
     * @return Response
     */
    public function index(PostRepository $posts): Response
    {
        return $this->render('home/index.html.twig', [
            'rows' => $posts->findByPublicView()
        ]);
    }

    /**
     * @Route("/mods/{slug<[a-z0-9\-]+>}-{id<\d+>}", name="mods_show")
     * @param Post $post
     * @param string $slug
     * @return Response
     */
    public function showMods(Post $post, string $slug): Response
    {
        if($post->getSlug() !==  $slug)
        {
        return $this->redirectToRoute('mods_show', [
            'id' => $post->getId(),
            'slug' => $post->getSlug()
        ], 301);
        }
        return $this->render('admin/post/show.html.twig', [
            'post' => $post,
        ]);

    }
}
