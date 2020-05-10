<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Core\BaseController;
use App\Repository\Forums\TopicRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends BaseController
{
    /**
     * @Route("/", name="admin_dashboard", methods={"GET"})
     * @param TopicRepository $topicRepository
     * @return Response
     */
    public function index(TopicRepository $topicRepository): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'topic' => $topicRepository->countTopic(),
        ]);
    }
}
