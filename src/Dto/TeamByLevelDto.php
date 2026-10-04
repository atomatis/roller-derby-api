<?php

namespace App\Dto;

use App\Entity\Team;
use App\Helper\Common;
use Doctrine\Common\Collections\Collection;

class TeamByLevelDto
{
    private array $teams = [];

    private int $total = 0;

    public static function fromEntities(array $teams): self
    {
        $teamByAlphaDto = new self();

        /** @var Team $team */
        foreach ($teams as $team) {
            $teamByAlphaDto->teams[$team->getLevel()][] = TeamIoDto::fromEntity($team);
            $teamByAlphaDto->total++;
        }

        return $teamByAlphaDto;
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
