<?php

namespace App\Helper\DTO;

class ApplicationDTO
{
    private $appId = null;
    private $tech = null;
    private $dateVisit = null;
    private $dopInform = null;

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     * @return ApplicationDTO
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTech()
    {
        return $this->tech;
    }

    /**
     * @param mixed $tech
     * @return ApplicationDTO
     */
    public function setTech($tech)
    {
        $this->tech = $tech;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }

    /**
     * @param mixed $dateVisit
     * @return ApplicationDTO
     */
    public function setDateVisit($dateVisit)
    {
        $this->dateVisit = $dateVisit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDopInform()
    {
        return $this->dopInform;
    }

    /**
     * @param mixed $dopInform
     * @return ApplicationDTO
     */
    public function setDopInform($dopInform)
    {
        $this->dopInform = $dopInform;
        return $this;
    }

}