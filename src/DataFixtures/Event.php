<?php

namespace App\DataFixtures;

use App\Enum\EventStatus;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class Event
{
    public const string DIJON_EVENT_1 = 'dijon_search';
    public const string MRS_EVENT_1 = 'mrs_search';
    public const string RENNE_EVENT_1  = 'renne_search';

    public static function Persist(ObjectManager $entityManager, array $clubs): array {
        $entities = [];

        $entities[self::DIJON_EVENT_1] = new \App\Entity\Event()
            ->setId(Uuid::v4())
            ->setName('Fête du slip')
            ->setStatus(EventStatus::SEARCHING)
            ->setStartAt(\DateTimeImmutable::createFromFormat('l', 'saturday')->add(new \DateInterval('P7D')))
            ->setEndAt(\DateTimeImmutable::createFromFormat('l', 'sunday')->add(new \DateInterval('P7D')))
            ->setClub($clubs[Club::DIJON])
        ;
        $entityManager->persist($entities[self::DIJON_EVENT_1]);

        $entities[self::MRS_EVENT_1] = new \App\Entity\Event()
            ->setId(Uuid::v4())
            ->setName('Trackasse le retour')
            ->setStatus(EventStatus::SEARCHING)
            ->setStartAt(\DateTimeImmutable::createFromFormat('l', 'saturday')->add(new \DateInterval('P2M')))
            ->setEndAt(\DateTimeImmutable::createFromFormat('l', 'sunday')->add(new \DateInterval('P2M')))
            ->setClub($clubs[Club::MRS])
        ;
        $entityManager->persist($entities[self::MRS_EVENT_1]);

        $entities[self::RENNE_EVENT_1] = new \App\Entity\Event()
            ->setId(Uuid::v4())
            ->setName('Jam n guns')
            ->setStatus(EventStatus::SEARCHING)
            ->setStartAt(\DateTimeImmutable::createFromFormat('l', 'saturday')->add(new \DateInterval('P4M')))
            ->setEndAt(\DateTimeImmutable::createFromFormat('l', 'sunday')->add(new \DateInterval('P4M')))
            ->setClub($clubs[Club::RENNE])
        ;
        $entityManager->persist($entities[self::RENNE_EVENT_1]);

        return $entities;
    }
}
