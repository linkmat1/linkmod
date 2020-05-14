<?php


namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Content\Episodes;
use App\Entity\Posts;
use App\Entity\User;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ContentFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $user = (new User())
            ->setUsername('linkmat')
            ->setEmail('admin@admin.com')
            ->setCreatedAt(new \DateTime())
            ->setRoles(['ROLE_SUPERADMIN']);
        $plain = "admin";
        $encode = $this->encoder->encodePassword($user, $plain);
        $user->setPassword($encode);

        $manager->persist($user);
        for ($i = 0; $i < 10; ++$i) {
            $category = (new Category())
                ->setName($faker->sentence(3))
                ->setIsOnline($faker->boolean)
                ->setAuthor($user)
                ->setCreatedAt(new \DateTime())
                ->setUpdatedAt(new \DateTime())
                ->setIsOnline(true);
            $manager->persist($category);

        }

        for ($i = 0; $i < 200; ++$i) {
            $post = (new Posts())
                ->setTitle($faker->sentence(6))
                ->setAuthor($user)
                ->setCreatedAt(new \DateTime())
                ->setContent($faker->paragraph);
            $manager->persist($post);
        }

        $manager->flush();
    }
}
