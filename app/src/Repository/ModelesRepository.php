<?php
namespace App\Repository;

use App\Entity\Modeles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ModelesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modeles::class);
    }

    public function findModelById(string $modelesId): ?Modeles
    {
        return $this->createQueryBuilder('m')
            ->where('m.id = :modelesId')
            ->setParameter('modelesId', $modelesId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}