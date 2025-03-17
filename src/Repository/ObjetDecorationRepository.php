<?php

namespace App\Repository;

use App\Entity\ObjetDecoration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ObjetDecoration>
 *
 * @method ObjetDecoration|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjetDecoration|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjetDecoration[]    findAll()
 * @method ObjetDecoration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetDecorationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjetDecoration::class);
    }

   /**
    * @return ObjetDecoration[] Returns an array of ObjetDecoration objects
    */
   public function listeObjetsDecoration(): array
   {
       return $this->createQueryBuilder('obj')
            ->select('obj')
            ->orderBy('obj.id', 'ASC')
            ->getQuery()
            ->getResult()
       ;
   }

   /**
    * @return Query Returns a Query object for ObjetDecoration
    */
    public function listeObjetsDecorationComplete(): Query
    {
        return $this->createQueryBuilder('obj')
             ->select('obj')
             ->orderBy('obj.id', 'ASC')
             ->getQuery();
    }

//    public function findOneBySomeField($value): ?ObjetDecoration
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
