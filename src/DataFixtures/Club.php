<?php

namespace App\DataFixtures;

use App\Enum\ClubGenderDiversityPolicy;
use App\Enum\Country;
use App\Enum\CountrySubdivision;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class Club
{
    public const string DIJON = 'dijon';
    public const string MRS = 'mrs';
    public const string RENNE = 'renne';

    public static function Persist(ObjectManager $objectManager): array {
        $entities = [];

        $entities[self::DIJON] = new \App\Entity\Club()
            ->setId(Uuid::v4())
            ->setName('Amsports Roller Derby Dijon')
            ->setGenderDiversityPolicy(ClubGenderDiversityPolicy::Mixed)
            ->setCountryCode(Country::FRANCE)
            ->setCountrySubdivisionCode(CountrySubdivision::FrBfc)
            ->setCities(['Dijon'])
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $objectManager->persist($entities[self::DIJON]);

        $entities[self::MRS] = new \App\Entity\Club()
            ->setId(Uuid::v4())
            ->setName('Massilia Roller Super')
            ->setAlias('MRS')
            ->setGenderDiversityPolicy(ClubGenderDiversityPolicy::ChosenNonMixity)
            ->setCountryCode(Country::FRANCE)
            ->setCountrySubdivisionCode(CountrySubdivision::FrPac)
            ->setCities(['Marseille'])
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $objectManager->persist($entities[self::MRS]);

        $entities[self::RENNE] = new \App\Entity\Club()
            ->setId(Uuid::v4())
            ->setName('Flat Track Derby Rennes')
            ->setEmail("mensderbyrennes@gmail.com")
            ->setAlias('FRDT')
            ->setGenderDiversityPolicy(ClubGenderDiversityPolicy::Mixed)
            ->setCountrySubdivisionCode(CountrySubdivision::FrBre)
            ->setCities(['Rennes'])
            ->setCreatedAt(new \DateTimeImmutable())
            ->setUpdatedAt(new \DateTimeImmutable())
        ;
        $objectManager->persist($entities[self::RENNE]);

        return $entities;
    }
}
