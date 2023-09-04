<?php
// Entities/Order.php
declare(strict_types=1);

namespace Entities;

class Order
{
    private int $orderid;
    private int $userid;
    private string $datetime;
    private float $totalprice;



    public function __construct(int $orderid, int $userid, string $datetime, float $totalprice)
    {
        $this->orderid = $orderid;
        $this->userid = $userid;
        $this->datetime = $datetime;
        $this->totalprice = $totalprice;

    }

    /**
     * Get the value of orderid
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * Get the value of userid
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set the value of userid
     *
     * @return  self
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get the value of datetime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Get the value of totalprice
     */
    public function getTotalprice()
    {
        return $this->totalprice;
    }

    /**
     * Set the value of totalprice
     *
     * @return  self
     */
    public function setTotalprice($totalprice)
    {
        $this->totalprice = $totalprice;

        return $this;
    }

}