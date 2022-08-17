<?php

namespace App\Security;

use App\Entity\Glasses;
use App\Entity\GlassesStore;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;


class OwnerVoter extends Voter
{
    const EDIT = 'edit';
    const DELETE = 'delete';
    const NEW = 'new';
    const VIEW = 'view';

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE, self::NEW])) {
            return false;
        }

//        // vote on `GlassesStore` and `Glasses` objects
//        if (!$subject instanceof GlassesStore OR !$subject instanceof Glasses) {
//            return false;
//        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        if ($subject instanceof GlassesStore) {
            $glassesStore = $subject;

            switch ($attribute) {
                case self::VIEW:
                    return $this->canView();
                case self::EDIT:
                    return $this->canEditGlassesStore($glassesStore, $user);
                case self::NEW:
                    return $this->canNewGlassesStore($glassesStore, $user);
                case self::DELETE:
                    return $this->canDeleteGlassesStore($glassesStore, $user);
            }

        } elseif ($subject instanceof Glasses) {
            $glasses = $subject;

            switch ($attribute) {
                case self::VIEW:
                    return $this->canView();
                case self::EDIT:
                    return $this->canEditGlasses($glasses, $user);
                case self::NEW:
                    return $this->canNewGlasses($glasses, $user);
                case self::DELETE:
                    return $this->canDeleteGlasses($glasses, $user);
            }
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(): bool
    {
        return true;
    }

    private function canEditGlassesStore(GlassesStore $glassesStore, User $user): bool
    {
        return $glassesStore->getOwner() === $user;
    }

    private function canNewGlassesStore(GlassesStore $glassesStore, User $user): bool
    {
        return $this->security->isGranted('ROLE_SELLER');
    }

    private function canDeleteGlassesStore(GlassesStore $glassesStore, User $user): bool
    {
        return $glassesStore->getOwner() === $user;
    }

    private function canEditGlasses(Glasses $glasses, User $user): bool
    {
        return $user->getGlassesStores()->contains($glasses->getGlassesStore());
    }

    private function canNewGlasses(Glasses $glasses, User $user): bool
    {
        return ($this->security->isGranted('ROLE_SELLER') and $user->getGlassesStores()->first());
    }

    private function canDeleteGlasses(Glasses $glasses, User $user): bool
    {
        return $user->getGlassesStores()->contains($glasses->getGlassesStore());
    }
}