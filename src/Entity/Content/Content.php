<?php

namespace App\Entity\Content;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
      "posts" = "App\Entity\Posts",
      "episode" = "App\Entity\Content\Episodes"
    })
 */
abstract class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $title = "";

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $content = "";

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isOnline = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contents" )
     * @ORM\JoinColumn(nullable=true)
     */
    private ?User $author = null;

    use ContentAdd;
    use CreatedTimeTrait;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return $this
     */
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getIsOnline(): ?bool
    {
        return $this->isOnline;
    }

    public function setIsOnline(?bool $isOnline): self
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
