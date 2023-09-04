<?php

spl_autoload_register();
require_once("vendor/autoload.php");

include_once("Presentation/header.php");
include_once("Presentation/menu.php");


unset($_SESSION['user']);
unset($_SESSION['userAccount']);
unset($_SESSION["name"]);
unset($_SESSION["familyname"]);
unset($_SESSION["email"]);
unset($_SESSION["street"]);
unset($_SESSION["housenr"]);
unset($_SESSION["placeid"]);
unset($_SESSION["discount"]);
unset($_SESSION["userid"]);
sleep(1);
$link = './index.php';
header("Location: $link");

?>