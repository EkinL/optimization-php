<?php
namespace App\Repository;

use App\Entity\Galaxy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GalaxyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Galaxy::class);
    }

    public function findAllWithModeles(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT g.id as id, g.title as title, g.description as description, df.id as file_id
             FROM App\Entity\Galaxy g
             INNER JOIN App\Entity\Modeles m WITH g.modele = m.id
             INNER JOIN App\Entity\ModelesFiles mf WITH m.id = mf.modeles_id
             INNER JOIN App\Entity\DirectusFiles df WITH mf.directus_files_id = df.id'
        );

        $results = $query->getResult();

        // Organiser les résultats pour grouper les fichiers sous chaque galaxy
        $galaxies = [];

        foreach ($results as $result) {
            $galaxyId = $result['id'];

            if (!isset($galaxies[$galaxyId])) {
                $galaxies[$galaxyId] = [
                    'id' => $result['id'],
                    'title' => $result['title'],
                    'description' => $result['description'],
                    'files' => [],
                ];
            }

            // Ajouter les fichiers liés à cette Galaxy
            $galaxies[$galaxyId]['files'][] = $result['file_id'];
        }

        return array_values($galaxies); // Retourne un tableau indexé proprement
    }
}