<?php

namespace App\Entity;

use App\Entity\Content\Content;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostsRepository")
*/

class Posts extends Content
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $publishAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $source;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $deprecated;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isDepre = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="posts")
     */
    private $category;


    public function getPublishAt(): ?\DateTimeInterface
    {
        return $this->publishAt;
    }

    public function setPublishAt(?\DateTimeInterface $publishAt): self
    {
        $this->publishAt = $publishAt;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getDeprecated(): ?string
    {
        return $this->deprecated;
    }

    public function setDeprecated(?string $deprecated): self
    {
        $this->deprecated = $deprecated;

        return $this;
    }

    public function getIsDepre(): ?bool
    {
        return $this->isDepre;
    }

    public function setIsDepre(bool $isDepre): self
    {
        $this->isDepre = $isDepre;

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
}
