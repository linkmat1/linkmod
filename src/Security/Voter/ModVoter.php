<?php
namespace App\Security\Voter;

use App\Entity\Mods;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ModVoter extends Voter
{
    // these strings are just invented: you can use anything
    const DELETE = 'delete';
    const EDIT = 'edit';
    /**
     * @var Security
     */
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    private function canEdit(Mods $mods, User $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $mods->getTestedby();
    }

    private function canDelete(Mods $mods, User $user)
    {
        if ($this->security->isGranted('ROLE_MODO')) {
            if ($this->canEdit($mods, $user)) {
                return true;
            }
        }
    }
    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::DELETE, self::EDIT])) {
            return false;
        }
        if (!$subject instanceof  Mods) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }
        /* @var Mods $mods */
        $mods = $subject;
        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($mods, $user);
            case self::EDIT:
                return $this->canEdit($mods, $user);
        }
        return null;
    }
}
