<?php

namespace App\Dto;

use App\Entity\Team as TeamEntity;
use App\Enum\CountrySubdivision;

class TeamContainer
{
    private array $teams = [];

    private int $total = 0;

    public static function NewByCountrySubDivision(array $teams): self
    {
        $self = new self();

        /** @var TeamEntity $team */
        foreach ($teams as $team) {
            $self->teams[CountrySubdivision::getName($team->getClub()->getCountrySubdivisionCode()->value)][] = Team::fromEntity($team);
            $self->total++;
        }

        return $self;
    }

    public function getTeams(): array
    {
        return $this->teams;
    }

    public function setTeams(array $teams): void
    {
        $this->teams = $teams;
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
