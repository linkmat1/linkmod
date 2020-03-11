<?php

namespace App\Http\Attachment\Image;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Renvoie une URL redimensionnée pour une image donnée
 */
class ImageResizer
{

    private UploaderHelper $helper;

    public function __construct(UploaderHelper $helper)
    {
        $this->helper = $helper;
    }

    public function resize(?string $url, ?int $width = null, ?int $height = null): string
    {
        if ($url === null || empty($url)) {
            return '';
        }
        if ($width === null && $height === null) {
            return "/resize/jpg" . $url;
        }
        return "/resize/r_{$width}_{$height}{$url}";
    }

}