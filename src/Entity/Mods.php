<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Query\Mysql\Date;
use http\Encoding\Stream\Inflate;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModsRepository")
 */
class Mods
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
     * @ORM\Column(type="text")
     */
    private string $description = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $credit = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $chevaux = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $model = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $price = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $option1 = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $option2 = "";

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $option3 = "";

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $certified  = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $withouterrors = false;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private ?array $support = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $colorrims = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $colorchoice = false;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private ?array $chargeuravant = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private ?array $wheels = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $created_at ;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $approuved = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $selection = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $istest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mods")
     */
    private $testedby;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mods")
     */
    private $author;


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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCredit(): ?string
    {
        return $this->credit;
    }

    public function setCredit(?string $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getChevaux(): ?string
    {
        return $this->chevaux;
    }

    public function setChevaux(?string $chevaux): self
    {
        $this->chevaux = $chevaux;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(?string $option1): self
    {
        $this->option1 = $option1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(?string $option2): self
    {
        $this->option2 = $option2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function setOption3(?string $option3): self
    {
        $this->option3 = $option3;

        return $this;
    }

    public function getCertified(): ?bool
    {
        return $this->certified;
    }

    public function setCertified(?bool $certified): self
    {
        $this->certified = $certified;

        return $this;
    }

    public function getWithouterrors(): ?bool
    {
        return $this->withouterrors;
    }

    public function setWithouterrors(bool $withouterrors): self
    {
        $this->withouterrors = $withouterrors;

        return $this;
    }

    public function getSupport(): ?array
    {
        return $this->support;
    }

    public function setSupport(array $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getColorrims(): ?bool
    {
        return $this->colorrims;
    }

    public function setColorrims(?bool $colorrims): self
    {
        $this->colorrims = $colorrims;

        return $this;
    }

    public function getColorchoice(): ?bool
    {
        return $this->colorchoice;
    }

    public function setColorchoice(bool $colorchoice): self
    {
        $this->colorchoice = $colorchoice;

        return $this;
    }

    public function getChargeuravant(): ?array
    {
        return $this->chargeuravant;
    }

    public function setChargeuravant(?array $chargeuravant): self
    {
        $this->chargeuravant = $chargeuravant;

        return $this;
    }

    public function getWheels(): ?array
    {
        return $this->wheels;
    }

    public function setWheels(?array $wheels): self
    {
        $this->wheels = $wheels;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = new \DateTime('now');

        return $this;
    }

    public function getApprouved(): ?bool
    {
        return $this->approuved;
    }

    public function setApprouved(?bool $approuved): self
    {
        $this->approuved = $approuved;

        return $this;
    }

    public function getSelection(): ?bool
    {
        return $this->selection;
    }

    public function setSelection(?bool $selection): self
    {
        $this->selection = $selection;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIstest(): ?bool
    {
        return $this->istest;
    }

    public function setIstest(?bool $istest): self
    {
        $this->istest = $istest;

        return $this;
    }

    public function getTestedby(): ?User
    {
        return $this->testedby;
    }

    public function setTestedby(?User $testedby): self
    {
        $this->testedby = $testedby;

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
