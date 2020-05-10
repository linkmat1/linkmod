<?php

namespace App\Http\Normalizer;

use App\Entity\Forums\Tag;
use App\Entity\Forums\Topic;
use App\Http\Encoder\PathEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ForumPathNormalizer implements NormalizerInterface
{

    /**
     * @inheritDoc
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        if ($object instanceof Tag) {
            return [
                'path' => 'forum_tag',
                'params' => ['id' => $object->getId(), 'slug' => $object->getSlug()]
            ];
        } elseif ($object instanceof Topic) {
            return [
                'path' => 'forum_show',
                'params' => ['id' => $object->getId()]
            ];
        }
        throw new \RuntimeException("Can't normalize path");
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, string $format = null)
    {
        return ($data instanceof Tag || $data instanceof Topic)
            && $format === PathEncoder::FORMAT;
    }
}
