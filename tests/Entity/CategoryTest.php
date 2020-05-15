<?php

namespace App\Tests\Entity;


use App\Entity\Category;

use App\Tests\FixturesTrait;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{
    use FixturesTrait;
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
    public function testIfContentIsValid() {
        $users = $this->loadFixtures(['users']);
        $category2 = ( new Category())->setName('This is a title')->setContent('1')->setCreatedAt(new \DateTime())->setAuthor($users['user_admin']);
        $this->entityManager->persist($category2);
        $this->entityManager->flush();
        $this->assertSame('This is a title',  $category2->getName());

    }
}