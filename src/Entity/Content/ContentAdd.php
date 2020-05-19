<?php


namespace App\Entity\Content;

use Doctrine\ORM\Mapping as ORM;

trait ContentAdd
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $Info = " ";

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
