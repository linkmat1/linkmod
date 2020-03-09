<?php

namespace App\Repository;

use App\Entity\Content;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Content|null find($id, $lockMode = null, $lockVersion = null)
 * @method Content|null findOneBy(array $criteria, array $orderBy = null)
 * @method Content[]    findAll()
 * @method Content[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Content::class);
    }

    public function getContentToApprouve()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->andwhere('c.isOK != true')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
    public function CountContentToBeApprouved()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->andwhere('c.isOK != true')
            ->getQuery()
            ->useQueryCache(true)
            ->enableResultCache(true, 8600)
            ->getSingleScalarResult();
    }
    public function CountContent()
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->useQueryCache(true)
            ->enableResultCache(true, 8600)
            ->getSingleScalarResult();
    }

    public function getContentALaUnes()
    {
        return $this->createQueryBuilder('c')
            ->andwhere('c.upnews = true AND c.isOK = true')
            ->andwhere('c.publish_at <= :now')
            ->orderBy('c.created_at', 'DESC')
            ->setParameter('now', new \DateTime('now'))
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    public function getContentPublish()
    {
        return $this->createQueryBuilder('c')
            ->andwhere('c.isOK = true')
            ->andwhere('c.publish_at < :now')
            ->orderBy('c.created_at', 'DESC')
            ->setParameter('now', new \DateTime('now'))
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return Content[] Returns an array of Content objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Content
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
