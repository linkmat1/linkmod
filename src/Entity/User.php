<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\Column(type="string")
     */
    private string $password = "";

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


    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->mods = new ArrayCollection();


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
            $mod->setAuthor($this);
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
            if ($mod->getAuthor() === $this) {
                $mod->setAuthor(null);
            }
        }

        return $this;
    }




}
