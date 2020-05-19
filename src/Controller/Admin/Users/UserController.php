<?php

namespace App\Controller\Admin\Users;

use App\Controller\Admin\Core\CrudController;
use App\Core\Data\UserCrudData;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class UserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {

        $this->manager = $manager;
    }
    /**
     * @Route("/users/search/{q?}", name="admin_user_autocomplete")
     * @param string $q
     * @return JsonResponse
     */
    public function search(string $q): JsonResponse
    {
        /** @var UserRepository $repository */
        $repository = $this->manager->getRepository(User::class);
        $q = strtolower($q);
        $users = $repository
            ->createQueryBuilder('u')
            ->select('u.id', 'u.username')
            ->where('LOWER(u.username) LIKE :username')
            ->setParameter('username', "%$q%")
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();
        return new JsonResponse($users);
    }
}
