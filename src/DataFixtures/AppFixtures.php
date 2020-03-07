<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
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
        $user = (new User())
        ->setUsername('linkmat')
        ->setEmail('admin@admin.com')
        ->setRoles(['ROLE_SUPERADMIN']);
        $plain = "admin";
        $encode = $this->encoder->encodePassword($user, $plain);
        $user->setPassword($encode);

        $manager->persist($user);

        $user2 = (new User())
            ->setUsername('user')
            ->setEmail('admi2n@admin.com')
            ->setRoles(['ROLE_USER']);
        $plain2 = "user";
        $encode2 = $this->encoder->encodePassword($user, $plain2);
        $user2->setPassword($encode2);
        $manager->persist($user2);
        $manager->flush();
    }
}
