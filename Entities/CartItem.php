<?php
declare(strict_types=1);

namespace Entities;

class CartItem
{

    private int $productid;
    private int $number;

    public function __construct(int $productid, int $number)
    {

        $this->productid = $productid;
        $this->number = $number;
    }

    /**
     * Get the value of productid
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * Get the value of number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }
}