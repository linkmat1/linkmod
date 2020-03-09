<?php


namespace App\Controller\Admin\Forums;


use App\Helper\UserHelperTrait;
use App\Repository\Forums\ForumCategoryRepository;
use App\Repository\Forums\ForumForumsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/forums")
 */
class ForumController extends AbstractController
{
    use UserHelperTrait;
    private string $adminPath = 'admin/';
    /**
     * @var ForumCategoryRepository
     */
    private ForumCategoryRepository $forumCategoryRepository;
    /**
     * @var ForumForumsRepository
     */
    private ForumForumsRepository $forumForumsRepository;


    /**
     * ForumController constructor.
     * @param ForumCategoryRepository $forumCategoryRepository
     * @param ForumForumsRepository $forumForumsRepository
     */
    public function __construct(ForumCategoryRepository $forumCategoryRepository, ForumForumsRepository $forumForumsRepository)
    {
        $this->forumCategoryRepository = $forumCategoryRepository;
        $this->forumForumsRepository = $forumForumsRepository;
    }

    /**
     * @Route("/", name="admin_forum_gestion", methods={"GET"})
     */
    public function getforum()
    {

        // $forums =  $this->forumCategoryRepository->getforumList();


        return $this->render($this->adminPath . 'forums/forum.html.twig', [

        ]);
    }


}