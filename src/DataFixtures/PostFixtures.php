<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PostFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $post =  new Post();
            $post->setTitle($faker->sentence(4));
            $post->setSlug($faker->slug);
            $post->setContent($faker->text(2000));
            $post->setIsOnline($faker->boolean);
            $post->setCreatedAt($faker->dateTime);
            $post->setUpdatedAt($faker->dateTime);
            $manager->persist($post);
        }


        $manager->flush();
    }
}
