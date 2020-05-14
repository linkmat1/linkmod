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

    public ?bool  $isNews = false;

    public ?bool  $isInfo = false;

    public ?string $Info = " ";

    public ?string $source = " ";

    public ?\DateTimeInterface $publishAt = null;

    /**
     * @Assert\NotBlank()
     */
    public ?User $author;

    public ?string $deprecated = " ";

    public ?bool $isDepre = false;
    /**
     * @Assert\NotBlank()
     */
    public ?string $content = null;

    public ?bool $isOnline = false;

    public Posts $entity;


    public function __construct(Posts $post)
    {
        $this->entity = $post;
        $this->title = $post->getTitle();
        $this->createdAt = $post->getCreatedAt();
        $this->content = $post->getContent();
        $this->author = $post->getAuthor();
        $this->isInfo = $post->getIsInfo();
        $this->isNews = $post->getIsNews();
        $this->isOnline = $post->getIsOnline();
        $this->updatedAt = $post->getUpdatedAt();
        $this->category = $post->getCategory();
        $this->Info = $post->getInfo();
        $this->source = $post->getSource();
        $this->publishAt = $post->getPublishAt();
        $this->isDepre = $post->getIsDepre();
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
            ->setIsOnline($this->isOnline)
            ->setUpdatedAt(new \DateTime('now'))
            ->setAuthor($this->author)
            ->setInfo($this->Info)
            ->setCategory($this->category)
            ->setIsDepre($this->isDepre)
            ->setIsNews($this->isNews)
            ->setIsInfo($this->isInfo)
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
