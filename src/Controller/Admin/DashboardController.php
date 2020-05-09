<?php

namespace App\Controller\Admin;


use App\Controller\Admin\Core\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends BaseController
{

    /**
     * @Route("/", name="admin_dashboard", methods={"GET"})
*/
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [

        ]);
    }






}
