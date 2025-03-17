<?php
namespace App\Repository;

use App\Entity\User;
use App\Entity\CartItem;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<CartItem>
 *
 * @method CartItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartItem[]    findAll()
 * @method CartItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    /**
     * @return CartItem[] Returns an array of CartItem objects where the associated Cart is paid and not validated
     */
    public function findPaidCartItems(): array
    {
        return $this->createQueryBuilder('ci')
            ->innerJoin('ci.cart', 'c')
            ->addSelect('c')
            ->innerJoin('c.user', 'u')
            ->addSelect('u')
            ->andWhere('c.paid = :paid')
            ->andWhere('c.validated = :validated')
            ->setParameter('paid', true)
            ->setParameter('validated', false)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return CartItem[] Returns an array of CartItem objects where the associated Cart is paid and not validated
     */
    public function findPaidCartItemsClient(User $user): array
    {
        return $this->createQueryBuilder('ci')
            ->innerJoin('ci.cart', 'c')
            ->addSelect('c')
            ->innerJoin('c.user', 'u')
            ->addSelect('u')
            ->andWhere('c.paid = :paid')
            ->andWhere('c.validated = :validated')
            ->andWhere('c.user = :user')
            ->setParameter('paid', true)
            ->setParameter('validated', false)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}