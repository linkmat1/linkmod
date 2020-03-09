<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Faker\Provider\DateTime;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id = 0;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $username = "";
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email = "";

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $password = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $facebook = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string  $github = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $website = "";


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content", mappedBy="author")
     */
    private Collection $contents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mods", mappedBy="testedby")
     */
    private $mods;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $bio ="";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $instagram = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $snapshat = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $realName ="";

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $term = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $accept_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumTopics", mappedBy="user_id")
     */
    private $forumTopics;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumMessages", mappedBy="user_id")
     */
    private $forumMessages;




    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->mods = new ArrayCollection();
        $this->forumTopics = new ArrayCollection();
        $this->forumMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setAuthor($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->contains($content)) {
            $this->contents->removeElement($content);
            // set the owning side to null (unless already changed)
            if ($content->getAuthor() === $this) {
                $content->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
            $mod->setTestedby($this);
        }

        return $this;
    }

    public function removeMod(Mods $mod): self
    {
        if ($this->mods->contains($mod)) {
            $this->mods->removeElement($mod);
            // set the owning side to null (unless already changed)
            if ($mod->getTestedby() === $this) {
                $mod->setTestedby(null);
            }
        }

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getSnapshat(): ?string
    {
        return $this->snapshat;
    }

    public function setSnapshat(?string $snapshat): self
    {
        $this->snapshat = $snapshat;

        return $this;
    }

    public function getRealName(): ?string
    {
        return $this->realName;
    }

    public function setRealName(?string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getTerm(): ?bool
    {
        return $this->term;
    }

    public function setTerm(bool $term): self
    {
        $this->term = $term;

        return $this;
    }

    public function getAcceptAt(): ?\DateTimeInterface
    {
        return $this->accept_at;
    }

    public function setAcceptAt(?\DateTimeInterface $accept_at): self
    {
        $accept_at =  new \DateTime('now');
        $this->accept_at = $accept_at;

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

    /**
     * @return Collection|ForumTopics[]
     */
    public function getForumTopics(): Collection
    {
        return $this->forumTopics;
    }

    public function addForumTopic(ForumTopics $forumTopic): self
    {
        if (!$this->forumTopics->contains($forumTopic)) {
            $this->forumTopics[] = $forumTopic;
            $forumTopic->setUserId($this);
        }

        return $this;
    }

    public function removeForumTopic(ForumTopics $forumTopic): self
    {
        if ($this->forumTopics->contains($forumTopic)) {
            $this->forumTopics->removeElement($forumTopic);
            // set the owning side to null (unless already changed)
            if ($forumTopic->getUserId() === $this) {
                $forumTopic->setUserId(null);
            }
        }

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
            $forumMessage->setUserId($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumMessages $forumMessage): self
    {
        if ($this->forumMessages->contains($forumMessage)) {
            $this->forumMessages->removeElement($forumMessage);
            // set the owning side to null (unless already changed)
            if ($forumMessage->getUserId() === $this) {
                $forumMessage->setUserId(null);
            }
        }

        return $this;
    }
}
