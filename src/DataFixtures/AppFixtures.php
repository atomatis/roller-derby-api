<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Enum\EventStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 20; $i++) {
            $startAt = $this->getRandomActiveDate();
            $endAt = $this->getRandomActiveDate();

            $event = new Event()
                ->setId(Uuid::v4())
                ->setName('Event lorem ispum hae tess '.$i)
                ->setStatus(EventStatus::SEARCHING)
                ->setStartAt($startAt)
                ->setEndAt($endAt);
            $manager->persist($event);
        }

        $manager->flush();
    }

    private function getRandomActiveDate(): \DateTimeImmutable
    {
        $now = new \DateTimeImmutable('sunday');
        $interval = new \DateInterval( sprintf('P%dD', rand(0, 10) * 7));
        return $now->add($interval);
    }
}
