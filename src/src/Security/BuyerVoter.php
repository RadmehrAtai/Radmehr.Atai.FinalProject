<?php

namespace App\Security;

use App\Entity\GlassesStore;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;


class BuyerVoter extends Voter
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

        // only vote on `Order` objects
        if (!$subject instanceof Order) {
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

        /** @var Order $order */
        $order = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView();
            case self::EDIT:
                return $this->canEdit($order, $user);
            case self::NEW:
                return $this->canNew($order, $user);
            case self::DELETE:
                return $this->canDelete($order, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(): bool
    {
        return $this->security->isGranted('ROLE_BUYER');
    }

    private function canEdit(Order $order, User $user): bool
    {
        return $order->getBuyer() === $user;
    }

    private function canNew(Order $order, User $user): bool
    {
        return $this->security->isGranted('ROLE_BUYER');
    }

    private function canDelete(Order $order, User $user): bool
    {
        return $order->getBuyer() === $user;
    }
}