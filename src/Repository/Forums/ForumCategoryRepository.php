<?php

namespace App\Repository\Forums;

use App\Entity\Forums\ForumCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ForumCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumCategory[]    findAll()
 * @method ForumCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumCategory::class);
    }

    public function getforumList()
    {

        $conn = $this->getEntityManager()->getConnection()->query('
SELECT * FROM  forum_forums as f, forum_category as c WHERE C.id = f.category_id')->execute();

        //    ->select('c.title, c.id, c.position')
        //  ->leftJoin('App\Entity\Forums\ForumForums','f')
        //  ->addSelect('f.title, f.description')
        //->from('App\Entity\Forums\ForumForums', 'f2')
        //
        //
        //

        //->orderBy('c.id','desc')
        //   ->orderBy('c.id')

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
