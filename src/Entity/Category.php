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
    private ?int $id = 0;

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
    private string $slug = "";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $shortdesc = "";

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content", mappedBy="category")
     * @var Collection<int, content>
     */
    private $Content;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="categories")
     */
    private $created_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $updated_at;


    public function __construct()
    {
        $this->Content = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
