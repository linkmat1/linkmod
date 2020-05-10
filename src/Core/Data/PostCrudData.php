<?php

namespace App\Core\Data;

use App\Entity\Attachment\Attachment;
use App\Entity\Category;
use App\Entity\Posts;
use App\Entity\User;
use App\Form\PostsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable()
 */
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

    public ?string $Info = ' ';

    public ?string $source = ' ';

    public ?\DateTimeInterface $publishAt = null;

    /**
     * @Assert\NotBlank()
     */
    public ?User $author = null;

    public ?string $deprecated = ' ';

    public ?bool $isDepre = false;
    /**
     * @Assert\NotBlank()
     */
    public ?string $content = null;

    public ?bool $isOnline = false;

    public Posts $entity;

    public ?Attachment $image = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public static function makeFromPost(Posts $post): self
    {
        $data = new self();

        $data->title = $post->getTitle();
        $data->createdAt = $post->getCreatedAt();
        $data->content = $post->getContent();
        $data->author = $post->getAuthor();
        $data->isInfo = $post->getIsInfo();
        $data->isNews = $post->getIsNews();
        $data->isOnline = $post->getIsOnline();
        $data->updatedAt = $post->getUpdatedAt();
        $data->category = $post->getCategory();
        $data->Info = $post->getInfo();
        $data->source = $post->getSource();
        $data->publishAt = $post->getPublishAt();
        $data->isDepre = $post->getIsDepre();
        $data->deprecated = $post->getDeprecated();
        $data->image =  $post->getImage();
        $data->entity = $post;
        return $data;

    }

    public function hydrate(): void
    {
        $this->entity
            ->setCategory($this->category)
            ->setTitle($this->title)
            ->setCreatedAt($this->createdAt)
            ->setContent($this->content)
            ->setIsOnline($this->isOnline)
            ->setAuthor($this->author)
            ->setInfo($this->Info)
            ->setUpdatedAt($this->updatedAt)
            ->setCategory($this->category)
            ->setIsDepre($this->isDepre)
            ->setIsNews($this->isNews)
            ->setIsInfo($this->isInfo)
            ->setDeprecated($this->deprecated)
            ->setPublishAt($this->publishAt)
            ->setImage($this->image)
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
