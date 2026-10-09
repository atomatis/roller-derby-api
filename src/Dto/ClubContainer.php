<?php

namespace App\Dto;

use App\Entity\Club as ClubEntity;
use App\Enum\CountrySubdivision;

class ClubContainer
{
    private array $clubs = [];
    private int $total = 0;

    public static function fromEntities(array $clubs): self
    {
        $clubByAlphaDto = new self();

        /** @var ClubEntity $club */
        foreach ($clubs as $club) {
            $clubByAlphaDto->clubs[CountrySubdivision::getName($club->getCountrySubdivisionCode()->value)][] = Club::fromEntity($club);
            $clubByAlphaDto->total++;
        }

        return $clubByAlphaDto;
    }

    public function getClubs(): array
    {
        return $this->clubs;
    }

    public function setClubs(array $clubs): void
    {
        $this->clubs = $clubs;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }
}
