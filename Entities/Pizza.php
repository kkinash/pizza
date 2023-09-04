<?php
// Entities/Pizza.php

declare(strict_types=1);

namespace Entities;

class Pizza
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private float $promotionprice;

    public function __construct(int $id, string $name, string $description, float $price, float $promotionprice)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->promotionprice = $promotionprice;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
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
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of promotionprice
     */
    public function getPromotionprice()
    {
        return $this->promotionprice;
    }

    /**
     * Set the value of promotionprice
     *
     * @return  self
     */
    public function setPromotionprice($promotionprice)
    {
        $this->promotionprice = $promotionprice;

        return $this;
    }
}