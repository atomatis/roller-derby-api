<?php

namespace App\DataFixtures;

use App\Enum\TeamCategory;
use App\Enum\TeamLevel;
use Doctrine\Persistence\ObjectManager;

class EventSearchCriteria
{
    public const string DIJON_EVENT_CRITERIA_1 = 'dijon_event_criteria_1';
    public const string DIJON_EVENT_CRITERIA_2 = 'dijon_event_criteria_2';
    public const string MRS_EVENT_CRITERIA_1 = 'mrs_event_criteria_1';
    public const string RENNE_EVENT_CRITERIA_1 = 'renne_event_criteria_1';

    public static function Persist(ObjectManager $entityManager, array $events): array {
        $entities = [];

        $entities[self::DIJON_EVENT_CRITERIA_1] = new \App\Entity\EventSearchCriteria()
            ->setHowMany(2)
            ->setCategories([TeamCategory::WomenAndGenderMinorities])
            ->setEvent($events[Event::DIJON_EVENT_1])
            ->setLevels([TeamLevel::RankTwo, TeamLevel::RankThree])
            ->setWftda(true)
            ->setFlatTrackStatsRankMin(450)
            ->setWftdaRankMin(300)
        ;
        $entityManager->persist($entities[self::DIJON_EVENT_CRITERIA_1]);

        $entities[self::DIJON_EVENT_CRITERIA_2] = new \App\Entity\EventSearchCriteria()
            ->setHowMany(1)
            ->setCategories([TeamCategory::WomenAndGenderMinorities])
            ->setEvent($events[Event::DIJON_EVENT_1])
            ->setLevels([TeamLevel::RankFour, TeamLevel::RankThree, TeamLevel::Casual])
        ;
        $entityManager->persist($entities[self::DIJON_EVENT_CRITERIA_2]);

        $entities[self::MRS_EVENT_CRITERIA_1] = new \App\Entity\EventSearchCriteria()
            ->setHowMany(2)
            ->setCategories([TeamCategory::WomenAndGenderMinorities])
            ->setEvent($events[Event::MRS_EVENT_1])
            ->setLevels([TeamLevel::RankFour, TeamLevel::RankThree, TeamLevel::Casual])
            ->setFlatTrackStatsRankMax(300)
        ;
        $entityManager->persist($entities[self::MRS_EVENT_CRITERIA_1]);

        $entities[self::RENNE_EVENT_CRITERIA_1] = new \App\Entity\EventSearchCriteria()
            ->setHowMany(2)
            ->setCategories([TeamCategory::Open])
            ->setEvent($events[Event::RENNE_EVENT_1])
        ;
        $entityManager->persist($entities[self::RENNE_EVENT_CRITERIA_1]);

        return $entities;
    }
}
