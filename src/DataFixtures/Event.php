<?php

namespace App\DataFixtures;

use App\Enum\EventStatus;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class Event
{
    public const string DIJON_EVENT_1 = 'dijon_search';
    public const string MRS = 'mrs';
    public const string RENNE = 'renne';

    public static function Persist(ObjectManager $entityManager, array $clubs): array {
        $entities = [];

        $entities[self::DIJON_EVENT_1] = new \App\Entity\Event()
            ->setId(Uuid::v4())
            ->setName('Fêtes du track rennoi')
            ->setStatus(EventStatus::SEARCHING)
            ->setStartAt(\DateTimeImmutable::createFromFormat('l', 'saturday')->add(new \DateInterval('P7D')))
            ->setEndAt(\DateTimeImmutable::createFromFormat('l', 'sunday')->add(new \DateInterval('P7D')))
            ->setClub($clubs[Club::DIJON])
        ;
        $entityManager->persist($entities[self::DIJON_EVENT_1]);


        return $entities;
    }
}
