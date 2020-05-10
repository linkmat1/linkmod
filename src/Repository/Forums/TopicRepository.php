<?php

namespace App\Repository\Forums;

use App\Entity\Forums\Tag;
use App\Entity\Forums\Topic;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Topic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topic[]    findAll()
 * @method Topic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Topic::class);
    }

    public function queryAllForTag(?Tag $tag): Query
    {
        $query = $this->createQueryBuilder('t')
            ->setMaxResults(20)
            ->orderBy('t.createdAt', 'DESC');
        if ($tag) {
            $tags = [$tag];
            if ($tag->getChildren()->count() > 0) {
                $tags = $tag->getChildren()->toArray();
            }
            $query
                ->join('t.tags', 'tag')
                ->where('tag IN (:tags)')
                ->setParameter('tags', $tags);
        }
        return $query->getQuery();
    }

    public function findAllBatched(): iterable
    {
        $limit = 0;
        $perPage = 1000;
        while (true) {
            $rows = $this->createQueryBuilder('t')
                ->setMaxResults($perPage)
                ->setFirstResult($limit)
                ->getQuery()
                ->getResult();
            if (empty($rows)) {
                break;
            }
            foreach ($rows as $row) {
                yield $row;
            }
            $limit += $perPage;
            $this->getEntityManager()->clear();
        }
    }

    public function countForUser(User $user): int
    {
        return $this->count(['user' => $user]);
    }
}
