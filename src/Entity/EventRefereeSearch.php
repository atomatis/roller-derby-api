<?php

namespace App\Entity;

use App\Repository\EventRefereeSearchRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRefereeSearchRepository::class)]
class EventRefereeSearch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $link = null;

    #[ORM\Column]
    private ?bool $headSo = null;

    #[ORM\Column]
    private ?bool $headNso = null;

    #[ORM\Column]
    private ?bool $so = null;

    #[ORM\Column]
    private ?bool $nso = null;

    #[ORM\OneToOne(inversedBy: 'refereeSearch', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function isHeadSo(): ?bool
    {
        return $this->headSo;
    }

    public function setHeadSo(bool $headSo): static
    {
        $this->headSo = $headSo;

        return $this;
    }

    public function isHeadNso(): ?bool
    {
        return $this->headNso;
    }

    public function setHeadNso(bool $headNso): static
    {
        $this->headNso = $headNso;

        return $this;
    }

    public function isSo(): ?bool
    {
        return $this->so;
    }

    public function setSo(bool $so): static
    {
        $this->so = $so;

        return $this;
    }

    public function isNso(): ?bool
    {
        return $this->nso;
    }

    public function setNso(bool $nso): static
    {
        $this->nso = $nso;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): static
    {
        $this->event = $event;

        return $this;
    }
}
