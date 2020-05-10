<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
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
        for ($i = 0; $i < 200; ++$i) {
            $faker = Factory::create();
            $test = new User();
            $test->setUsername($faker->userName);
            $test->setEmail($faker->email);
            $test->setRoles(['ROLE_USER']);
            $test->setCreatedAt(new \DateTime());
            $plain2 = "admin";
            $encode2 = $this->encoder->encodePassword($test, $plain2);
            $test->setPassword($encode2);
            $manager->persist($test);
        }
        $user2 = (new User())
            ->setUsername('user')
            ->setCreatedAt(new \DateTime())
            ->setEmail('admi2n@admin.com')
            ->setRoles(['ROLE_USER']);
        $plain2 = "admin";
        $encode2 = $this->encoder->encodePassword($user2, $plain2);
        $user2->setPassword($encode2);
        $manager->persist($user2);

        $user3 = (new User())
            ->setUsername('editeur')
            ->setEmail('admiQWQn@admin.com')
            ->setCreatedAt(new \DateTime())
            ->setRoles(['ROLE_EDITOR']);
        $plain3 = "admin";
        $encode3 = $this->encoder->encodePassword($user3, $plain3);
        $user2->setPassword($encode3);
        $manager->persist($user3);

        $user4 = (new User())
            ->setUsername('modo')
            ->setEmail('DSdwadadS@admin.com')
            ->setCreatedAt(new \DateTime())
            ->setRoles(['ROLE_MODO']);
        $plain4 = "admin";
        $encode4 = $this->encoder->encodePassword($user4, $plain4);
        $user4->setPassword($encode4);
        $manager->persist($user4);

        $user5 = (new User())
            ->setUsername('admin')
            ->setEmail('DSdadS@admin.com')
            ->setCreatedAt(new \DateTime())
            ->setRoles(['ROLE_ADMIN']);
        $plain5 = "admin";
        $encode5 = $this->encoder->encodePassword($user5, $plain5);
        $user5->setPassword($encode5);
        $manager->persist($user5);
        $manager->flush();
        $faker = Factory::create();

        $manager->flush();
    }
}
