<?php

namespace App\Repository;

use App\Entity\Poudre;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Poudre>
 *
 * @method Poudre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poudre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poudre[]    findAll()
 * @method Poudre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoudreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poudre::class);
    }

   /**
    * @return Poudre[] Returns an array of Poudre objects
    */
   public function listePoudres(): array
   {
       return $this->createQueryBuilder('pou')
            ->select('pou')
            ->orderBy('pou.id', 'ASC')
            ->getQuery()
            ->getResult()
       ;
   }

   /**
    * @return Query[] Returns an array of Poudre objects
    */
    public function listePoudresComplete(): Query
    {
        return $this->createQueryBuilder('pou')
             ->select('pou')
             ->orderBy('pou.id', 'ASC')
             ->getQuery()
             ->getResult()
        ;
    }

    public function findByNom(string $searchTerm) :array
   {
        return $this->createQueryBuilder('pou')
        ->where('pou.nom LIKE :searchTerm')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->getQuery()
        ->getResult();
   }

//    public function findOneBySomeField($value): ?Poudre
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
