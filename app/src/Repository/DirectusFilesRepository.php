<?php
namespace App\Repository;

use App\Entity\DirectusFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DirectusFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DirectusFiles::class);
    }

    public function findFilesByIds(array $ids): array
    {
        return $this->createQueryBuilder('df')
            ->where('df.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()
            ->getResult();
    }
}