<?php

namespace App\Repository;

use App\Entity\Forums\ForumForums;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ForumForums|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumForums|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumForums[]    findAll()
 * @method ForumForums[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumForumsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumForums::class);
    }

    // /**
    //  * @return ForumForums[] Returns an array of ForumForums objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForumForums
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
