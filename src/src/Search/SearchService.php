<?php

namespace App\Search;

use App\Entity\Glasses;
use Doctrine\ORM\EntityManagerInterface;

class SearchService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function search($input)
    {
        $input = str_replace("%", "[%]", $input);

        $hotelRepository = $this->entityManager->getRepository(Glasses::class);
        return $hotelRepository->createQueryBuilder('h')
            ->where('h.model like :q OR h.brand like :q')
            ->setParameter('q', '%' . $input . '%')
            ->getQuery()
            ->getResult();
    }
}