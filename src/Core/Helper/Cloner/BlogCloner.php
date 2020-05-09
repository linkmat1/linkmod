<?php

namespace App\Core\Helper\Cloner;


use App\Entity\Posts;

/**
 * Permet de dupliquer un cours en prenant en compte les associations
 */
class BlogCloner
{

    public static function clone(Posts $posts): Posts
    {

        $clone = clone $posts;
        $clone->setTitle($posts->getTitle());
        $clone->setInfo(null);
        $clone->setSource(null);
        $clone->setPublishAt(null);
        $clone->setIsDepre(false);
        $clone->setIsOnline(false);
        $clone->setIsInfo(false);
        $clone->setDeprecated(null);
        $clone->setCreatedAt(clone $posts->getCreatedAt());
        return $clone;
    }
}