<?php
declare(strict_types=1);

namespace Entities;

class Place
{
    private int $id;
    private int $postcode;
    private string $name;
    private int $isaccessible;


    public function __construct(int $id, int $postcode, string $name, int $isaccessible)
    {
        $this->id = $id;
        $this->postcode = $postcode;
        $this->name = $name;
        $this->isaccessible = $isaccessible;
    }

    /**
     * Get the value of id
     */
    public function getplaceId()
    {
        return $this->id;
    }

    /**
     * Get the value of postcode
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set the value of postcode
     *
     * @return  self
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of isaccessible
     */
    public function getIsaccessible()
    {
        return $this->isaccessible;
    }

    /**
     * Set the value of isaccessible
     *
     * @return  self
     */
    public function setIsaccessible($isaccessible)
    {
        $this->isaccessible = $isaccessible;

        return $this;
    }
}