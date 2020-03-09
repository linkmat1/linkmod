<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\User2Type;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/users")
 */
class UserController extends AbstractController
{
    private string $adminPath = 'admin/';
    /**
     * @var UserRepository
     */
    private UserRepository $em;
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(UserRepository $em, PaginatorInterface $paginator, EntityManagerInterface $manager)
    {
        $this->em = $em;
        $this->paginator = $paginator;
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="user_index", methods={"GET"})

     * @return Response
     */
    public function index(Request $request): Response
    {
        $query = $this->em->createQueryBuilder('u')
            ->orderBy('u.id', 'DESC');
        if($request->get('q')){
            $query = $query->where('u.username LIKE :username')
                ->setParameter('username', "%" . $request->get('q') . "%");
        }
        $page = $request->query->getInt('page', 1);
        $paginator = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );
        return $this->render($this->adminPath . 'user/index.html.twig', [
            'users' => $paginator
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }
        return $this->render($this->adminPath . 'user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render($this->adminPath . 'user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        $form2 = $this->createForm(User2Type::class, $user);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()){

            $this->getDoctrine()->getManager()->flush();
            return  $this->redirectToRoute('user_index');
        }


        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render($this->adminPath . 'user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'form2' => $form2->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
    /**
     * @Route("/users/search/{q?}", name="admin_user_autocomplete")
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
