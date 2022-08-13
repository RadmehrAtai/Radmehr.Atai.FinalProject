<?php

namespace App\Subscriber;

use App\Entity\Glasses;
use App\Entity\Order;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;


class CostSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Order) {
            return;
        }
        $product = $entity->getProduct();

        $entity->setTotalCost($product->getPrice());
    }
}