<?php
//Busines/OrderService.php
declare(strict_types=1);

namespace Business;

use Data\OrderDAO;
use Entities\Order;

class OrderService
{
    private OrderDAO $orderDAO;

    public function addOrderOverview($userid, $datetime, $totalprice): int
    {
        $orderDAO = new OrderDAO();
        $orderid = $orderDAO->addOrder($userid, $datetime, $totalprice);

        return $orderid;
    }

    public function getOrderbyIDOverview(int $id): Order
    {
        $orderDAO = new OrderDAO();
        $order = $orderDAO->getOrderbyID($id);

        return $order;
    }


}