<?php

//checkout.php


require_once("vendor/autoload.php");

use Business\PizzaService;
use Business\UserService;
use Business\OrderService;
use Business\OrderItemService;
use Business\PlaceService;

use Exceptions\PasswordsDoNotMatchException;
use Exceptions\UserNotFoundException;
use Exceptions\EmailExistsException;
use Exceptions\PlaceExistsException;
use Exceptions\InvalidPasswordException;

$pizzaSvc = new PizzaService;
$userSvc = new UserService;
$orderSvc = new OrderService;
$orderitemSvc = new OrderItemService;
$placeSvc = new PlaceService;


$totalcost = 0;
$error = '';
include_once("Presentation/header.php");
include_once("Presentation/menu.php");
$_SESSION['payedOrder'] = 0;
if (!isset($_SESSION["userid"])) {
    header("Location: ./checkpage.php");
}

/******************** ACTION LOGIN ********************/
if (!isset($_SESSION['user']) && isset($_GET['action']) && $_GET['action'] === 'process') {
    $username = $_POST["username"];
    $password = $_POST['password'];

    $userService = new UserService();

    try {
        $userAccount = $userService->loginUser($username, $password);

        $_SESSION["userAccount"] = serialize($userAccount);
        $_SESSION["user"] = $username;
        $_SESSION["userid"] = $userAccount->getId();
        $_SESSION["name"] = $userAccount->getName();
        $_SESSION["familyname"] = $userAccount->getFamilyName();
        $_SESSION["email"] = $userAccount->getEmail();
        $_SESSION["street"] = $userAccount->getStreet();
        $_SESSION["housenr"] = $userAccount->getHousenr();
        $_SESSION["placeid"] = $userAccount->getCityid();
        $_SESSION["addinfo"] = $userAccount->getUserAddInfo();
        $_SESSION["discount"] = $userAccount->getDiscount();
        unset($_COOKIE['email']);
        setcookie('email', $_SESSION["email"], time() + 86400);
        echo "<meta http-equiv='refresh' content='0'>";
    } catch (UserNotFoundException $e) {
        $error_login = "User with this email doesn't exist";
    } catch (InvalidPasswordException $e) {
        $error_login = "Wrong password";
    } catch (\Exception $e) {
        $error_login = "Unknown error: kan niet inloggen.";
    }
    //  header("location: index.php");
    // echo 'Hello, ' . $_SESSION["user"];


}
/******************** LOGIN END ********************/


/******************** ACTION REGISTER ********************/
if (!isset($_SESSION['user']) && isset($_GET['action']) && $_GET['action'] === 'signup') {
    $userService = new UserService();
    $registerresult = '0';
    $name = $_POST['name'];
    $familyname = $_POST['fname'];
    $password1 = $_POST['password'];
    $password2 = $_POST['rpassword'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $housenr = (int) $_POST['housenr'];
    $postcode = (int) $_POST['postcode'];
    $cityname = $_POST['city'];
    $addinfo = $_POST['additionalinfo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    try {
        $userService->checkPassword($password1, $password2);
        $registerresult = $userService->registerUserOvewview($name, $familyname, $email, $password, $street, $housenr, $postcode, $cityname, $addinfo);

        $error_register = "You have successfully signed up. Let`s Login!";
        //echo '<script>alert("You have successfully signed up. Let`s Login!")</script>';
    } catch (PasswordsDoNotMatchException $e) {

        $error_register = "Pasword and password repeat doesnt match!";
    } catch (EmailExistsException $e) {
        $error_register = "This email is allready taken!";
    } catch (\Exception $e) {
        $error_register = "Onbekende fout: kan niet register.";
    }
    // if registration is successful -> login
    if ($registerresult > 0) {
        try {
            $userAccount = $userService->loginUser($email, $password1);
            $_SESSION["userAccount"] = serialize($userAccount);
            $_SESSION["user"] = $userAccount->getEmail();
            $_SESSION["userid"] = $userAccount->getId();
            $_SESSION["name"] = $userAccount->getName();
            $_SESSION["familyname"] = $userAccount->getFamilyName();
            $_SESSION["email"] = $userAccount->getEmail();
            $_SESSION["street"] = $userAccount->getStreet();
            $_SESSION["housenr"] = $userAccount->getHousenr();
            $_SESSION["placeid"] = $userAccount->getCityid();
            $_SESSION["addinfo"] = $userAccount->getUserAddInfo();
            $_SESSION["discount"] = $userAccount->getDiscount();
            unset($_COOKIE['email']);
            setcookie('email', $_SESSION["email"], time() + 86400);
            echo "<meta http-equiv='refresh' content='0'>";
        } catch (UserNotFoundException $e) {
            $error_login = "User with this email doesn't exist";
        } catch (InvalidPasswordException $e) {
            $error_login = "Wrong password";
        } catch (\Exception $e) {
            $error_login = "Unknown error: kan niet inloggen.";
        }
    }
}


/******************** REGISTER END ********************/

/******************** CREATE TEMP USER ********************/

if (!isset($_SESSION['user']) && isset($_GET['action']) && $_GET['action'] === 'goahead') {
    $_SESSION["usertype"] = 'temp';

    $usrid = $userSvc->registerUserWithoutEmailOvewview(
        $_POST['name'],
        $_POST['fname'],
        $_POST['street'],
        $_POST['housenr'],
        $_POST['postcode'],
        $_POST['additionalinfo'],
        0
    );
    $_SESSION["userid"] = $usrid;
}

/******************** CREATE TEMP USER END ********************/


/****** if discount - other price for TOTAL*/
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        $id = $cartItem->getProductid();
        $thispizza = $pizzaSvc->getPizzaByIdOverview($id);
        if (isset($_SESSION['user']) && $_SESSION["discount"] > 0) {
            $price = $thispizza->getPromotionprice() * $cartItem->getNumber();

            $totalcost = $totalcost + $price;
        } else {
            $price = $thispizza->getPrice() * $cartItem->getNumber();

            $totalcost = $totalcost + $price;
        };
    }
    $_SESSION["totalcost"] = $totalcost;
}

