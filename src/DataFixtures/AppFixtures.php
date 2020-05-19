<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Posts;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    private \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager):void
    {
        //$article->setUser($this->getReference(UserFixtures::USER_REFERENCE));

        $cat =  (new Category())
            ->setCreatedAt(new \DateTime())
            ->setName($this->faker->sentence(3))
            ->setContent($this->faker->sentences)
            ->setColor($this->faker->hexColor);
        $manager->persist();

        $posts = (new Posts())
            ->setTitle($this->faker->sentence(3))
            ->setContent($this->faker->sentences)
            ->setCategory($this->getReference())
            ->setCreatedAt(new \DateTime());
        $manager->persist($posts);
        $manager->flush();
    }
}
