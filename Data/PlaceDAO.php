<?php

declare(strict_types=1);

namespace Data;

use Data\DBConfig;
use Entities\Place;
use Exceptions\PlaceExistsException;
use Exceptions\PlaceNotFoundException;
use \PDO;



class PlaceDAO
{
    public function placeExistsCheck($postcode): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM places WHERE postcode = :postcode");
        $stmt->bindValue(":postcode", $postcode);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $cityid = $stmt->rowCount();

        if (count($result) > 0) {
            foreach ($result as $rij) {
                $cityid = (int) $rij["placeId"];
            }
        }
        $dbh = null;
        return $cityid;
    }


    public function getAllPlaces(): array
    {
        $sql = "SELECT * FROM places";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $placeList = array();
        foreach ($resultSet as $rij) {
            $place = new Place((int) $rij["placeId"], $rij["postcode"], $rij["placename"], $rij["isaccessible"]);
            array_push($placeList, $place);
        }
        $dbh = null;

        return $placeList;
    }

    public function addPlace(int $postcode, string $name, int $isaccessible): int
    {
        // $allreadyExists = $this->placeExistsCheck($postcode);
        // if ($allreadyExists !== "0") {
        //     throw new PlaceExistsException();
        // }
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("INSERT INTO places (postcode, placename, isaccessible) VALUES (:postcode, :placename, :isaccessible)");
        $stmt->bindValue(":postcode", $postcode);
        $stmt->bindValue(":placename", $name);
        $stmt->bindValue(":isaccessible", $isaccessible);
        $stmt->execute();
        $laatsteNieuweId = $dbh->lastInsertId();

        $dbh = null;
        return (int) $laatsteNieuweId;
    }

    public function getPlacebyPostcode($postcode): Place
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM places Where postcode = :postcode");
        $stmt->bindValue(":postcode", $postcode);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $place = new Place((int) $result["placeId"], (int) $result["postcode"], (string) $result['placename'], (int) $result['isaccessible']);
        $dbh = null;
        return $place;
    }

    public function getPlacebyId($id): Place
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM places Where placeId = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $place = new Place((int) $result["placeId"], (int) $result["postcode"], (string) $result['placename'], (int) $result['isaccessible']);
        $dbh = null;
        return $place;
    }

    public function getDeliveriblePostcodes(): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM places Where  isaccessible = 1");
        $stmt->execute();
        $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $placeList = array();
        foreach ($resultSet as $place) {
            $postcode = $place["postcode"];
            array_push($placeList, $postcode);
        }

        $dbh = null;

        return $placeList;
    }


    public function editPlaceinOrderbyPostcode(int $postcode, $cityname): int
    {
        $plcDAO = new PlaceDAO;
        $existingPlace = $plcDAO->placeExistsCheck($postcode);
        if ($existingPlace === 0) {
            $cityid = $plcDAO->addPlace($postcode, $cityname, 0);
        } else {
            $cityid = $existingPlace;
        }
        return $cityid;
    }

}