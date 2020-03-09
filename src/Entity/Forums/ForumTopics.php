<?php

namespace App\Entity\Forums;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumTopicsRepository")
 */
class ForumTopics
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
    private string $title;

    /**
     * @ORM\Column(type="text")
     */
    private string $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ForumForums", inversedBy="forumTopics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $forum_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="forumTopics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumMessages", mappedBy="topic_id")
     */
    private $forumMessages;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $sticky;

    public function __construct()
    {
        $this->forumMessages = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function getForumId(): ?ForumForums
    {
        return $this->forum_id;
    }

    public function setForumId(?ForumForums $forum_id): self
    {
        $this->forum_id = $forum_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|ForumMessages[]
     */
    public function getForumMessages(): Collection
    {
        return $this->forumMessages;
    }

    public function addForumMessage(ForumMessages $forumMessage): self
    {
        if (!$this->forumMessages->contains($forumMessage)) {
            $this->forumMessages[] = $forumMessage;
            $forumMessage->setTopicId($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumMessages $forumMessage): self
    {
        if ($this->forumMessages->contains($forumMessage)) {
            $this->forumMessages->removeElement($forumMessage);
            // set the owning side to null (unless already changed)
            if ($forumMessage->getTopicId() === $this) {
                $forumMessage->setTopicId(null);
            }
        }

        return $this;
    }

    public function getSticky(): ?bool
    {
        return $this->sticky;
    }

    public function setSticky(?bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }
}
