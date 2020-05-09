<?php

namespace App\Core\Twig\Cache;

interface CacheableInterface
{
    public function getId(): int;

    public function getUpdatedAt(): \DateTimeInterface;
}
