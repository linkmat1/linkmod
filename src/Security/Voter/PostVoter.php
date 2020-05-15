<?php
namespace App\Security\Voter;

use Symfony\Component\Security\Core\Security;
use App\Entity\Posts;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{
// these strings are just invented: you can use anything
    const DELETE = 'delete';
    const EDIT = 'edit';

    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    protected function supports($attribute, $subject)
    {
    // if the attribute isn't one we support, return false
    if (!in_array($attribute, [self::DELETE, self::EDIT])) {
    return false;
    }

        // only vote on `Post` objects
        if (!$subject instanceof Posts) {
        return false;
    }

        return true;
    }

        protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
        {
        $user = $token->getUser();

        if (!$user instanceof User) {
        // the user must be logged in; if not, deny access
        return false;
        }

        // you know $subject is a Post object, thanks to `supports()`
        /** @var Posts $post */
        $post = $subject;

        switch ($attribute) {
        case self::DELETE:
            return $this->canDelete($post, $user);
        case self::EDIT:
            return $this->canEdit($post, $user);
        }

        throw new \LogicException('This code should not be reached!');
        }

    private function canEdit(Posts $post, User $user)
    {
        return $user === $post->getAuthor() || $user->getRoles('["ROLE_MANAGE"]') || $user->getRoles('["ROLE_ADMIN"]');
     }

     private function canDelete(Posts $post, User $user){

        return $user === $user->getRoles('["ROLE_MANAGE"]');

     }
}
