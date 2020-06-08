<?php

namespace App\Http\Data\Blog;

use App\Core\Data\AutomaticCrudData;
use App\Domain\Blog\Entity\Category;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Category $entity
 */
final class CategoryCrudData extends AutomaticCrudData
{
    /**
     * @Assert\NotBlank()
     */
    public ?string $title = null;
    /**
     * @Assert\NotBlank()
     */
    public ?string $slug = null;

    protected ?\DateTimeInterface $createdAt;

    protected ?\DateTimeInterface $updatedAt = null;

    public ?bool $published = null;

    public function hydrate(): void
    {
        parent::hydrate();
        $this->entity
            ->setUpdatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
    }
}
