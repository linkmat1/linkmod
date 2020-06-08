<?php

namespace App\Http\Cloner;

use App\Domain\Blog\Entity\Post;

/**
 * Permet de dupliquer un Post du Blog en prenant en compte les associations
 */
class PostCloner
{
    public static function clone(Post $post): Post
    {
        $clone = clone $post;
        $clone->setTitle($post->getTitle());
        $clone->setPublishAt(null);
        $clone->setPublished(false);
        $clone->setSlug("Clone-Clone");
        $clone->setContent($post->getContent());
        $clone->setCreatedAt(new \DateTime('@' . ($clone->getCreatedAt()->getTimestamp() + 24 * 3600)));
        if ($createdAt = $clone->getCreatedAt()) {
            $clone->setCreatedAt(new \DateTime('@' . ($createdAt->getTimestamp() + 24 * 3600)));
        }
        return $clone;
    }
}
