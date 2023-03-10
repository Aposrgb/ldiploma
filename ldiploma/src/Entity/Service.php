<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'service', targetEntity: Tariff::class)]
    private Collection $tariffes;

    #[ORM\Column]
    private ?int $type = null;

    public function __construct()
    {
        $this->tariffes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
            $tariffe->setService($this);
        }

        return $this;
    }

    public function removeTariffe(Tariff $tariffe): self
    {
        if ($this->tariffes->removeElement($tariffe)) {
            // set the owning side to null (unless already changed)
            if ($tariffe->getService() === $this) {
                $tariffe->setService(null);
            }
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
