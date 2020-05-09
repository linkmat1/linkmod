<?php

namespace App\Repository\Forums;


use App\Entity\Forums\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }




    /*
     *     public function getforumList(){
        return $this->createQueryBuilder('f')
            ->from('App\Entity\Forums\ForumCategory', 'fc')
            ->where('f.category_id =  fc.id')
            ->getQuery()
            ->getResult();
    }

     */

}
