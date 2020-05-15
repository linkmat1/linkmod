<?php

namespace App\Controller\Admin\Users;

use App\Controller\Admin\Core\CrudController;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/settings/users")
 */
class UserController extends CrudController
{



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
