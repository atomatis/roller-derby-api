<?php

namespace App\Model\Interleague;

use App\Entity\Club as ClubEntity;
use App\Enum\TeamCategory;
use App\Enum\TeamLevel;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final class Club
{
    private string $id;

    private string $name;

    private ?string $alias = null;

    private string $genderDiversityPolicy;

    private string $countryCode;

    private array $cities = [];

    private ?string $logoUrl = null;

    /** @var ListableTeam[] $teams */
    private array $teams;

    /** @var array $events */
    private array $events;

    public static function fromEntity(ClubEntity $club): self
    {
        $teams = [];
        $events = [];

        foreach ($club->getTeams() as $team) {
            $teams[] = ListableTeam::fromEntity($team);
        }

        self::sortTeams($teams);

        return new self()
            ->setId($club->getId())
            ->setName($club->getName())
            ->setAlias($club->getAlias())
            ->setGenderDiversityPolicy($club->getGenderDiversityPolicy()->value)
            ->setCountryCode($club->getCountryCode()->value)
            ->setCities($club->getCities())
            ->setTeams($teams)
            ->setEvents($events)
        ;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    public function getGenderDiversityPolicy(): string
    {
        return $this->genderDiversityPolicy;
    }

    public function setGenderDiversityPolicy(string $genderDiversityPolicy): self
    {
        $this->genderDiversityPolicy = $genderDiversityPolicy;
        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getCities(): array
    {
        return $this->cities;
    }

    public function setCities(array $cities): self
    {
        $this->cities = $cities;
        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): self
    {
        $this->logoUrl = $logoUrl;
        return $this;
    }

    public function getTeams(): array
    {
        return $this->teams;
    }

    public function setTeams(array $teams): self
    {
        $this->teams = $teams;
        return $this;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function setEvents(array $events): self
    {
        $this->events = $events;
        return $this;
    }

    private static function sortTeams(array &$teams): void{
        uasort($teams, function (ListableTeam $a, ListableTeam $b) {
            $_a = 0;
            $_b = 0;

            match ($a->getCategory()) {
                TeamCategory::WomenAndGenderMinorities->value => $_a += 0,
                TeamCategory::Open->value => $_a += 10,
                TeamCategory::JuniorWomenAndGenderMinorities->value => $_a += 20,
                TeamCategory::JuniorOpen->value => $_a += 30,
            };

            match ($b->getCategory()) {
                TeamCategory::WomenAndGenderMinorities->value => $_b += 0,
                TeamCategory::Open->value => $_b += 10,
                TeamCategory::JuniorWomenAndGenderMinorities->value => $_b += 20,
                TeamCategory::JuniorOpen->value => $_b += 30,
            };

            match ($a->getLevel()) {
                TeamLevel::RankOne->value => $_a += 1,
                TeamLevel::RankTwo->value => $_a += 2,
                TeamLevel::RankThree->value => $_a += 3,
                TeamLevel::RankFour->value => $_a += 4,
                TeamLevel::Casual->value => $_a += 5,
                TeamLevel::Rookie->value => $_a += 6,
            };

            match ($b->getLevel()) {
                TeamLevel::RankOne->value => $_b += 1,
                TeamLevel::RankTwo->value => $_b += 2,
                TeamLevel::RankThree->value => $_b += 3,
                TeamLevel::RankFour->value => $_b += 4,
                TeamLevel::Casual->value => $_b += 5,
                TeamLevel::Rookie->value => $_b += 6,
            };

            if ($_a == $_b) {
                return 0;
            }

            return ($_a < $_b) ? -1 : 1;
        });
    }
}
