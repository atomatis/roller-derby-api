<?php

namespace App\Entity;

use App\Enum\CountrySubdivision;
use App\Enum\EventStatus;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?string $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private string $name;

    #[ORM\Column(type: Types::ENUM, enumType: EventStatus::class)]
    private EventStatus $status;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $startAt;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private \DateTimeImmutable $endAt;

    #[ORM\ManyToOne(targetEntity: Club::class, inversedBy: 'events')]
    private Club $club;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Championship $championship = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(targetEntity: Game::class, mappedBy: 'event')]
    private Collection $games;

    /**
     * @var Collection<int, EventSearchCriteria>
     */
    #[ORM\OneToMany(targetEntity: EventSearchCriteria::class, mappedBy: 'event', orphanRemoval: true)]
    private Collection $searchCriteria;

    /**
     * @var Collection<int, Ub>
     */
    #[ORM\OneToMany(targetEntity: Ub::class, mappedBy: 'event', orphanRemoval: true)]
    private Collection $ubs;

    #[ORM\OneToOne(mappedBy: 'event', cascade: ['persist', 'remove'])]
    private ?EventRefereeSearch $refereeSearch = null;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->searchCriteria = new ArrayCollection();
        $this->ubs = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): EventStatus
    {
        return $this->status;
    }

    public function setStatus(EventStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartAt(): \DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): static
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): \DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): static
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setEvent($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getEvent() === $this) {
                $game->setEvent(null);
            }
        }

        return $this;
    }

    public function getClub(): Club
    {
        return $this->club;
    }

    public function setClub(Club $club): static
    {
        $this->club = $club;

        return $this;
    }

    public function getChampionship(): ?Championship
    {
        return $this->championship;
    }

    public function setChampionship(?Championship $championship): static
    {
        $this->championship = $championship;

        return $this;
    }

    /**
     * @return Collection<int, EventSearchCriteria>
     */
    public function getSearchCriteria(): Collection
    {
        return $this->searchCriteria;
    }

    public function addSearchCriteria(EventSearchCriteria $searchCriteria): static
    {
        if (!$this->searchCriteria->contains($searchCriteria)) {
            $this->searchCriteria->add($searchCriteria);
            $searchCriteria->setEvent($this);
        }

        return $this;
    }

    public function removeSearchCriteria(EventSearchCriteria $searchCriteria): static
    {
        if ($this->searchCriteria->removeElement($searchCriteria)) {
            // set the owning side to null (unless already changed)
            if ($searchCriteria->getEvent() === $this) {
                $searchCriteria->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ub>
     */
    public function getUbs(): Collection
    {
        return $this->ubs;
    }

    public function addUb(Ub $ub): static
    {
        if (!$this->ubs->contains($ub)) {
            $this->ubs->add($ub);
            $ub->setEvent($this);
        }

        return $this;
    }

    public function removeUb(Ub $ub): static
    {
        if ($this->ubs->removeElement($ub)) {
            // set the owning side to null (unless already changed)
            if ($ub->getEvent() === $this) {
                $ub->setEvent(null);
            }
        }

        return $this;
    }

    public function getRefereeSearch(): ?EventRefereeSearch
    {
        return $this->refereeSearch;
    }

    public function setRefereeSearch(EventRefereeSearch $refereeSearch): static
    {
        // set the owning side of the relation if necessary
        if ($refereeSearch->getEvent() !== $this) {
            $refereeSearch->setEvent($this);
        }

        $this->refereeSearch = $refereeSearch;

        return $this;
    }
}
