<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("spipa7.tv@gmail.com");
        $user->setUsername("spipa7");
        $user->setPassword(password_hash("123456789",PASSWORD_DEFAULT));
        
        $manager->persist($user);


        $manager->flush();
    }
}
