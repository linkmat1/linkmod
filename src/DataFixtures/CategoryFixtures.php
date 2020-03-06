<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 15; ++$i) {
            $category = (new Category())
                ->setTitle($faker->sentence(3))
                ->setDescription($faker->text)
                ->setType($faker->sentence(2));
            $category->setSlug($category->getTitle());
            $manager->persist($category);
        }

        $manager->flush();
    }
}
