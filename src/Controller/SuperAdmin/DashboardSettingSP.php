<?php

namespace App\Controller\SuperAdmin;

;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/superadmin")
 *@IsGranted("ROLE_ADMIN")
 */
class DashboardSettingSP extends AbstractController
{

    /**
     * @Route("/", name="superadmin_index", methods={"GET"})
     */
    public function index():Response
    {
        return $this->render('home/index.html.twig');
    }
}
