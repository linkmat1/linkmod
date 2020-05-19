<?php

namespace App\Core\Data;

use App\Entity\Category;
use App\Entity\Core\Settings;
use App\Entity\User;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Validator\Constraints as Assert;

final class WebsiteOnlineCrudData implements CrudDataInterface
{


    public ?bool $online = false;
    private ?EntityManagerInterface $em = null;
    private Settings $entity;
    public function __construct(Settings $settings)
    {
        $this->entity = $settings;
        $this->online = $settings->getOnline();

    }

    public function hydrate(): void
    {
        $this->entity
            ->setOnline($this->online);

    }

    public function getFormClass(): string
    {
        return AutomaticForm::class;
    }


    public function getEntity(): Settings
    {
        return $this->entity;
    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}
