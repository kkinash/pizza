<?php

spl_autoload_register();
require_once("vendor/autoload.php");

include_once("Presentation/header.php");
include_once("Presentation/menu.php");


unset($_SESSION['cart']);
$_SESSION['cart'] = array();
unset($_SESSION['totalcost']);
echo "<meta http-equiv='refresh' content='0'>";

sleep(0.2);
$link = './index.php';
header("Location: $link");

?>