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
                ->setIsOnline($faker->boolean)
                ->setSlug($faker->slug(4))
                ->setShortdesc($faker->text(200));


            $manager->persist($category);
        }
        $manager->flush();
    }
}
