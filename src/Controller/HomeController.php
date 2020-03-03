<?php

namespace App\Controller;

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
        $rows =  $posts->findAll();

        return $this->render('home/index.html.twig', [
            'rows' => $rows
        ]);
    }
}
