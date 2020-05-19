<?php

namespace App\Controller\Admin\Core;


use App\Core\Data\WebsiteOnlineCrudData;
use App\Entity\Core\Settings;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/admin/settings/online", name="setting")
 * @IsGranted("ROLE_MANAGE")
 */
class WebsiteOnline extends CrudController
{

    protected string $entity = Settings::class;
    protected string $templatePath = 'settings';
    protected string $menuItem = 'settings';
    protected string $routePrefix = 'setting';
    protected string $searchField = 'title';
    protected array $events = [
        'update' => null,
        'delete' => null,
        'create' => null,
    ];

      /**
     * @Route("/{id}", name="_edit", methods={"GET","POST"})
     * @param Settings $settings
     * @return Response
     */
    public function edit(Settings $settings): Response
    {

        $data = (new WebsiteOnlineCrudData($settings))->setEntityManager($this->em);

        return $this->crudEdit($data);



    }
    
}
