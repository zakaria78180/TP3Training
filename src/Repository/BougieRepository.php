<?php

namespace App\Repository;

use App\Entity\Bougie;
use Doctrine\ORM\Query;
use App\Model\FiltreBougie;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Bougie>
 *
 * @method Bougie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bougie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bougie[]    findAll()
 * @method Bougie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BougieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bougie::class);
    }

    /**
    * @return Bougie[] Returns an array of Bougie objects
    */
    public function ListeBougies(FiltreBougie $filtre=null): array
    {
        $query = $this->createQueryBuilder('b')
        ->select('b')
        ->orderBy('b.nom', 'ASC');
        if(!empty($filtre->nom))
        {
            $query->andWhere('b.nom LIKE :filtre')
            ->setParameter('filtre', "%$filtre->nom%");
        }
        
        return $query->getQuery()->getResult();
    }

    /**
     * Find bougies by name using a LIKE query.
     *
     * @param string $searchTerm
     * @return Bougie[]
     */
    public function findByNom(string $searchTerm) :array
   {
        return $this->createQueryBuilder('b')
        ->where('b.nom LIKE :searchTerm')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->getQuery()
        ->getResult();
   }
}
