<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title = "" ;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isOnline = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private  string $slug = "";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $shortdesc = "";

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content", mappedBy="category")
     * @var Collection<int, content>
     */
    private  $Content;

    public function __construct()
    {
        $this->Content = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getShortdesc(): ?string
    {
        return $this->shortdesc;
    }

    public function setShortdesc(string $shortdesc): self
    {
        $this->shortdesc = $shortdesc;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContent(): Collection
    {
        return $this->Content;
    }

    public function addContent(Content $content): self
    {
        if (!$this->Content->contains($content)) {
            $this->Content[] = $content;
            $content->setCategory($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->Content->contains($content)) {
            $this->Content->removeElement($content);
            // set the owning side to null (unless already changed)
            if ($content->getCategory() === $this) {
                $content->setCategory(null);
            }
        }

        return $this;
    }
}
