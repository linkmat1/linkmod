<?php

namespace App\Controller\Admin;

use App\Entity\Content;
use App\Form\ApprouveType;
use App\Form\ContentType;
use App\Repository\CategoryRepository;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @var ContentRepository
     */
    private ContentRepository $content;


    public function __construct(CategoryRepository $cr,ContentRepository $content)
    {
        $this->cr = $cr;

        $this->content = $content;
    }

    /**
     * @Route("/", name="admin_dashboard", methods={"GET"})
     */
    public function index(): Response
    {
        $count = $this->cr->countCategory();
        $count2 = $this->content->CountContentToBeApprouved();
        $countContent = $this->content->CountContent();

        $toApps =  $this->content->getContentToApprouve();
        return $this->render($this->adminPath.'dashboard.html.twig', [
            'count' => $count,
            'approuves' => $toApps,
            'count2' => $count2,
            'countContent' => $countContent

        ]);
    }




}
