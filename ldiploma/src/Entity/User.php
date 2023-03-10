<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $patronymic = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nameOrg = null;

    #[ORM\Column(nullable: true)]
    private ?int $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passSerias = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $index = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $locality = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $district = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $street = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $house = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $apartment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $postAddress = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $payAcc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $kpp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bik = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trustPers = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: Application::class, cascade: ['persist'])]
    private Collection $applications;

    public function __construct()
    {
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function setPatronymic(?string $patronymic): self
    {
        $this->patronymic = $patronymic;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNameOrg(): ?string
    {
        return $this->nameOrg;
    }

    public function setNameOrg(?string $nameOrg): self
    {
        $this->nameOrg = $nameOrg;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPassSerias(): ?string
    {
        return $this->passSerias;
    }

    public function setPassSerias(?string $passSerias): self
    {
        $this->passSerias = $passSerias;

        return $this;
    }

    public function getPassNumber(): ?string
    {
        return $this->passNumber;
    }

    public function setPassNumber(?string $passNumber): self
    {
        $this->passNumber = $passNumber;

        return $this;
    }

    public function getIndex(): ?string
    {
        return $this->index;
    }

    public function setIndex(?string $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function setLocality(?string $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(?string $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getApartment(): ?string
    {
        return $this->apartment;
    }

    public function setApartment(?string $apartment): self
    {
        $this->apartment = $apartment;

        return $this;
    }

    public function getUrAddress(): ?string
    {
        return $this->urAddress;
    }

    public function setUrAddress(?string $urAddress): self
    {
        $this->urAddress = $urAddress;

        return $this;
    }

    public function getPostAddress(): ?string
    {
        return $this->postAddress;
    }

    public function setPostAddress(?string $postAddress): self
    {
        $this->postAddress = $postAddress;

        return $this;
    }

    public function getPayAcc(): ?string
    {
        return $this->payAcc;
    }

    public function setPayAcc(?string $payAcc): self
    {
        $this->payAcc = $payAcc;

        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(?string $inn): self
    {
        $this->inn = $inn;

        return $this;
    }

    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    public function setKpp(?string $kpp): self
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function getBik(): ?string
    {
        return $this->bik;
    }

    public function setBik(?string $bik): self
    {
        $this->bik = $bik;

        return $this;
    }

    public function getTrustPers(): ?string
    {
        return $this->trustPers;
    }

    public function setTrustPers(?string $trustPers): self
    {
        $this->trustPers = $trustPers;

        return $this;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications->add($application);
            $application->setOwner($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getOwner() === $this) {
                $application->setOwner(null);
            }
        }

        return $this;
    }
}
