<?php

namespace App\Entity\Forums;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumCategoryRepository")
 */
class ForumCategory
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
    private string  $title = "";

    /**
     * @ORM\Column(type="integer")
     */
    private int $position = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Forums\ForumForums", mappedBy="category_id")
     */
    private $forumForums;

    public function __construct()
    {
        $this->forumForums = new ArrayCollection();
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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|ForumForums[]
     */
    public function getForumForums(): Collection
    {
        return $this->forumForums;
    }

    public function addForumForum(ForumForums $forumForum): self
    {
        if (!$this->forumForums->contains($forumForum)) {
            $this->forumForums[] = $forumForum;
            $forumForum->setCategoryId($this);
        }

        return $this;
    }

    public function removeForumForum(ForumForums $forumForum): self
    {
        if ($this->forumForums->contains($forumForum)) {
            $this->forumForums->removeElement($forumForum);
            // set the owning side to null (unless already changed)
            if ($forumForum->getCategoryId() === $this) {
                $forumForum->setCategoryId(null);
            }
        }

        return $this;
    }
}
