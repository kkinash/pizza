<?php
//Presentation/header.php
declare(strict_types=1);
session_start();

// $_SESSION['actual_link'] = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// print($_SESSION['actual_link']);

?>

<!doctype html>
<html lang="nl-BE">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Design/css/style.css">
    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=kumbh-sans:100,200,300,400,500,600,700,800,900|readex-pro:500" rel="stylesheet" />
    <link href="http://mozilla.github.io/foundation-icons/assets/foundation-icons.css" type="text/css" rel="stylesheet">
    <script src="http://js.stripe.com/v3/"></script>
    <title>Pizza Planet</title>

    <script src="Design/js/checked.js" defer></script>
</head>