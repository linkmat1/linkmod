<?php

namespace App\Controller\Admin\Users;

use App\Controller\Admin\Core\CrudController;
use App\Core\Data\UserCrudData;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/settings/users",name="admin_user")
 * @IsGranted("ROLE_MANAGE")
 */
class UserController extends CrudController
{

    protected string $entity = User::class;
    protected string $templatePath = 'user';
    protected string $menuItem = 'users';
    protected string $routePrefix = 'admin_user';
    protected string $searchField = 'username';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null,
    ];

    /**
     * @Route("/", name="_index", methods={"GET"})
     * @param UserRepository $repository
     * @return Response
     */
    public function index(UserRepository $repository): Response
    {
        $this->paginator->allowSort('count', 'row.id', 'row.username', 'row.term', 'row.email');
        $query = $repository
            ->createQueryBuilder('row')
            ->orderBy('row.acceptedAt', 'DESC');
        return  $this->crudIndex($query);
    }

    /**
     * @Route("/{id}/edit", name="_edit", methods={"GET","POST"})
     * @param User $user
     * @return Response
     */
    public function edit(User $user): Response
    {
        $data = (new UserCrudData($user))->setEntityManager($this->em);
        return $this->crudEdit($data);
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
