<?php

namespace App\Controller\Admin\Forums\Api;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Controller\AbstractController;
use App\Entity\Forums\Topic;
use App\Http\Security\ForumVoter;
use App\Modules\Forum\Events\MessageCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForumMessageController extends AbstractController
{

    /**
     * @Route("/topics/{id}/messages", name="messages_post_collection", methods={"POST"})
     */
    public function create(
        Topic $topic,
        Request $request,
        ValidatorInterface $validator,
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher
    ): JsonResponse {
        $this->denyAccessUnlessGranted(ForumVoter::CREATE_MESSAGE, $topic);
        $data = json_decode((string)$request->getContent(), true);
        $message = (new Message())
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
            ->setTopic($topic)
            ->setContent($data['content'] ?? null)
            ->setAuthor($this->getUser());
        $validator->validate($message, ['groups' => ['create']]);
        $em->persist($message);
        $em->flush();
        $dispatcher->dispatch(new MessageCreatedEvent($message));
        return new JsonResponse([
            'id'   => $message->getId(),
            'html' => $this->renderView('forum/_message.html.twig', ['message' => $message])
        ], 201);
    }
}
