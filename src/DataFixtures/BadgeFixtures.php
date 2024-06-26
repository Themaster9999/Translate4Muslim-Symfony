<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class BadgeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $badge = new Badge();
        $badge->setName("Salamu Ailikum!");
        $badge->setTier("Silver");
        
        $manager->persist($badge);


        $manager->flush();
    }
}
