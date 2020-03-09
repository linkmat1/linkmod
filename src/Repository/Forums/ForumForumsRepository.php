<?php

namespace App\Repository\Forums;

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

    public function getforumList()
    {
        return $this->createQueryBuilder("f")
            ->leftJoin('App\Entity\Forums\ForumCategory', 'c', 'WITH', 'c.id = f.category_id')
            //->from('App\Entity\Forums\ForumCategory','c')
            ->addSelect('c')
            ->where('f.category_id = c.id')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();
        /* return $this->createQueryBuilder('f')
             ->from('', 'fc')
             ->where('f.category_id =  fc.id')
             ->getQuery()
             ->getResult();*/


    }

}
