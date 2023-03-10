<?php

namespace App\Entity;

use App\Helper\EnumStatus\ApplicationStatus;
use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationRepository::class)]
class Application
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Tariff::class, inversedBy: 'applications')]
    private Collection $tariffes;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    private ?User $owner = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $count = null;

    #[ORM\Column(nullable: true)]
    private ?int $status = null;

    #[ORM\OneToOne(inversedBy: 'app', cascade: ['persist', 'remove'])]
    private ?Garb $garb = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->status = ApplicationStatus::IN_PROCESS->value;
        $this->tariffes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Tariff>
     */
    public function getTariffes(): Collection
    {
        return $this->tariffes;
    }

    public function addTariffe(Tariff $tariffe): self
    {
        if (!$this->tariffes->contains($tariffe)) {
            $this->tariffes->add($tariffe);
        }

        return $this;
    }

    public function removeTariffe(Tariff $tariffe): self
    {
        $this->tariffes->removeElement($tariffe);

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Garb|null
     */
    public function getGarb(): ?Garb
    {
        return $this->garb;
    }

    /**
     * @param Garb|null $garb
     * @return Application
     */
    public function setGarb(?Garb $garb): Application
    {
        $this->garb = $garb;
        return $this;
    }
}