/* end discount */

/******************** CREATING ORDER + WRITING IT IN DATABASE ********************/

if (isset($_GET['order']) && $_GET['order'] === 'neworder') {
    unset($_SESSION['orderid']);
    if (!isset($_GET['reload'])) {
        echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
    }
}

if (!isset($_SESSION["orderid"])) {

    date_default_timezone_set('Europe/Brussels');
    $date = date('Y/m/d H:i:s');
    $totalprice = $_SESSION["totalcost"];
    $orderid = $orderSvc->addOrderOverview($_SESSION["userid"], $date, $totalprice);
    $_SESSION["orderid"] = $orderid;
    // create orderItems <---- orderItemID
    foreach ($_SESSION["cart"] as $item) {
        $currentNumberOfProduct = $item->getNumber();
        $currentProductId = $item->getProductid();
        $orderitemSvc->addOrderItemOverview(
            $orderid,
            $currentProductId,
            $currentNumberOfProduct
        );
    }
}

/******************* ORDER CREATED  *************************/



/******************* ORDER GET FROM DB AND SHOW  *************************/
if (isset($_SESSION["orderid"])) {


    // get all order parts Info
    $order = $orderSvc->getOrderbyIDOverview($_SESSION["orderid"]);
    $order_userid = $order->getUserid();
    $orderitems = $orderitemSvc->getAllItemsByOrderIDOverview($_SESSION["orderid"]);
    $user = $userSvc->getUserbyIDOverview($order_userid);
    $order_placeid = $user->getCityid();
    $place = $placeSvc->getPlacebyIdOverview($order_placeid);
}


/******************* EDIT ORDER LOGIC SECTION  *************************/

// edit Name
if (isset($_GET['action']) && $_GET['action'] === 'editname') {
    $edit_userid = $user->getId();
    $changename = $userSvc->editNameandFamilynameByUserIDOverview($_GET['name'], $_GET['familyname'], $edit_userid);
    if (!isset($_GET['reload'])) {
        echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
    }
}

// edit Street
if (isset($_GET['action']) && $_GET['action'] === 'editadress') {
    $edit_userid = $user->getId();
    $change = $userSvc->editAdressByUserIDOverview($_GET['street'], $_GET['housenr'], $edit_userid);
    if (!isset($_GET['reload'])) {
        echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
    }
}

// edit City
if (isset($_GET['action']) && $_GET['action'] === 'editcity') {
    $edit_userid = $user->getId();
    $postcode = (int) $_GET['postcode'];
    $cityid = $placeSvc->editPlaceinOrderbyPostcodeOverview($postcode, $_GET['city'],);
    print($id);
    $res = $userSvc->editUsersCityIDOverview($edit_userid, $cityid);
    if (!isset($_GET['reload'])) {
        echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
    }
}
/******************* EDIT ORDER LOGIC SECTION  *************************/





include_once("Presentation/orders.php");

include_once("Presentation/footer.php");
?></body>

</html>