<?php

namespace App\Repository;

use App\Entity\DiffuseurVoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiffuseurVoiture>
 *
 * @method DiffuseurVoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiffuseurVoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiffuseurVoiture[]    findAll()
 * @method DiffuseurVoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiffuseurVoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiffuseurVoiture::class);
    }
}
