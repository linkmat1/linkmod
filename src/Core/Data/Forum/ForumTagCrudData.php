<?php

namespace App\Core\Data\Forum;

use App\Core\Data\AutomaticCrudData;
use App\Domain\Forums\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Tag $entity
 * @IsGranted("ROLE_MANAGE")
 */
final class ForumTagCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank()
     */
    public ?string $name = null;
    /**
     * @Assert\NotBlank()
     */
    public ?string $slug = null;

    public ?\DateTimeInterface $createdAt;

    public ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Tag $parent
     */
    public ?Tag $parent;

    public ?string $color = null;

    public ?string $description = null;

    public ?int $position = null;

    public function hydrate(): void
    {
        parent::hydrate();
        $this->entity
            ->setUpdatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
    }
}
