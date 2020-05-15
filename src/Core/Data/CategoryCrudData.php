<?php

namespace App\Core\Data;

use App\Entity\Category;
use App\Entity\User;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Validator\Constraints as Assert;

final class CategoryCrudData implements CrudDataInterface
{


    /**

     */
    public ?string $name = null;

    public ?\DateTimeInterface $createdAt;

    public ?\DateTimeInterface $updatedAt = null;

    public ?User $author;

    public ?string $color = '#000';
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    public ?string $content = null;

    public ?bool $isOnline = false;


    private ?EntityManagerInterface $em = null;
    private Category $entity;
    public function __construct(Category $category)
    {
        $this->entity = $category;
        $this->name = $category->getName();
        $this->createdAt = $category->getCreatedAt();
        $this->content = $category->getContent();
        $this->author = $category->getAuthor();
        $this->isOnline = $category->getIsOnline();
        $this->updatedAt = $category->getUpdatedAt();
        $this->color = $category->getColor();
    }

    public function hydrate(): void
    {
        $this->entity
            ->setName($this->name)
            ->setCreatedAt($this->createdAt)
            ->setContent($this->content)
            ->setIsOnline($this->isOnline)
            ->setUpdatedAt(new \DateTime('now'))
            ->setColor($this->color)
            ->setAuthor($this->author);
    }

    public function getFormClass(): string
    {
        return AutomaticForm::class;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): CategoryCrudData
    {
        $this->author = $author;
        return $this;
    }

    public function getEntity(): Category
    {
        return $this->entity;
    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}
