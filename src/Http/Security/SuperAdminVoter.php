<?php

namespace App\Http\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SuperAdminVoter extends Voter
{
    /**
     * {@inheritdoc}
     */
    protected function supports(string $attribute, $subject)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return 'ROLE_SUPERADMIN' === $user->getRoles();
    }
}
