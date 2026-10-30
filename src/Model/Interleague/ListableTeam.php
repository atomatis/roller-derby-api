<?php

namespace App\Model\Interleague;

use App\Entity\Team as TeamEntity;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final class ListableTeam
{
    private ?string $id;

    private string $name ;

    private ?\DateTimeImmutable $disbandAt;

    private string $category;

    private string $level;

    private string $type;

    private string $countryCode;

    private bool $wftda = false;

    private bool $mrda = false;

    private string $cities;

    private ?string $logoUrl = null;

    public static function fromEntity(TeamEntity $team): self
    {
        return new self()
            ->setId($team->getId())
            ->setName($team->getPronoun().$team->getName())
            ->setCountryCode($team->getClub()->getCountryCode()->value)
            ->setLevel($team->getLevel()->value)
            ->setType($team->getType()->value)
            ->setCategory($team->getCategory()->value)
            ->setDisbandAt($team->getDisbandAt())
            ->setCities(implode(', ', $team->getClub()->getCities()))
        ;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): ListableTeam
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ListableTeam
    {
        $this->name = $name;
        return $this;
    }

    public function getDisbandAt(): ?\DateTimeImmutable
    {
        return $this->disbandAt;
    }

    public function setDisbandAt(?\DateTimeImmutable $disbandAt): ListableTeam
    {
        $this->disbandAt = $disbandAt;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): ListableTeam
    {
        $this->category = $category;
        return $this;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): ListableTeam
    {
        $this->level = $level;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): ListableTeam
    {
        $this->type = $type;
        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): ListableTeam
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function isWftda(): bool
    {
        return $this->wftda;
    }

    public function setWftda(bool $wftda): ListableTeam
    {
        $this->wftda = $wftda;
        return $this;
    }

    public function isMrda(): bool
    {
        return $this->mrda;
    }

    public function setMrda(bool $mrda): ListableTeam
    {
        $this->mrda = $mrda;
        return $this;
    }

    public function getCities(): string
    {
        return $this->cities;
    }

    public function setCities(string $cities): ListableTeam
    {
        $this->cities = $cities;
        return $this;
    }
}
