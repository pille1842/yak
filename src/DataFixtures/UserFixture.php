<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    public const USER1_REFERENCE = 'user-1';
    public const USER2_REFERENCE = 'user-2';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Create 5 test users (test1 to test5) with a corresponding password
        for ($i = 1; $i <= 5; $i++) {
            $nameAndPassword = 'test' . $i;
            $user = new User();
            $user->setUsername($nameAndPassword);
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,
                    $nameAndPassword
                )
            );
            $manager->persist($user);

            // Add a reference to the first two users for use in other fixtures
            if ($i == 1) {
                $this->addReference(self::USER1_REFERENCE, $user);
            } elseif ($i == 2) {
                $this->addReference(self::USER2_REFERENCE, $user);
            }
        }

        $manager->flush();
    }
}
