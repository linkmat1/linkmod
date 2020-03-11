<?php

namespace App\Entity\Attachment;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class Attachment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected ?int $id = 0;

    /**
     * @Vich\UploadableField(mapping="attachments", fileNameProperty="fileName", size="fileSize")
     * @var File|null
     */
    private ?File $file = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $fileName = "";

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private int $fileSize = 0;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTimeInterface $createdAt;

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName ?: '';

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
