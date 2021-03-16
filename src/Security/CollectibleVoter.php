<?php

namespace App\Security;

use App\Entity\Book;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CollectibleVoter extends Voter
{
    const READ = 'read';

    protected function supports(string $attribute, $subject)
    {
        if ($attribute != self::READ) {
            return false;
        }

        if (!$subject instanceof Book) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if ($subject->getCollection()->getIsPublic()) {
            return true;
        } else {
            if ($user instanceof User && in_array($user, $subject->getCollection()->getOwners()->toArray())) {
                return true;
            } else {
                return false;
            }
        }
    }
}
