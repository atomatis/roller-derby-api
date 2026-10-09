<?php

namespace App\DataFixtures;

use App\Enum\ClubGenderDiversityPolicy;
use App\Enum\Country;
use App\Enum\CountrySubdivision;
use App\Enum\TeamCategory;
use App\Enum\TeamLevel;
use App\Enum\TeamType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class Team
{
    public const string DIJON_FLECHES = 'dijon_fleches';
    public const string DIJON_ARROWBASES = 'dijon_arrowbases';
    public const string DIJON_ARCHERE = 'dijon_archere';
    public const string DIJON_VOODOO = 'dijon_voodoo';
    public const string DIJON_BURGUNDY = 'dijon_burgondy';
    public const string MRS = 'mrs';
    public const string RENNE = 'renne';

    public static function Persist(ObjectManager $objectManager, array $clubs): array {
        $entities = [];

        $entities[self::DIJON_ARROWBASES] = new \App\Entity\Team()
            ->setId(Uuid::v4())
            ->setName('Arrowbases')
            ->setCategory(TeamCategory::JuniorOpen)
            ->setType(TeamType::TeamA)
            ->setClub($clubs[Club::DIJON])
            ->setLevel(TeamLevel::RankOne)
            ->setPronoun('Les ')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $objectManager->persist($entities[self::DIJON_ARROWBASES]);

        $entities[self::DIJON_ARCHERE] = new \App\Entity\Team()
            ->setId(Uuid::v4())
            ->setName('Archères')
            ->setCategory(TeamCategory::WomenAndGenderMinorities)
            ->setType(TeamType::TeamC)
            ->setClub($clubs[Club::DIJON])
            ->setLevel(TeamLevel::RankFour)
            ->setPronoun('Les ')
            ->setFlatTrackStatsId(121960)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $objectManager->persist($entities[self::DIJON_ARCHERE]);

        $entities[self::DIJON_VOODOO] = new \App\Entity\Team()
            ->setId(Uuid::v4())
            ->setName('Voodoo Revêches')
            ->setCategory(TeamCategory::WomenAndGenderMinorities)
            ->setType(TeamType::Alliance)
            ->setClub($clubs[Club::DIJON])
            ->setPronoun('Les ')
            ->setLevel(TeamLevel::RankThree)
            ->setFlatTrackStatsId(118689)
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $objectManager->persist($entities[self::DIJON_VOODOO]);

        $entities[self::DIJON_BURGUNDY] = new \App\Entity\Team()
            ->setId(Uuid::v4())
            ->setName('Burgundy Derby Crew')
            ->setCategory(TeamCategory::Open)
            ->setType(TeamType::TeamA)
            ->setLevel(TeamLevel::RankTwo)
            ->setClub($clubs[Club::DIJON])
            ->setFlatTrackStatsId(111444)
            ->setMrda(true)
            ->setCreatedAt(new \DateTimeImmutable("2019-09-21T09:42:48+00:00"))
            ->setUpdatedAt(new \DateTimeImmutable("2019-09-21T09:42:48+00:00"))
        ;
        $objectManager->persist($entities[self::DIJON_BURGUNDY]);

        $entities[self::DIJON_FLECHES] = new \App\Entity\Team()
            ->setId(Uuid::v4())
            ->setName('Flêches revêches')
            ->setCategory(TeamCategory::WomenAndGenderMinorities)
            ->setType(TeamType::TeamA)
            ->setLevel(TeamLevel::RankTwo)
            ->setClub($clubs[Club::DIJON])
            ->setFlatTrackStatsId(87004)
            ->setPronoun('Les ')
            ->setWftda(true)
            ->setCreatedAt(new \DateTimeImmutable("2013-06-01T09:42:48+00:00"))
            ->setUpdatedAt(new \DateTimeImmutable("2013-06-01T09:42:48+00:00"))
        ;
        $objectManager->persist($entities[self::DIJON_FLECHES]);

        $entities[self::MRS] = new \App\Entity\Team()
            ->setId(Uuid::v4())
            ->setName('Pires Rat/es')
            ->setCategory(TeamCategory::WomenAndGenderMinorities)
            ->setType(TeamType::TeamA)
            ->setLevel(TeamLevel::RankThree)
            ->setClub($clubs[Club::MRS])
            ->setFlatTrackStatsId(114234)
            ->setPronoun('Les ')
            ->setCreatedAt(new \DateTimeImmutable("2022-06-19T09:42:48+00:00"))
            ->setUpdatedAt(new \DateTimeImmutable("2022-06-19T09:42:48+00:00"))
        ;
        $objectManager->persist($entities[self::MRS]);

        return $entities;
    }
}
