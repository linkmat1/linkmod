<?php

namespace App\Controller\Users;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 * @IsGranted("ROLE_USER")
 */
class ProfileController extends AbstractController

{


    /**
     * @Route("/profil/{username}-{id}", name="user_profil", methods={"GET"})
     */
    public function getProfil()
    {

        return $this->render('Users/profile.html.twig');
    }
}
