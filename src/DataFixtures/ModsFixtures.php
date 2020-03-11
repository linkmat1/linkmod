<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\ModCategory;
use App\Entity\Mods;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ModsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $random = rand(50, 900);
        $price = rand(30000, 800000);
        $support = [
            '1' => 'xbox',
            '2' => 'ps4',
            '3' => 'pc'
        ];
        $slug = new Mods();

        for ($i = 0; $i < 150; ++$i) {
            $mods = (new Mods())
             ->setName($faker->sentence(3))
             ->setDescription($faker->text(300))
                ->setCredit($faker->name('M'))
                ->setChevaux($random)
                ->setModel($faker->company)
                ->setPrice($price)
                ->setCertified($faker->boolean)
                ->setWithouterrors($faker->boolean)
                ->setSupport($support)
                ->setColorrims($faker->boolean)
                ->setcolorchoice($faker->boolean)
                ->setCreatedAt($faker->dateTime)
                ->setUrl($faker->url);
            $manager->persist($mods);
        }

        for ($i = 0; $i < 50; ++$i) {
            $brand = (new Brand())
                ->setName($faker->company)
                ->setSlug($faker->slug)
                ->setCreatedAt($faker->dateTime);
            $manager->persist($brand);
        }

        for ($i = 0; $i < 25; ++$i) {
            $type = (new ModCategory())
                ->setName($faker->lastName);
            $manager->persist($type);
        }
        $manager->flush();
    }
}
