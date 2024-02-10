<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Orders;
use App\Repository\Interfaces\OrderRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @extends ServiceEntityRepository<Orders>
 *
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    public function save(Orders $order): void
    {
        $this->getEntityManager()->persist($order);
        $this->getEntityManager()->flush();
    }

    public function remove(Uuid $id): void
    {
        $order = $this->getOrderById($id);

        $this->getEntityManager()->remove($order);
        $this->getEntityManager()->flush();
    }

    public function getById(Uuid $id): ?array
    {
        return $this->createQueryBuilder('o')
            ->where('o.userField =:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();
    }

    public function getOrderById(Uuid $id): ?Orders
    {
        return $this->createQueryBuilder('o')
            ->where('o.id =:id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
