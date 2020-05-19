<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Posts;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CategoryFixtures extends Fixture
{


    private \Faker\Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager):void
    {
        for ($i = 0; $i < 15; ++$i) {
            $cat = (new Category())
                ->setCreatedAt(new \DateTime())
                ->setName($this->faker->sentence(3))
                ->setContent($this->faker->paragraph(3))
                ->setColor($this->faker->hexColor);
            $manager->persist($cat);
            $manager->flush();
        }
    }
}
