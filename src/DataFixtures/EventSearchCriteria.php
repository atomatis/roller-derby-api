<?php

namespace App\DataFixtures;

use App\Enum\TeamCategory;
use Doctrine\Persistence\ObjectManager;

class EventSearchCriteria
{
    public const string DIJON_EVENT_CRITERIA_1 = 'dijon_event_criteria_1';
    public const string MRS = 'mrs';
    public const string RENNE = 'renne';

    public static function Persist(ObjectManager $entityManager, array $events): array {
        $entities = [];

        $entities[self::DIJON_EVENT_CRITERIA_1] = new \App\Entity\EventSearchCriteria()
//            ->setId(Uuid::v4())
            ->setHowMany(2)
            ->setCategories([TeamCategory::WomenAndGenderMinorities])
            ->setEvent($events[Event::DIJON_EVENT_1])
        ;
        $entityManager->persist($entities[self::DIJON_EVENT_CRITERIA_1]);

        return $entities;
    }
}
