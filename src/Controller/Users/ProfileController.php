<?php

namespace App\Controller\Users;

use App\Core\Service\ProfileService;
use App\Entity\User;
use App\Http\Dto\AvatarDto;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/profil")
 * @IsGranted("ROLE_USER")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="user_edit")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param ProfileService $service
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(
        Request $request,
        ProfileService $service,
        EntityManagerInterface $em
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        // On crée les formulaires

        return $this->render('users/edit.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profil/avatar", name="user_avatar", methods={"POST"})
     * @IsGranted("ROLE_USER")
     */
    public function avatar(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        ProfileService $service
    ): Response {
        /** @var User $user */
        $user = $this->getUser();
        $data = new AvatarDto($request->files->get('avatar'), $user);
        $errors = $validator->validate($data);
        if ($errors->count() > 0) {
            $this->addFlash('error', (string) $errors->get(0)->getMessage());
        } else {
            $service->updateAvatar($data);
            $em->flush();
            $this->addFlash('success', 'Avatar mis à jour avec succès');
        }

        return $this->redirectToRoute('user_edit');
    }

    /**
     * @Route("/user/{username}", name="user_show")
     */
    public function show(User $user): Response
    {
        return new Response('Hello');
    }
}
