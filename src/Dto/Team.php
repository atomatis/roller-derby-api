<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Team as TeamEntity;
use App\Enum\TeamCategory;
use App\Enum\TeamLevel;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final class Team
{
    private ?string $id = null;

    private ?string $name = null;

    private ?string $overview = null;

    private ?string $history = null;

    private ?\DateTimeImmutable $disbandAt = null;

    private ?\DateTimeImmutable $createdAt = null;

    private ?int $flatTrackStatsId = null;

    private ?string $category = null;

    private ?string $level = null;

    private ?string $type = null;

    private ?string $countryCode = null;
    private bool $wftda = false;

    private bool $mrda = false;

    private ?string $email = null;

    private ?string $facebookId = null;

    private ?string $instagramId = null;

    private ?string $pronoun = null;

    private ?array $mediaLinks = null;

    private ?array $cities = null;

    private ?EmbeddedFile $logo = null;

    public function toEntity(): TeamEntity
    {
        return new TeamEntity()
            ->setId($this->id)
            ->setName($this->name)
            ->setEmail($this->email)
            ->setCreatedAt($this->createdAt)
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setLevel(TeamLevel::from($this->level))
            ->setType($this->type)
            ->setFacebookId($this->facebookId)
            ->setInstagramId($this->instagramId)
            ->setPronoun($this->pronoun)
            ->setMediaLinks($this->mediaLinks)
            ->setLogo($this->logo)
            ->setDisbandAt($this->disbandAt)
            ->setOverview($this->overview)
            ->setHistory($this->history)
            ->setFlatTrackStatsId($this->flatTrackStatsId)
            ->setCategory(TeamCategory::from($this->category))
        ;
    }

    public static function fromEntity(TeamEntity $team): self
    {
        return new self()
            ->setId($team->getId())
            ->setName($team->getName())
            ->setEmail($team->getEmail())
            ->setCountryCode($team->getClub()->getCountryCode()->value)
            ->setCreatedAt($team->getCreatedAt())
            ->setMediaLinks($team->getMediaLinks())
            ->setLevel($team->getLevel()->value)
            ->setType($team->getType())
            ->setWftda($team->isWftda())
            ->setMrda($team->isMrda())
            ->setCategory($team->getCategory()->value)
            ->setFlatTrackStatsId($team->getFlatTrackStatsId())
            ->setPronoun($team->getPronoun())
            ->setDisbandAt($team->getDisbandAt())
            ->setHistory($team->getHistory())
            ->setOverview($team->getOverview())
            ->setInstagramId($team->getInstagramId())
            ->setFacebookId($team->getFacebookId())
            ->setLogo($team->getLogo())
            ->setCities($team->getClub()->getCities())
        ;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;
        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;
        return $this;
    }

    public function getDisbandAt(): ?\DateTimeImmutable
    {
        return $this->disbandAt;
    }

    public function setDisbandAt(?\DateTimeImmutable $disbandAt): self
    {
        $this->disbandAt = $disbandAt;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getFlatTrackStatsId(): ?int
    {
        return $this->flatTrackStatsId;
    }

    public function setFlatTrackStatsId(?int $flatTrackStatsId): self
    {
        $this->flatTrackStatsId = $flatTrackStatsId;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function isWftda(): bool
    {
        return $this->wftda;
    }

    public function setWftda(bool $wftda): Team
    {
        $this->wftda = $wftda;
        return $this;
    }

    public function isMrda(): bool
    {
        return $this->mrda;
    }

    public function setMrda(bool $mrda): Team
    {
        $this->mrda = $mrda;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFacebookId(): ?string
    {
        return $this->facebookId;
    }

    public function setFacebookId(?string $facebookId): self
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    public function getInstagramId(): ?string
    {
        return $this->instagramId;
    }

    public function setInstagramId(?string $instagramId): self
    {
        $this->instagramId = $instagramId;
        return $this;
    }

    public function getPronoun(): ?string
    {
        return $this->pronoun;
    }

    public function setPronoun(?string $pronoun): self
    {
        $this->pronoun = $pronoun;
        return $this;
    }

    public function getMediaLinks(): ?array
    {
        return $this->mediaLinks;
    }

    public function setMediaLinks(?array $mediaLinks): self
    {
        $this->mediaLinks = $mediaLinks;
        return $this;
    }

    public function getLogo(): ?EmbeddedFile
    {
        return $this->logo;
    }

    public function setLogo(?EmbeddedFile $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function getCities(): ?array
    {
        return $this->cities;
    }

    public function setCities(?array $cities): self
    {
        $this->cities = $cities;

        return $this;
    }
}
