<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByState($state = null)
    {

        $query = $this->createQueryBuilder('p');
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->where('p.state = :etat')
            ->setParameter('etat', $state)
            ->orderBy('p.rating', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function findByCategory($category = null)
    {

        $query = $this->createQueryBuilder('p');
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->where('p.category = :cat')
            ->setParameter('cat', $category)
            ->orderBy('p.rating', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function findByStateCategory($state = null, $category = null)
    {

        $query = $this->createQueryBuilder('p');
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->where('p.category = :cat')
            ->setParameter('cat', $category)
            ->orderBy('p.rating', 'DESC')
            ->andWhere('p.state = :etat')
            ->setParameter('etat', $state);

        return $qb->getQuery()->getResult();
    }



//    /**
//     * @return Post[] Returns an array of Post objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Post
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findMostLikedPostsInAYear()
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p')
            ->leftJoin('p.likes', 'l')
            ->leftJoin('p.owner', 'u')
            ->where('p.createdAt >= :lastYear')
            ->setParameter('lastYear', new \DateTime('-1 year'))
            ->groupBy('p.id')
            ->orderBy('COUNT(l.id)', 'DESC')
            ->setMaxResults(15);

        return $qb->getQuery()->getResult();
    }


    public function findBySearch($input = null)
    {

        $query = $this->createQueryBuilder('p');
        $qb = $this->createQueryBuilder('p');

        $qb->select('p')
            ->join('p.owner', 'o')
            ->where(
                $qb->expr()->orX(
                    $qb->expr()->like('LOWER(p.description)', ':input'),
                    $qb->expr()->like('LOWER(o.username)', ':input')
                )
            )
            ->setParameter('input', '%'.strtolower($input).'%')
            ->orderBy('p.rating', 'DESC');


        return $qb->getQuery()->getResult();
    }
    public function findPosts($state = null, $category = null, $input = null)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.owner', 'o');

        if ($state !== null) {
            $queryBuilder->andWhere('p.state = :state')
                ->setParameter('state', $state);
        }

        if ($category !== null) {
            $queryBuilder->andWhere('p.category = :category')
                ->setParameter('category', $category);
        }

        if ($input !== null) {
            $queryBuilder->andWhere(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->like('LOWER(p.description)', ':input'),
                    $queryBuilder->expr()->like('LOWER(o.username)', ':input')
                )
            )
                ->setParameter('input', '%'.strtolower($input).'%');
        }

        return $queryBuilder->getQuery()->getResult();
    }


}
