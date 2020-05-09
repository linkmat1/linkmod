<?php


namespace App\Entity\Content;

use Doctrine\ORM\Mapping as ORM;

trait ContentAdd
{
    /**
     * @ORM\Column(type="boolean")
     */
    public bool $isNews = false;

    /**
     * @ORM\Column(type="boolean")
     */
    public bool $isInfo = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $Info = " ";

    public function getIsNews(): ?bool
    {
        return $this->isNews;
    }

    public function setIsNews(bool $isNews): self
    {
        $this->isNews = $isNews;

        return $this;
    }

    public function getIsInfo(): ?bool
    {
        return $this->isInfo;
    }

    public function setIsInfo(bool $isInfo): self
    {
        $this->isInfo = $isInfo;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->Info;
    }

    public function setInfo(?string $Info): self
    {
        $this->Info = $Info;

        return $this;
    }
}