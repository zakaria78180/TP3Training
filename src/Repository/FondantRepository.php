<?php

namespace App\Repository;

use App\Entity\Fondant;
use Doctrine\ORM\Query;
use App\Model\FiltreFondant;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Fondant>
 *
 * @method Fondant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fondant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fondant[]    findAll()
 * @method Fondant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FondantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fondant::class);
    }

    /**
    * @return Fondant[] Returns an array of Fondant objects
    */
    public function ListeFondants(FiltreFondant $filtre=null): array
    {
        $query = $this->createQueryBuilder('f')
        ->select('f')
        ->orderBy('f.nom', 'ASC');
        if(!empty($filtre->nom))
        {
            $query->andWhere('f.nom LIKE :filtre')
            ->setParameter('filtre', "%$filtre->nom%");
        }
        
        return $query->getQuery()->getResult();
    }

    /**
     * Find fondants by name using a LIKE query.
     *
     * @param string $searchTerm
     * @return Fondant[]
     */
    public function findByNom(string $searchTerm) :array
   {
        return $this->createQueryBuilder('f')
        ->where('f.nom LIKE :searchTerm')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->getQuery()
        ->getResult();
   }
}
