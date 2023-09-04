<?php

declare(strict_types=1);

namespace Data;

use Data\DBConfig;
use Entities\User;
use Entities\Place;

use Exceptions\InvalidPasswordException;
use Exceptions\UserNotFoundException;
use Exceptions\EmailExistsException;
use \PDO;
use Data\PlaceDAO;

class UserDAO
{

    public function loginUser(string $username, string $password): ?User
    {
        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare("SELECT * FROM users WHERE email = :username");

            $stmt->bindValue(":username", $username);
            $stmt->execute();
            $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$resultSet) {
                throw new UserNotFoundException();
            }
            $isWachtwoordCorrect = password_verify($password, $resultSet["password"]);
            if (!$isWachtwoordCorrect) {
                throw new InvalidPasswordException();
            }
            $user = new User(
                (int) $resultSet["userid"],
                $resultSet["name"],
                $resultSet["familyname"],
                $resultSet["email"],
                $resultSet["password"],
                $resultSet["street"],
                $resultSet["housenr"],
                $resultSet["cityid"],
                $resultSet["additionalinfo"],
                $resultSet["discount"]
            );
            $dbh = null;

            return $user;

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }


    public function emailReedsInGebruik($email): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $dbh = null;
        return $rowCount;
    }


    public function registerUser(
        string $name,
        string $familyname,
        string $email,
        string $password,
        string $street,
        int $housenr,
        int $postcode,
        string $cityname,
        string $addinfo
    ): int
    {
        // check if email allready exists --> start
        $emailCount = $this->emailReedsInGebruik($email);
        if ($emailCount !== 0) {
            throw new EmailExistsException();
        }

        $plcDAO = new PlaceDAO;
        $existingPlace = $plcDAO->placeExistsCheck($postcode);
        if ($existingPlace === 0) {
            $cityid = $plcDAO->addPlace($postcode, $cityname, 0);
        } else {
            $cityid = $existingPlace;
        }

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare(
            "INSERT INTO users (name, familyname, street, housenr, cityid, email, password, additionalinfo, discount) 
             VALUES (:name, :familyname, :street, :housenr, :cityid, :email, :password, :additionalinfo, :discount)"
        );
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":familyname", $familyname);
        $stmt->bindValue(":street", $street);
        $stmt->bindValue(":housenr", $housenr);
        $stmt->bindValue(":cityid", $cityid);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":additionalinfo", $addinfo);
        $stmt->bindValue(":discount", rand(0, 1));
        $stmt->execute();
        $laatsteNieuweId = $dbh->lastInsertId();
        $dbh = null;
        $id = $laatsteNieuweId;
        return (int) $id;
    }


    public function registerUserWithoutEmail(
        string $name,
        string $familyname,
        string $street,
        int $housenr,
        int $postcode,
        string $cityname,
        string $addinfo
    ): int
    {
        $plcDAO = new PlaceDAO;
        $existingPlace = $plcDAO->placeExistsCheck($postcode);
        if ($existingPlace === 0) {
            $cityid = $plcDAO->addPlace($postcode, $cityname, 0);
        } else {
            $cityid = $existingPlace;
        }

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare(
            "INSERT INTO users (name, familyname, street, housenr, cityid, additionalinfo, discount) 
             VALUES (:name, :familyname, :street, :housenr, :cityid, :additionalinfo, :discount)"
        );
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":familyname", $familyname);
        $stmt->bindValue(":street", $street);
        $stmt->bindValue(":housenr", $housenr);
        $stmt->bindValue(":cityid", $cityid);
        $stmt->bindValue(":additionalinfo", $addinfo);
        $stmt->bindValue(":discount", 0);
        $stmt->execute();
        $laatsteNieuweId = $dbh->lastInsertId();
        $dbh = null;
        return (int) $laatsteNieuweId;
    }


    public function getUserbyID($id): User
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("SELECT * FROM users Where userid = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = new User(
            (int) $result["userid"],
            (string) $result["name"],
            (string) $result["familyname"],
            (string) $result["email"],
            (string) $result["password"],
            (string) $result["street"],
            (int) $result["housenr"],
            (int) $result["cityid"],
            (string) $result["additionalinfo"],
            (int) $result["discount"]
        );

        $dbh = null;
        return $user;

    }


    public function editNameandFamilynameByUserID($name, $familyname, $id)
    {

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("UPDATE users SET name = :name, familyname = :familyname WHERE userid = :id");
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":familyname", $familyname);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $dbh = null;
        return $count;

    }

    public function editAdressByUserID($street, $housenr, $id)
    {

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("UPDATE users SET street = :street, housenr = :housenr WHERE userid = :id");
        $stmt->bindValue(":street", $street);
        $stmt->bindValue(":housenr", $housenr);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $dbh = null;
        return $count;

    }


    public function editUsersCityID($userid, $cityid)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare("UPDATE users SET cityid = :cityid WHERE userid = :id");
        $stmt->bindValue(":cityid", $cityid);
        $stmt->bindValue(":id", $userid);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        $dbh = null;
        return $count;

    }
}