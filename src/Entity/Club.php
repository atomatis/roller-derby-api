<?php

namespace App\Entity;

use App\Enum\ClubGenderDiversityPolicy;
use App\Enum\Country;
use App\Enum\CountrySubdivision;
use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private ?string $id = null;

    #[ORM\Column]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legalName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(nullable: true)]
    private ?string $overview = null;

    #[ORM\Column(nullable: true)]
    private ?string $history = null;

    // ISO 3166-1
    #[ORM\Column(type: Types::ENUM, length: 3, nullable: true, enumType: Country::class)]
    private Country $countryCode;

    #[ORM\Column(type: Types::ENUM, length: 3, nullable: true, enumType: CountrySubdivision::class)]
    private ?CountrySubdivision $countrySubdivisionCode = null;

    #[ORM\Column(type: Types::ENUM, length: 3, nullable: true, enumType: ClubGenderDiversityPolicy::class)]
    private ClubGenderDiversityPolicy $genderDiversityPolicy;

    /**
     * @var Collection<int, Club>
     */
    #[ORM\OneToMany(targetEntity: Club::class, mappedBy: 'club', cascade: ['persist', 'remove'])]
    private Collection $events;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'club', cascade: ['persist', 'remove'])]
    private Collection $teams;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $closedAt = null;

    #[ORM\Column(type: Types::JSON)]
    private array $cities = [];

    #[ORM\Column(nullable: true)]
    private ?array $websites = null;

    #[ORM\Column(nullable: true)]
    private ?array $mediaLinks = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $interleagueEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebookId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagramId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $myRollerDerbyId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->events = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    public function setLegalName(?string $legalName): static
    {
        $this->legalName = $legalName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): static
    {
        $this->history = $history;

        return $this;
    }

    public function getCountryCode(): Country
    {
        return $this->countryCode;
    }

    public function setCountryCode(Country $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getCountrySubdivisionCode(): ?CountrySubdivision
    {
        return $this->countrySubdivisionCode;
    }

    public function setCountrySubdivisionCode(?CountrySubdivision $countrySubdivisionCode): self
    {
        $this->countrySubdivisionCode = $countrySubdivisionCode;

        return $this;
    }

    public function getGenderDiversityPolicy(): ClubGenderDiversityPolicy
    {
        return $this->genderDiversityPolicy;
    }

    public function setGenderDiversityPolicy(ClubGenderDiversityPolicy $genderDiversityPolicy): static
    {
        $this->genderDiversityPolicy = $genderDiversityPolicy;

        return $this;
    }

    /**
     * @return Collection<int, Club>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setClub($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->events->removeElement($event);

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setClub($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
       $this->teams->removeElement($team);

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getClosedAt(): ?\DateTimeImmutable
    {
        return $this->closedAt;
    }

    public function setClosedAt(?\DateTimeImmutable $closedAt): static
    {
        $this->closedAt = $closedAt;

        return $this;
    }

    public function getCities(): array
    {
        return $this->cities;
    }

    public function setCities(array $cities): static
    {
        $this->cities = $cities;

        return $this;
    }

    public function getWebsites(): ?array
    {
        return $this->websites;
    }

    public function setWebsites(?array $websites): static
    {
        $this->websites = $websites;

        return $this;
    }

    public function getMediaLinks(): ?array
    {
        return $this->mediaLinks;
    }

    public function setMediaLinks(?array $mediaLinks): static
    {
        $this->mediaLinks = $mediaLinks;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): static
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    public function getInterleagueEmail(): ?string
    {
        return $this->interleagueEmail;
    }

    public function setInterleagueEmail(?string $interleagueEmail): static
    {
        $this->interleagueEmail = $interleagueEmail;

        return $this;
    }

    public function getInstagramId(): ?string
    {
        return $this->instagramId;
    }

    public function setInstagramId(?string $instagramId): static
    {
        $this->instagramId = $instagramId;

        return $this;
    }

    public function getMyRollerDerbyId(): ?string
    {
        return $this->myRollerDerbyId;
    }

    public function setMyRollerDerbyId(?string $myRollerDerbyId): static
    {
        $this->myRollerDerbyId = $myRollerDerbyId;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }
}
