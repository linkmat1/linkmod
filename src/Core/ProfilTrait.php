<?php

namespace App\Core;

trait ProfilTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $github = ' ';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $instagram = ' ';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $facebook = ' ';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $youtube = ' ';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $country = ' ';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $whatsapp = ' ';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $twitch = ' ';

    public function getGithub(): ?string
    {
        return $this->github;
    }

    /**
     * @return ProfilTrait
     */
    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    /**
     * @return ProfilTrait
     */
    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * @return ProfilTrait
     */
    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return ProfilTrait
     */
    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    /**
     * @return ProfilTrait
     */
    public function setWhatsapp(?string $whatsapp): self
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    public function getTwitch(): ?string
    {
        return $this->twitch;
    }

    /**
     * @return ProfilTrait
     */
    public function setTwitch(?string $twitch): self
    {
        $this->twitch = $twitch;

        return $this;
    }
}
