<?php

namespace App\Events;

use App\Entity\Forums\Topic;

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
