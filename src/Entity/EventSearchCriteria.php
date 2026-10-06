<?php

namespace App\Entity;

use App\Repository\EventSearchCriteriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: EventSearchCriteriaRepository::class)]
class EventSearchCriteria
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $howMany;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $flatTrackStatsRankMin = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $flatTrackStatsRankMax = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $wftda = false;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $wftdaRankMin = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $wftdaRankMax = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $mrda = false;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $mrdaRankMin = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $mrdaRankMax = null;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $categories = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private array $levels = [];

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'searchCriteria')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'pingedEvents')]
    #[ORM\JoinTable(name: 'event_search__team_ping')]
    private Collection $teamPings;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'eventPings')]
    #[ORM\JoinTable(name: 'event_search__club_ping')]
    private Collection $pingedTeams;

    public function __construct()
    {
        $this->teamPings = new ArrayCollection();
        $this->pingedTeams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHowMany(): int
    {
        return $this->howMany;
    }

    public function setHowMany(int $howMany): self
    {
        $this->howMany = $howMany;

        return $this;
    }

    public function getFlatTrackStatsRankMin(): ?int
    {
        return $this->flatTrackStatsRankMin;
    }

    public function setFlatTrackStatsRankMin(?int $flatTrackStatsRankMin): self
    {
        $this->flatTrackStatsRankMin = $flatTrackStatsRankMin;

        return $this;
    }

    public function getFlatTrackStatsRankMax(): ?int
    {
        return $this->flatTrackStatsRankMax;
    }

    public function setFlatTrackStatsRankMax(?int $flatTrackStatsRankMax): self
    {
        $this->flatTrackStatsRankMax = $flatTrackStatsRankMax;

        return $this;
    }

    public function isWftda(): bool
    {
        return $this->wftda;
    }

    public function setWftda(bool $wftda): self
    {
        $this->wftda = $wftda;

        return $this;
    }

    public function getWftdaRankMin(): ?int
    {
        return $this->wftdaRankMin;
    }

    public function setWftdaRankMin(?int $wftdaRankMin): self
    {
        $this->wftdaRankMin = $wftdaRankMin;

        return $this;
    }

    public function getWftdaRankMax(): ?int
    {
        return $this->wftdaRankMax;
    }

    public function setWftdaRankMax(?int $wftdaRankMax): self
    {
        $this->wftdaRankMax = $wftdaRankMax;

        return $this;
    }

    public function getMrdaRankMin(): ?int
    {
        return $this->mrdaRankMin;
    }

    public function setMrdaRankMin(?int $mrdaRankMin): self
    {
        $this->mrdaRankMin = $mrdaRankMin;

        return $this;
    }

    public function isMrda(): bool
    {
        return $this->mrda;
    }

    public function setMrda(bool $mrda): self
    {
        $this->mrda = $mrda;

        return $this;
    }

    public function getMrdaRankMax(): ?int
    {
        return $this->mrdaRankMax;
    }

    public function setMrdaRankMax(?int $mrdaRankMax): self
    {
        $this->mrdaRankMax = $mrdaRankMax;

        return $this;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function setCategories(?array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getLevels(): ?array
    {
        return $this->levels;
    }

    public function setLevels(?array $levels): self
    {
        $this->levels = $levels;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeamPings(): Collection
    {
        return $this->teamPings;
    }

    public function addTeamPing(Team $team): static
    {
        if (!$this->teamPings->contains($team)) {
            $this->teamPings->add($team);
        }

        return $this;
    }

    public function removeTeamPing(Team $team): static
    {
        $this->teamPings->removeElement($team);

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getPingedTeams(): Collection
    {
        return $this->pingedTeams;
    }

    public function addPingedTeam(Team $team): static
    {
        if (!$this->pingedTeams->contains($team)) {
            $this->pingedTeams->add($team);
        }

        return $this;
    }

    public function removeEventPing(Team $team): static
    {
        $this->pingedTeams->removeElement($team);

        return $this;
    }
}
