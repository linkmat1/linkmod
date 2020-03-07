<?php

namespace App\Controller\Admin;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    private string $adminPath = 'admin/';
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $cr;

    public function __construct(CategoryRepository $cr)
    {
        $this->cr = $cr;
    }

    /**
     * @Route("/", name="admin_dashboard", methods={"GET"})
     */
    public function index(): Response
    {
        $count = $this->cr->countCategory();

        return $this->render($this->adminPath.'dashboard.html.twig', [
            'count' => $count,
        ]);
    }
}
