<?php

namespace App\Core\Data;

use App\Entity\Category;
use App\Entity\Posts;
use App\Entity\User;
use App\Form\PostsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class PostCrudData implements CrudDataInterface
{

    public ?int $id = null;
    /**
     * @Assert\NotBlank()
     */
    public ?string $title = null;

    public ?Category $category = null;

    public ?\DateTimeInterface $createdAt;

    public ?\DateTimeInterface $updatedAt = null;

    public ?string $Info = " ";

    public ?string $source = " ";

    public ?\DateTimeInterface $publishAt = null;

    /**
     * @Assert\NotBlank()
     */
    public ?User $author;

    public ?string $deprecated = " ";

    public ?bool  $inOnline = false;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    public ?string $content = null;

    public ?bool $online = false;

    public Posts $entity;
    private ?EntityManagerInterface $em = null;

    public function __construct(Posts $post)
    {
        $this->entity = $post;
        $this->title = $post->getTitle();
        $this->createdAt = $post->getCreatedAt();
        $this->content = $post->getContent();
        $this->author = $post->getAuthor();
        $this->online = $post->getOnline();
        $this->updatedAt = $post->getUpdatedAt();
        $this->category = $post->getCategory();
        $this->Info = $post->getInfo();
        $this->source = $post->getSource();
        $this->publishAt = $post->getPublishAt();
        $this->deprecated = $post->getDeprecated();
        $this->id = $post->getId();
    }

    public function hydrate(): void
    {
        $this->entity
            ->setCategory($this->category)
            ->setTitle($this->title)
            ->setCreatedAt($this->createdAt)
            ->setContent($this->content)
            ->setOnline($this->online)
            ->setUpdatedAt(new \DateTime('now'))
            ->setAuthor($this->author)
            ->setInfo($this->Info)
            ->setCategory($this->category)
            ->setDeprecated($this->deprecated)
            ->setPublishAt($this->publishAt)
            ->setSource($this->source);

    }

    public function getEntity(): object
    {
        return $this->entity;
    }

    public function getFormClass(): string
    {
        return PostsType::class;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): PostCrudData
    {
        $this->author = $author;
        return $this;
    }
    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
}
