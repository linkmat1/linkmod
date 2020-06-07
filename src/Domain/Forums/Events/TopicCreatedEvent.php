<?php

namespace App\Domain\Forums\Events;


use App\Domain\Forums\Entity\Topic;

class TopicCreatedEvent
{
    private Topic $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getTopic(): Topic
    {
        return $this->topic;
    }
}
