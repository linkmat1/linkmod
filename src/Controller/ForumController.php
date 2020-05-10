<?php

namespace App\Controller;

use App\Core\Helper\Paginator\PaginatorInterface;
use App\Entity\Forums\Tag;
use App\Entity\Forums\Topic;
use App\Form\ForumTopicType;
use App\Repository\Forums\TagRepository;
use App\Repository\Forums\TopicRepository;
use App\Service\TopicService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forum")
 */
class ForumController extends AbstractController
{
    private string $menuItem = 'forum';
    private TagRepository $tagRepository;
    private TopicRepository $topicRepository;
    private PaginatorInterface $paginator;

    /**
     * ForumController constructor.
     */
    public function __construct(TagRepository $tagRepository,
                                TopicRepository $topicRepository,
                                PaginatorInterface $paginator)
    {
        $this->tagRepository = $tagRepository;
        $this->topicRepository = $topicRepository;
        $this->paginator = $paginator;
    }

    /**
     * @Route("/", name="forum")
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function index(TagRepository $tagRepository): Response
    {
        return $this->tag(null);
    }

    /**
     * @Route("/new", name="forum_new")
     * @param Request $request
     * @param TopicService $service
     * @return Response
     */
    public function create(Request $request, TopicService $service): Response
    {
        $topic = (new Topic())->setContent($this->renderView('forum/template/placeholder.text.twig'));
        $topic->setAuthor($this->getUser());

        $form = $this->createForm(ForumTopicType::class, $topic);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service->createTopic($topic);
            $this->addFlash('success', 'Le sujet a bien été créé');

            return $this->redirectToRoute('forum');
        }

        return $this->render('forum/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug<[a-z0-9\-]+>}-{id<\d+>}", name="forum_tag")
     * @param Tag|null $tag
     * @return Response
     */
    public function tag(?Tag $tag): Response
    {
        $topics = $this->paginator->paginate($this->topicRepository->queryAllForTag($tag));

        return $this->render('forum/index.html.twig', [
            'tags' => $this->tagRepository->findTree(),
            'topics' => $topics,
            'menu' => $this->menuItem,
        ]);
    }

    /**
     * @Route("/{id<\d+>}", name="forum_show")
     * @param Topic $topic
     * @return Response
     */
    public function show(Topic $topic): Response
    {
        return $this->render('forum/show.html.twig', [
            'topic' => $topic,
            'messages' => $topic->getMessages(),
            'menu' => $this->menuItem,
        ]);
    }


}
