<?php

namespace App\Core\Twig;

use App\Core\Image\AttachmentUrlGenerator;
use App\Core\Image\ImageResizer;
use App\Entity\Attachment\Attachment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class TwigPathExtension extends AbstractExtension
{
    private UploaderHelper $uploaderHelper;
    private ImageResizer $imageResizer;
    private AttachmentUrlGenerator $attachmentUrlGenerator;

    public function __construct(
        ImageResizer $imageResizer,
        AttachmentUrlGenerator $attachmentUrlGenerator
    ) {
        $this->imageResizer = $imageResizer;
        $this->attachmentUrlGenerator = $attachmentUrlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('uploads_path', [$this, 'uploadsPath']),
            new TwigFunction('image_url', [$this, 'imageUrl']),
        ];
    }

    public function uploadsPath(string $path): string
    {
        return '/uploads/'.trim($path, '/');
    }

    public function imageUrl(?Attachment $attachment, ?int $width = null, ?int $height = null): string
    {
        return $this->imageResizer->resize($this->attachmentUrlGenerator->generate($attachment), $width, $height);
    }
}
