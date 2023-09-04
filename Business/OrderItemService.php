<?php
//Busines/OrderItemService.php
declare(strict_types=1);

namespace Business;


use Data\OrderItemDAO;
use Entities\OrderItem;


class OrderItemService
{
    private OrderItemDAO $orderItemDAO;
    public function addOrderItemOverview($orderid, $productid, $number)
    {
        $orderItemDAO = new OrderItemDAO();
        $orderItemid = $orderItemDAO->addOrderItem($orderid, $productid, $number);

        return $orderItemid;
    }

    public function deleteOrderItemOverview($id): int
    {
        $orderItemDAO = new OrderItemDAO();
        $orderItemid = $orderItemDAO->deleteOrderItem($id);

        return $orderItemid;
    }

    public function getAllItemsByOrderIDOverview($orderid): array
    {
        $orderItemDAO = new OrderItemDAO();
        $ItemArray = $orderItemDAO->getAllItemsByOrderID($orderid);

        return $ItemArray;
    }

}