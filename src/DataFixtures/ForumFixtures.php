<?php

namespace App\DataFixtures;

use App\Entity\Forums\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ForumFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @param ObjectManager $manager
     *
     */


    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 28; ++$i) {
            $faker = Factory::create();
            $tag = (new Tag())
                ->setName($faker->sentence(1))
                ->setDescription($faker->sentence(3))
                ->setCreatedAt(new \DateTime())
                ->setSlug($faker->slug(2))
                ->setColor($faker->hexColor)
                ->setParent(null)
                ->setPosition(1);

            $manager->persist($tag);
        }


        $manager->flush();
    }
}
