<?php

namespace App\Entity\Content;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeriesRepository")
 * @ORM\Table("video_episodes")
 */
class Episodes extends Content
{
    /**
     * @ORM\Column(type="smallint")
     */
    private int $duration = 0;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private ?string $youtubeId = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $videoPath = null;

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    public function setYoutubeId(?string $youtubeId): self
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }

    public function getVideoPath(): ?string
    {
        return $this->videoPath;
    }

    public function setVideoPath(?string $videoPath): self
    {
        $this->videoPath = $videoPath;

        return $this;
    }
}
