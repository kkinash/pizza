<?php
//confirmed.php

spl_autoload_register();
require_once("vendor/autoload.php");


include_once("Presentation/header.php");
include_once("Presentation/menu.php");


if (isset($_GET['action']) && $_GET['action'] === 'deleteorder') {
    unset($_SESSION['orderid']);
    if (!isset($_GET['reload'])) {
        echo '<meta http-equiv=Refresh content="0;url=?reload=1">';
    }
}

include_once("Presentation/confirmed.php");