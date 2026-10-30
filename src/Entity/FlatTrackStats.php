<?php

namespace App\Entity;

use App\Repository\FlattrackRankingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlattrackRankingRepository::class)]
class FlatTrackStats
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::TEXT)]
    private string $slug;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 1)]
    private float $rank;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 1)]
    private float $wftdaRank;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 1)]
    private float $mrdaRank;

    #[ORM\OneToOne(inversedBy: 'flatTrackStats', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): FlatTrackStats
    {
        $this->slug = $slug;
        return $this;
    }

    public function getRank(): float
    {
        return $this->rank;
    }

    public function setRank(float $rank): FlatTrackStats
    {
        $this->rank = $rank;
        return $this;
    }

    public function getWftdaRank(): float
    {
        return $this->wftdaRank;
    }

    public function setWftdaRank(float $wftdaRank): FlatTrackStats
    {
        $this->wftdaRank = $wftdaRank;
        return $this;
    }

    public function getMrdaRank(): float
    {
        return $this->mrdaRank;
    }

    public function setMrdaRank(float $mrdaRank): FlatTrackStats
    {
        $this->mrdaRank = $mrdaRank;
        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(Team $team): static
    {
        $this->team = $team;

        return $this;
    }
}
