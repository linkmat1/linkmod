<?php
namespace App\Controller\Admin;

use App\Entity\Content;
use App\Entity\User;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/blog", name="admin_blog_")
 * @IsGranted("ROLE_ADMIN")
 */
class ContentController extends AbstractController
{
    private string $menuitem = "blog";
    private string $adminPath = 'admin/';
    /**
     * @var ContentRepository
     */
    private ContentRepository $em;
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    /**
     * ContentController constructor.
     * @param ContentRepository $em
     * @param PaginatorInterface $paginator
     */
    public function __construct(ContentRepository $em, PaginatorInterface $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;

    }

    /**
     * @Route("/", name="index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $query = $this->em->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC');
        if ($request->get('q')) {
            $query = $query->where('c.title LIKE :title')
                ->setParameter('title', "%" . $request->get('q') . "%");
        }
        $page = $request->query->getInt('page', 1);
        $content = $this->paginator->paginate(
            $query->getQuery(),
            $page,
            12
        );

        return $this->render($this->adminPath.'content/index.html.twig', [
            'contents' => $content,
            'page' => $page,
            'menu' => $this->menuitem
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {

        $user = $this->getUser();
        $content = new Content();
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);
        $content->setCreatedAt(new \DateTime('now'));
        if ($form->isSubmitted() && $form->isValid()) {
            $content->setCreatedAt(new \DateTime('now'));
            $content->setAuthor($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($content);
            $entityManager->flush();
            $this->addFlash('success', 'Le contenu a bien été Crée');

            return $this->redirectToRoute('admin_blog_index');
        }

        return $this->render($this->adminPath.'content/new.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug<[a-z0-9\-]+>}-{id<\d+>}/edit", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Content $content
     * @param string $slug
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, Content $content, string $slug): Response
    {
        if ($content->getSlug() !== $slug) {
            return $this->redirectToRoute('admin_blog_edit', [
                'id' => $content->getId(),
                'slug' => $content->getSlug(),
            ], 301);
        }
        $form = $this->createForm(ContentType::class, $content);
        $form->handleRequest($request);
        $update = new \DateTime('now');
        if ($form->isSubmitted() && $form->isValid()) {
            $content->setUpdatedAt($update);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le contenu a bien été Modifier');

            return $this->redirectToRoute('admin_blog_edit');
        }

        return $this->render($this->adminPath.'content/edit.html.twig', [
            'content' => $content,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Content $content
     * @return Response
     */
    public function delete(Request $request, Content $content): Response
    {
        if ($this->isCsrfTokenValid('delete'.$content->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($content);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Le contenu a bien été Suprimée');

        return $this->redirectToRoute('admin_blog_index');
    }
}
