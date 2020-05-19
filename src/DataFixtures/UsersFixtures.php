<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
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


    public function load(ObjectManager $manager):void
    {
        $faker = Factory::create();

        $link = (new User())
            ->setUsername('linkmat')
            ->setEmail('linkmat@admin.com')
            ->setRoles(['CMS_MASTER']);
        $plain6 = "admin";
        $encode6 = $this->encoder->encodePassword($link, $plain6);
        $link->setPassword($encode6);
        $manager->persist($link);
        $manager->flush();

        for ($i = 0; $i < 50; ++$i) {
            $test = new User();
            $test->setUsername($faker->userName);
            $test->setEmail($faker->email);
            $test->setRoles(['ROLE_USER']);
            $plain2 = "admin";
            $encode2 = $this->encoder->encodePassword($test, $plain2);
            $test->setPassword($encode2);
            $manager->persist($test);
        }
        $user2 = (new User())
            ->setUsername('user')
            ->setEmail('admi2n@admin.com')
            ->setRoles(['ROLE_USER']);
        $plain2 = "admin";
        $encode2 = $this->encoder->encodePassword($user2, $plain2);
        $user2->setPassword($encode2);
        $manager->persist($user2);

        $user3 = (new User())
            ->setUsername('editeur')
            ->setEmail('admiQWQn@admin.com')

            ->setRoles(['ROLE_EDITOR']);
        $plain3 = "admin";
        $encode3 = $this->encoder->encodePassword($user3, $plain3);
        $user2->setPassword($encode3);
        $manager->persist($user3);

        $user4 = (new User())
            ->setUsername('modo')
            ->setEmail('DSdwadadS@admin.com')
            ->setRoles(['ROLE_MODO']);
        $plain4 = "admin";
        $encode4 = $this->encoder->encodePassword($user4, $plain4);
        $user4->setPassword($encode4);
        $manager->persist($user4);

        $user5 = (new User())
            ->setUsername('admin')
            ->setEmail('DSdadS@admin.com')
            ->setRoles(['ROLE_MANAGE']);
        $plain5 = "admin";
        $encode5 = $this->encoder->encodePassword($user5, $plain5);
        $user5->setPassword($encode5);
        $manager->persist($user5);
        $manager->flush();




        $manager->flush();
    }
}
