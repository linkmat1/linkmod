<?php

namespace App\Repository;

use App\Entity\ModCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ModCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModCategory[]    findAll()
 * @method ModCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModCategory::class);
    }

    // /**
    //  * @return ModCategory[] Returns an array of ModCategory objects
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
    public function findOneBySomeField($value): ?ModCategory
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
