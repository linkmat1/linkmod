<?php

namespace App\Controller\Admin\Core;

use App\Core\Data\GroupeCrudData;
use App\Entity\Groupes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Permet la gestion des tags sur le forum.
 *
 * @Route("/admin", name="admin_")
 */
final class GroupeController extends CrudController
{
    protected string $templatePath = 'user/groupe';
    protected string $menuItem = 'user';
    protected string $entity = Groupes::class;
    protected string $searchField = 'name';
    protected string $routePrefix = 'admin_groupe';

    /**
     * @Route("/user/groupe", name="groupe_index")
     */
    public function index(): Response
    {
        $entity = (new Groupes())->setAuthor($this->getUser())->setCreatedAt(new \DateTime());
        $data = new GroupeCrudData($entity);

        return  $this->crudNew($data);
    }

    /**
     * @Route("/user/groupe/new", name="groupe_new")
     */
    public function new(): Response
    {
        $group = (new Groupes())->setCreatedAt(new \DateTime());
        $data = (new GroupeCrudData($group))->setEntityManager($this->em);

        return $this->crudNew($data);
    }

    /**
     * @Route("/user/groupe/{id<\d+>}", name="groupe_edit", methods={"POST", "GET"})
     * @param Groupes $groupes
     * @return Response
     */
    public function edit(Groupes $groupes): Response
    {
        $update = $groupes->setUpdatedAt(new \DateTime());
        $data = (new GroupeCrudData($update))->setEntityManager($this->em);

        return $this->crudEdit($data);
    }

    /**
     * @Route("/user/groupe/{id}", methods={"DELETE"})
     * @param Request $request
     * @param Groupes $groupes
     * @return Response
     */
    public function delete(Request $request, Groupes $groupes): Response
    {
        return $this->crudDelete($groupes);
    }
}
