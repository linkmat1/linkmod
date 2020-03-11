<?php

namespace App\Repository;


use App\Entity\ModCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ModCateogry|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModCateogry|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModCateogry[]    findAll()
 * @method ModCateogry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModCateogryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModCategory::class);
    }

    // /**
    //  * @return ModCateogry[] Returns an array of ModCateogry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModCateogry
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
