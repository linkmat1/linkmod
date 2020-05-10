<?php

namespace App\Service;

use App\Entity\Forums\Topic;

use App\Events\PreTopicCreatedEvent;
use App\Events\TopicCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TopicService
{
    private EventDispatcherInterface $dispatcher;
    private EntityManagerInterface $em;

    public function __construct(EventDispatcherInterface $dispatcher, EntityManagerInterface $em)
    {
        $this->dispatcher = $dispatcher;
        $this->em = $em;
    }

    public function createTopic(Topic $topic): void
    {
        $topic->setCreatedAt(new \DateTime());
        $topic->setUpdatedAt(new \DateTime());
        $this->dispatcher->dispatch(new PreTopicCreatedEvent($topic));
        $this->em->persist($topic);
        $this->em->flush();
        $this->dispatcher->dispatch(new TopicCreatedEvent($topic));
    }
}
