<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $clubs = Club::Persist($manager);
        $teams = Team::Persist($manager, $clubs);
        $events = Event::Persist($manager, $clubs);
        $eventCriteria = EventSearchCriteria::Persist($manager, $events);

        $manager->flush();
    }
}
