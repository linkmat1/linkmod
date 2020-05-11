<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Posts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Posts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Posts[]    findAll()
 * @method Posts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    public function getPostForPublic(?Category $category = null): Query {

        $query =  $this->createQueryBuilder('p')
            ->select('p')
            ->andWhere('p.isOnline = true')
            ->andWhere('p.publishAt <= :now')
            ->orderBy('p.publishAt', 'DESC')
            ->setParameter('now', new \DateTime('now'));

        if ($category) {
            $query = $query
                ->andWhere('p.category = :category')
                ->setParameter('category', $category);
        }
        return $query->getQuery();

    }
    // /**
    //  * @return Posts[] Returns an array of Posts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Posts
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
