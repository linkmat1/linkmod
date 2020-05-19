<?php

namespace App\Controller;

use App\Repository\Forums\TagRepository;
use App\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @var SettingsRepository
     */
    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * @Route("/", name="app_home", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function homepage(Request $request): Response
    {

        return $this->render('home/index.html.twig', [
            'website' => $this->settingsRepository->find(1)
        ]);
    }
}
