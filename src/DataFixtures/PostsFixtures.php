<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Posts;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PostsFixtures extends Fixture
{


    private \Faker\Generator $faker;
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $r;

    public function __construct(CategoryRepository $r)
    {
        $this->faker = Factory::create();
        $this->r = $r;
    }

    public function load(ObjectManager $manager):void
    {
        for ($i = 0; $i < 50; ++$i) {
            $posts = (new Posts())
                ->setTitle($this->faker->sentence(3))
                ->setContent($this->faker->paragraph(3))
                ->setCategory($this->r->getlastCategory())
                ->setCreatedAt(new \DateTime());
            $manager->persist($posts);
            $manager->flush();
        }
    }



}
