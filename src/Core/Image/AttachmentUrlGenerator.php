<?php

namespace App\Core\Image;

use App\Entity\Attachment\Attachment;
use App\Http\Attachment\Validator\NonExistingAttachment;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class AttachmentUrlGenerator
{
    private UploaderHelper $helper;

    public function __construct(UploaderHelper $helper)
    {
        $this->helper = $helper;
    }

    public function generate(?Attachment $attachment): ?string
    {
        if (null === $attachment || $attachment instanceof NonExistingAttachment) {
            return null;
        }

        return $this->helper->asset($attachment);
    }
}
