<?php

namespace App\Domain\Forums\Events;



use App\Domain\Forums\Entity\Message;

class MessageCreatedEvent
{
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }
}
