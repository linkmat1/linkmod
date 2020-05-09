<?php

namespace App\Core\Data;

use App\Entity\Forums\Tag;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * @property Tag $entity
 */
final class TagCrudData extends AutomaticCrudData
{

    public ?int $id = null;
    /**
     * @Assert\NotBlank()
     */
    public ?string $name = null;

    public ?\DateTimeInterface $createdAt;

    public ?\DateTimeInterface $updatedAt = null;

    public ?Tag $parent;

    public ?string $color = null;

    public ?string $description = null;

    public ?int $position = null;

    public function hydrate(): void
    {
        parent::hydrate();
        $this->entity->setUpdatedAt(new \DateTime());

    }
}