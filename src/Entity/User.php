<?php

namespace App\Entity;

use App\Core\ProfilTrait;
use App\Entity\Content\Content;
use App\Entity\Content\CreatedTimeTrait;
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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $username = '';
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email = '';

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $password = '';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content\Content", mappedBy="author")
     */
    private ?Collection $contents;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $acceptedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $term = false;

    /**
     * @ORM\ManyToMany(targetEntity=Groupes::class, mappedBy="members")
     */
    private ?Collection $groupes;


    use ProfilTrait;
    use CreatedTimeTrait;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->groupes = new ArrayCollection();
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

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
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

    public function getAcceptedAt(): ?\DateTimeInterface
    {
        return $this->acceptedAt;
    }

    public function setAcceptedAt(?\DateTimeInterface $acceptedAt): self
    {
        $this->acceptedAt = $acceptedAt;

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

    /**
     * @return Collection|Groupes[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupes $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addMember($this);
        }

        return $this;
    }

    public function removeGroupe(Groupes $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeMember($this);
        }

        return $this;
    }
}
