<?php

namespace App\Repository;

use App\Entity\Notification;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;


/**
 * @extends ServiceEntityRepository<Notification>
 *
 * @method Notification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notification[]    findAll()
 * @method Notification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function save(Notification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Notification $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findNotificationsByUserId(User $user)
    {
        $qb = $this->createQueryBuilder('n');
        $qb->select('n')
            ->leftJoin('n.targetPost', 'p')
            ->where('p.owner = :user')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }

    public function findUnreadNotifications(User $user)
    {
        $qb = $this->createQueryBuilder('n');

        $qb->select('n')
            ->leftJoin('n.targetPost', 'p')
            ->where('p.owner = :user')
            ->andWhere('n.isRead = false')
            ->setParameter('user', $user);

        return $qb->getQuery()->getResult();
    }




//    /**
//     * @return Notification[] Returns an array of Notification objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Notification
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
