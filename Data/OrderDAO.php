<?php
//Data/OrderDAO.php
declare(strict_types=1);

namespace Data;

use Data\DBConfig;
use Entities\Order;
use \PDO;

class OrderDAO
{

    public function addOrder($userid, $datetime, $totalprice): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("INSERT INTO orders (userid, datetime, totalprice) VALUES (:userid, :datetime, :totalprice)");

        $stmt->bindValue(":userid", $userid);
        $stmt->bindValue(":datetime", $datetime);
        $stmt->bindValue(":totalprice", $totalprice);
        $stmt->execute();
        $laatsteNieuweId = $dbh->lastInsertId();
        $dbh = null;
        return (int) $laatsteNieuweId;
    }


    public function getOrderbyID($id): Order
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM orders Where orderid = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $order = new Order((int) $result["orderid"], (int) $result["userid"], (string) $result["datetime"], (float) $result["totalprice"]);

        $dbh = null;
        return $order;
    }
}