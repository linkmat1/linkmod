<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $title = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $slug = "";

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $content = "";

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at ;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at ;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isOnline = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Content")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contents")
     */
    private $author;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isOK = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reference = "";

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publish_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $upnews;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->created_at;
    }

    /**
     * @param DateTimeInterface $created_at
     * @return $this
     */
    public function setCreatedAt(DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    public function setIsOnline(bool $isOnline): self
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): Content
    {

        $this->author = $author;

        return $this;
    }

    /**
     * @param bool|null $isOK
     * @return Content
     */
    public function setIsOK(?bool $isOK): Content
    {
        $this->isOK = $isOK;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsOK(): ?bool
    {
        return $this->isOK;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPublishAt(): ?\DateTimeInterface
    {
        return $this->publish_at;
    }

    public function setPublishAt(?\DateTimeInterface $publish_at): self
    {
        $this->publish_at = $publish_at;

        return $this;
    }

    public function getUpnews(): ?bool
    {
        return $this->upnews;
    }

    public function setUpnews(?bool $upnews): self
    {
        $this->upnews = $upnews;

        return $this;
    }


}
