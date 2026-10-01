<?php

namespace App\Entity;

use App\Repository\FlattrackRankingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlattrackRankingRepository::class)]
class FlatTrackStatsRanking
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $countryRank = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $continentalRank = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $worldRank = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 1)]
    private ?float $rating = null;

    #[ORM\Column(length: 5)]
    private ?string $gender = null;

    #[ORM\OneToOne(inversedBy: 'flatTrackStatsRanking', cascade: ['persist', 'remove'])]
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

    public function getCountryRank(): ?int
    {
        return $this->countryRank;
    }

    public function setCountryRank(?int $countryRank): static
    {
        $this->countryRank = $countryRank;

        return $this;
    }

    public function getContinentalRank(): ?int
    {
        return $this->continentalRank;
    }

    public function setContinentalRank(?int $continentalRank): static
    {
        $this->continentalRank = $continentalRank;

        return $this;
    }

    public function getWorldRank(): ?int
    {
        return $this->worldRank;
    }

    public function setWorldRank(?int $worldRank): static
    {
        $this->worldRank = $worldRank;

        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

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
