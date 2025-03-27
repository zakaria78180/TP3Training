<?php

namespace App\Repository;

use App\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Brand>
 *
 * @method Brand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand[]    findAll()
 * @method Brand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brand::class);
    }

    /**
     * Get brands with article count
     * 
     * @return array Array of brands with article count
     */
    public function getBrandsWithArticleCount(): array
    {
        return $this->createQueryBuilder('b')
            ->select('b.id, b.name, COUNT(a.id) as articleCount')
            ->leftJoin('b.articles', 'a')
            ->groupBy('b.id')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

