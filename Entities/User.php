<?php
declare(strict_types=1);

namespace Entities;

class User
{
    private int $id;
    private string $name;
    private string $familyName;
    private string $email;
    private string $wachtwoord;
    private string $street;
    private int $housenr;
    private int $cityid;
    private string $userAddInfo;
    private int $discount;

 
    public function __construct(
        int $cid,
        string $cname,
        string $cfamilyName,
        string $cemail,
        string $cwachtwoord,
        string $cstreet,
        int $chousenr,
        int $ccityid,
        string $cuserAddInfo,
        int $cdiscount
    )
    {
        $this->id = $cid;
        $this->name = $cname;
        $this->familyName = $cfamilyName;
        $this->email = $cemail;
        $this->wachtwoord = $cwachtwoord;
        $this->street = $cstreet;
        $this->housenr = $chousenr;
        $this->cityid = $ccityid;
        $this->userAddInfo = $cuserAddInfo;
        $this->discount = $cdiscount;
    }


    //public function getId()
    public function getId(): int
    {
        return $this->id;
    }
    //public function getName()
    public function getName(): string
    {
        return $this->name;
    }
    //public function getEmail()
    public function getEmail(): string
    {
        return $this->email;
    }
    //public function getWachtwoord()
    public function getWachtwoord(): string
    {
        return $this->wachtwoord;
    }
    //public function setName($name)
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of familyName
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * Set the value of familyName
     *
     * @return  self
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * Get the value of cstreet
     */
    public function getStreet()
    {
        return $this->street;
    }


    /**
     * Get the value of chousenr
     */
    public function getHousenr()
    {
        return $this->housenr;
    }



    /**
     * Get the value of userAddInfo
     */
    public function getUserAddInfo()
    {
        return $this->userAddInfo;
    }

    /**
     * Get the value of discount
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Get the value of cityid
     */
    public function getCityid()
    {
        return $this->cityid;
    }
}