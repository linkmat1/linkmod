<?php

namespace App\Controller\SuperAdmin;

use App\Entity\ModCategory;
use App\Form\ModCategoryType;
use App\Repository\ModCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/superadmin")
 *@IsGranted("ROLE_ADMIN")
 */
class dashbordSuperAdminController extends AbstractController
{

    /**
     * @Route("/", name="superadmin_index", methods={"GET"})
     */
    public function dashboardSuper():Response
    {
        return $this->render('home/index.html.twig');
    }
}
