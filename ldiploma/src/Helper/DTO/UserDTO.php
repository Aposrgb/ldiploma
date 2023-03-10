<?php

class UserDTO
{
    private ?string $name = null;

    private ?string $surname = null;

    private ?string $patronymic = null;

    private ?string $telephone = null;

    private ?string $nameOrg = null;

    private ?int $type = null;

    private ?string $passSerias = null;

    private ?string $passNumber = null;

    private ?string $index = null;

    private ?string $locality = null;

    private ?string $district = null;

    private ?string $street = null;

    private ?string $house = null;

    private ?string $apartment = null;

    private ?string $urAddress = null;

    private ?string $postAddress = null;

    private ?string $payAcc = null;

    private ?string $inn = null;

    private ?string $kpp = null;

    private ?string $bik = null;

    private ?string $trustPers = null;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return UserDTO
     */
    public function setName(?string $name): UserDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string|null $surname
     * @return UserDTO
     */
    public function setSurname(?string $surname): UserDTO
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @param string|null $patronymic
     * @return UserDTO
     */
    public function setPatronymic(?string $patronymic): UserDTO
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     * @return UserDTO
     */
    public function setTelephone(?string $telephone): UserDTO
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNameOrg(): ?string
    {
        return $this->nameOrg;
    }

    /**
     * @param string|null $nameOrg
     * @return UserDTO
     */
    public function setNameOrg(?string $nameOrg): UserDTO
    {
        $this->nameOrg = $nameOrg;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     * @return UserDTO
     */
    public function setType(?int $type): UserDTO
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassSerias(): ?string
    {
        return $this->passSerias;
    }

    /**
     * @param string|null $passSerias
     * @return UserDTO
     */
    public function setPassSerias(?string $passSerias): UserDTO
    {
        $this->passSerias = $passSerias;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassNumber(): ?string
    {
        return $this->passNumber;
    }

    /**
     * @param string|null $passNumber
     * @return UserDTO
     */
    public function setPassNumber(?string $passNumber): UserDTO
    {
        $this->passNumber = $passNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIndex(): ?string
    {
        return $this->index;
    }

    /**
     * @param string|null $index
     * @return UserDTO
     */
    public function setIndex(?string $index): UserDTO
    {
        $this->index = $index;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLocality(): ?string
    {
        return $this->locality;
    }

    /**
     * @param string|null $locality
     * @return UserDTO
     */
    public function setLocality(?string $locality): UserDTO
    {
        $this->locality = $locality;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @param string|null $district
     * @return UserDTO
     */
    public function setDistrict(?string $district): UserDTO
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     * @return UserDTO
     */
    public function setStreet(?string $street): UserDTO
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }

    /**
     * @param string|null $house
     * @return UserDTO
     */
    public function setHouse(?string $house): UserDTO
    {
        $this->house = $house;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApartment(): ?string
    {
        return $this->apartment;
    }

    /**
     * @param string|null $apartment
     * @return UserDTO
     */
    public function setApartment(?string $apartment): UserDTO
    {
        $this->apartment = $apartment;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrAddress(): ?string
    {
        return $this->urAddress;
    }

    /**
     * @param string|null $urAddress
     * @return UserDTO
     */
    public function setUrAddress(?string $urAddress): UserDTO
    {
        $this->urAddress = $urAddress;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostAddress(): ?string
    {
        return $this->postAddress;
    }

    /**
     * @param string|null $postAddress
     * @return UserDTO
     */
    public function setPostAddress(?string $postAddress): UserDTO
    {
        $this->postAddress = $postAddress;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayAcc(): ?string
    {
        return $this->payAcc;
    }

    /**
     * @param string|null $payAcc
     * @return UserDTO
     */
    public function setPayAcc(?string $payAcc): UserDTO
    {
        $this->payAcc = $payAcc;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * @param string|null $inn
     * @return UserDTO
     */
    public function setInn(?string $inn): UserDTO
    {
        $this->inn = $inn;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    /**
     * @param string|null $kpp
     * @return UserDTO
     */
    public function setKpp(?string $kpp): UserDTO
    {
        $this->kpp = $kpp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBik(): ?string
    {
        return $this->bik;
    }

    /**
     * @param string|null $bik
     * @return UserDTO
     */
    public function setBik(?string $bik): UserDTO
    {
        $this->bik = $bik;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrustPers(): ?string
    {
        return $this->trustPers;
    }

    /**
     * @param string|null $trustPers
     * @return UserDTO
     */
    public function setTrustPers(?string $trustPers): UserDTO
    {
        $this->trustPers = $trustPers;
        return $this;
    }


}