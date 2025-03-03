<?php
namespace App\Repository;

use App\Entity\ModelesFiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ModelesFilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelesFiles::class);
    }

    public function findFilesByModelesId(string $modelesId): array
    {
        return $this->createQueryBuilder('mf')
            ->where('mf.modeles_id = :modelesId')
            ->setParameter('modelesId', $modelesId)
            ->getQuery()
            ->getResult();
    }
}