<?php
declare(strict_types=1);

namespace Entities;

class OrderItem
{
    private int $orderlineid;
    private int $orderid;
    private int $productid;
    private int $number;

    public function __construct(int $orderlineid, int $orderid, int $productid, int $number)
    {
        $this->orderlineid = $orderlineid;
        $this->orderid = $orderid;
        $this->productid = $productid;
        $this->number = $number;
    }

    /**
     * Get the value of orderlineid
     */
    public function getOrderlineid()
    {
        return $this->orderlineid;
    }

    /**
     * Get the value of orderid
     */
    public function getOrderid()
    {
        return $this->orderid;
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
}