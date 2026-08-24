<?php

namespace App\Dto;

use App\Entity\Club;
use App\Enum\Region;
use Doctrine\Common\Collections\Collection;

class ClubByRegionDto
{
    private array $clubs = [];
    private int $total = 0;

    public static function fromEntities(Collection $clubs): self
    {
        $clubByAlphaDto = new self();

        /** @var Club $club */
        foreach ($clubs as $club) {
            $clubByAlphaDto->clubs[Region::getName($club->getRegionCode())][] = ClubIoDto::fromEntity($club);
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
