<?php

namespace App\Http\Data\Blog;

use App\Core\Data\AutomaticCrudData;
use App\Domain\Blog\Entity\Category;
use App\Domain\Blog\Entity\Post;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property Post $entity
 */
final class PostCrudData extends AutomaticCrudData
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

    public ?string $content = null;

    public ?bool $published = null;

    public ?Category $category = null;

    public ?\DateTimeInterface $publishAt = null;

    public function hydrate(): void
    {
        parent::hydrate();
        $this->entity
            ->setUpdatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
    }
}
