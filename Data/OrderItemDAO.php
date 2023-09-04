<?php
//Data/OrderItemDAO.php
declare(strict_types=1);

namespace Data;

use Data\DBConfig;
use Entities\OrderItem;
use \PDO;

class OrderItemDAO
{
    public function addOrderItem($orderid, $productid, $number): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("INSERT INTO orderline (orderid, pizzaid, number) VALUES (:orderlineid, :pizzaid, :number)");
        $stmt->bindValue(":orderlineid", $orderid);
        $stmt->bindValue(":pizzaid", $productid);
        $stmt->bindValue(":number", $number);
        $stmt->execute();
        $laatsteNieuweId = $dbh->lastInsertId();
        $dbh = null;
        return (int) $laatsteNieuweId;
    }

    public function deleteOrderItem($id): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("DELETE FROM orderline WHERE orderlineid = :orderlineid;");
        $stmt->bindValue(":orderlineid", $id);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $dbh = null;
        return $rowCount;
    }

    public function getAllItemsByOrderID($orderid): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM orderline WHERE orderid = :orderid");
        $stmt->bindValue(":orderid", $orderid);
        $stmt->execute();
        $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $itemList = array();
        foreach ($resultSet as $item) {
            $orderItem = new OrderItem((int) $item["orderlineid"], (int) $item["orderid"], (int) $item["pizzaid"], (int) $item["number"]);
            array_push($itemList, $orderItem);
        }
        $dbh = null;
        return $itemList;
    }


}