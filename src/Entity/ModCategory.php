<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModCategoryRepository")
 * @ORM\Table("mods_category")
 */
class ModCategory
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
    private string $name = "";

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mods", mappedBy="modCategory")
     */
    private $Mods;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $slug = "";

    public function __construct()
    {
        $this->Mods = new ArrayCollection();
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

    /**
     * @return Collection|Mods[]
     */
    public function getMods(): Collection
    {
        return $this->Mods;
    }

    public function addMod(Mods $mod): self
    {
        if (!$this->Mods->contains($mod)) {
            $this->Mods[] = $mod;
            $mod->setModCategory($this);
        }

        return $this;
    }

    public function removeMod(Mods $mod): self
    {
        if ($this->Mods->contains($mod)) {
            $this->Mods->removeElement($mod);
            // set the owning side to null (unless already changed)
            if ($mod->getModCategory() === $this) {
                $mod->setModCategory(null);
            }
        }

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
}
