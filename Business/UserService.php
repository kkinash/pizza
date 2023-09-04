<?php //UserService.php
declare(strict_types=1);
namespace Business;

use Data\UserDAO;
use Entities\User;
use Exceptions\PasswordsDoNotMatchException;

class UserService
{
    private UserDAO $userDAO;
    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function loginUser($username, $password): ?User
    {
        return $this->userDAO->loginUser($username, $password);
    }

    public function registerUserOvewview($name, $familyname, $email, $password, $street, $housenr, $postcode, $cityname, $addinfo): int
    {
        return $this->userDAO->registerUser($name, $familyname, $email, $password, $street, $housenr, $postcode, $cityname, $addinfo);
    }

    public function checkPassword($password, $rpassword): int
    {
        if ($password !== $rpassword) {

            throw new PasswordsDoNotMatchException();
        }
        return 0;
    }

    public function registerUserWithoutEmailOvewview(
        string $name,
        string $familyname,
        string $street,
        int $housenr,
        int $postcode,
        string $cityname,
        string $addinfo
    ): int
    {
        return $this->userDAO->registerUserWithoutEmail(
            $name,
            $familyname,
            $street,
            $housenr,
            $postcode,
            $cityname,
            $addinfo
        );

    }

    public function getUserbyIDOverview($id): User
    {

        $userDAO = new UserDAO();
        $user = $userDAO->getUserbyID($id);

        return $user;
    }

    public function editNameandFamilynameByUserIDOverview($name, $familyname, $id)
    {
        $userDAO = new UserDAO();
        $result = $userDAO->editNameandFamilynameByUserID($name, $familyname, $id);
        return $result;
    }


    public function editAdressByUserIDOverview($street, $housenr, $id)
    {
        $userDAO = new UserDAO();
        $result = $userDAO->editAdressByUserID($street, $housenr, $id);
        return $result;
    }

    public function editUsersCityIDOverview($userid, $cityid)
    {
        $userDAO = new UserDAO();
        $result = $userDAO->editUsersCityID($userid, $cityid);
        return $result;
    }


}