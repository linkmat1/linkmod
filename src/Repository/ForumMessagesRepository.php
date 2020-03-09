<?php

namespace App\Repository;

use App\Entity\Forums\ForumMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ForumMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumMessages[]    findAll()
 * @method ForumMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumMessages::class);
    }

    // /**
    //  * @return ForumMessages[] Returns an array of ForumMessages objects
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
    public function findOneBySomeField($value): ?ForumMessages
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
