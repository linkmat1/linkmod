<?php

namespace App\Controller;

use App\Repository\Forums\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function homepage(Request $request): Response
    {


        return $this->render('home/index.html.twig', [

        ]);
    }


}
