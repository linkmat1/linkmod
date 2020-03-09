<?php

namespace App\Controller;

use App\Entity\Content;
use App\Repository\ContentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var ContentRepository
     */
    private ContentRepository $em;
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    /**
     * HomeController constructor.
     * @param ContentRepository $em
     * @param PaginatorInterface $paginator
     */
    public function __construct(ContentRepository $em, PaginatorInterface $paginator)
    {

        $this->em = $em;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="home", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function homepage(Request $request): Response
    {
        $query = $this->em->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC');
        $page = $request->query->getInt('page', 1);
        $contents = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            2
        );

        return $this->render('home/index.html.twig', [
            'contents' => $contents,
            'page' => $page
        ]);
    }

    private function getPaginate(Request $request)
    {

    }

}
