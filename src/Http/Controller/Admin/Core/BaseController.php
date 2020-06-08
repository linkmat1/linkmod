<?php


namespace App\Http\Controller\Admin\Core;

use App\Domain\Auth\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class BaseController extends AbstractController
{

    public $prefixAdmin = 'admin';

    public function isLinkmat(TokenInterface $token){
        $user = $token->getuser();
        if (!$user instanceof User) {
            return false;
        }

        return $user->getUsername() === 'linkmat';
    }
}