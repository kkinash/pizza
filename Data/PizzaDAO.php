<?php
//Busines/PizzaDAO.php
declare(strict_types=1);

namespace Data;

use Data\DBConfig;
use Entities\Pizza;
use \PDO;

class PizzaDAO
{

    public function getAllPizzas(): array
    {
        $sql = "SELECT * FROM pizza";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $pizzaLijst = array();
        foreach ($resultSet as $rij) {
            $pizza = new Pizza((int) $rij["pizzaid"], (string) $rij["pizzaname"], (string) $rij["infopizza"], (float) $rij["pizzaprice"], (float) $rij["promotionprice"]);
            array_push($pizzaLijst, $pizza);
        }
        $dbh = null;
        return $pizzaLijst;
    }

    public function getPizzaById(int $id): Pizza
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM pizza Where pizzaid = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $pizza = new Pizza(
            (int) $result["pizzaid"],
            (string) $result["pizzaname"],
            (string) $result["infopizza"],
            (float) $result['pizzaprice'],
            (float) $result['promotionprice']
        );
        $dbh = null;
        return $pizza;
    }
}