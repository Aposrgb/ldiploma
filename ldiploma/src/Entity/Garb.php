<?php

namespace App\Entity;

use App\Repository\GarbRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarbRepository::class)]
class Garb
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateVisit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tech = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addres = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dopInform = null;

    #[ORM\OneToOne(mappedBy: 'garb', cascade: ['persist', 'remove'])]
    private ?Application $app = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateVisit(): ?\DateTimeInterface
    {
        return $this->dateVisit;
    }

    public function setDateVisit(?\DateTimeInterface $dateVisit): self
    {
        $this->dateVisit = $dateVisit;

        return $this;
    }

    public function getTech(): ?string
    {
        return $this->tech;
    }

    public function setTech(?string $tech): self
    {
        $this->tech = $tech;

        return $this;
    }

    public function getAddres(): ?string
    {
        return $this->addres;
    }

    public function setAddres(?string $addres): self
    {
        $this->addres = $addres;

        return $this;
    }

    public function getDopInform(): ?string
    {
        return $this->dopInform;
    }

    public function setDopInform(?string $dopInform): self
    {
        $this->dopInform = $dopInform;

        return $this;
    }

    public function getApp(): ?Application
    {
        return $this->app;
    }

    public function setApp(?Application $app): self
    {
        $this->app = $app;

        return $this;
    }
}
