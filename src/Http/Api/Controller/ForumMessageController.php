<?php

namespace App\Http\Api\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Controller\AbstractController;
use App\Entity\Forums\Message;
use App\Entity\Forums\Topic;

use App\Form\ForumMessageType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForumMessageController extends AbstractController
{

    /**
     * @Route("/topics/{id}/messages", name="messages_post_collection", methods={"POST, GET"})
     * @param Topic $topic
     * @param Request $request
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $dispatcher
     */
    public function create(
        Topic $topic,
        Request $request,
        ValidatorInterface $validator,
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher
    )
    {
        $user = $this->getUser();
        $message = (new Message())->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())
            ->setTopic($topic)
            ->setAuthor($user);
        $form = $this->createForm(ForumMessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setCreatedAt(new \DateTime())->setUpdatedAt(new \DateTime())
                ->setTopic($topic)
                ->setAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('forum');
        }
        return $this->render('forum/show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


