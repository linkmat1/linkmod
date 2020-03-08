<?php

namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
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
