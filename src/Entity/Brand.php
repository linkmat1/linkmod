<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandRepository")
 */
class Brand
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name = "";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $slug = "";

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mods", mappedBy="brand")
     */
    private $mods;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTimeInterface $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="brands")
     */
    private $created_by;

    public function __construct()
    {
        $this->mods = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|Mods[]
     */
    public function getMods(): Collection
    {
        return $this->mods;
    }

    public function addMod(Mods $mod): self
    {
        if (!$this->mods->contains($mod)) {
            $this->mods[] = $mod;
            $mod->setBrand($this);
        }

        return $this;
    }

    public function removeMod(Mods $mod): self
    {
        if ($this->mods->contains($mod)) {
            $this->mods->removeElement($mod);
            // set the owning side to null (unless already changed)
            if ($mod->getBrand() === $this) {
                $mod->setBrand(null);
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
}
