<?php

namespace App\Entity\Content;

use App\Entity\Attachment\Attachment;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
      "posts" = "App\Entity\Posts"
    })
 * @Vich\Uploadable()
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
    private ?string $title = '';

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $content = '';

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $online = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contents" )
     * @ORM\JoinColumn(nullable=true)
     */
    private ?User $author = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Attachment\Attachment", cascade={"persist"})
     * @ORM\JoinColumn(name="attachment_id", referencedColumnName="id")
     */
    private ?Attachment $image = null;

    use ContentAdd;

    use CreatedTimeTrait;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
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


    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getImage(): ?Attachment
    {
        return $this->image;
    }

    /**
     * @param Attachment|null $image
     * @return $this
     */
    public function setImage(?Attachment $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(?bool $online): self
    {
        $this->online = $online;
    }
}
