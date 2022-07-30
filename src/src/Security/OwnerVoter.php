<?php

namespace App\Security;

use App\Entity\GlassesStore;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;


class OwnerVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    const NEW = 'new';
    const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE, self::NEW])) {
            return false;
        }

        // only vote on `Hotel` objects
        if (!$subject instanceof GlassesStore) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        /** @var GlassesStore $hotel */
        $glassesStore = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView();
            case self::EDIT:
                return $this->canEdit($glassesStore, $user);
            case self::NEW:
                return $this->canNew($glassesStore, $user);
            case self::DELETE:
                return $this->canDelete($glassesStore, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(): bool
    {
        return true;
    }

    private function canEdit(GlassesStore $glassesStore, User $user): bool
    {
        return $glassesStore->getOwner() === $user;
    }

    private function canNew(GlassesStore $glassesStore, User $user): bool
    {
        return !$user->getGlassesStores()->isEmpty();
    }

    private function canDelete(GlassesStore $glassesStore, User $user): bool
    {
        return $glassesStore->getOwner() === $user;
    }
}