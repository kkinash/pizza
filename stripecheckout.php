<?php

require_once 'vendor/autoload.php';
require_once 'secrets.php';
include_once("Presentation/header.php");
include_once("Presentation/menu.php");

use Business\OrderService;
use Business\OrderItemService;
use Business\PizzaService;

$orderSvc = new OrderService;
$orderitemSvc = new OrderItemService;
$pizzaSvc = new PizzaService;

/* getting order details */
$line_items = [];
if (isset($_SESSION["orderid"])) {
    $order = $orderSvc->getOrderbyIDOverview($_SESSION["orderid"]);
    $orderitems = $orderitemSvc->getAllItemsByOrderIDOverview($_SESSION["orderid"]);

    $line_items = [];
    foreach ($orderitems as $item) {
        $id = $item->getProductid();
        $thispizza = $pizzaSvc->getPizzaByIdOverview($id);
        $line_items[] = [
            "price_data" => [
                "currency" => "eur",
                "product_data" => [
                    "name" => $thispizza->getName(),
                    "description" => $thispizza->getDescription()
                ],
                "unit_amount" => $thispizza->getPrice() * 100
            ],
            "quantity" => $item->getNumber()
        ];
    }
}

/* stripe checkout */

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://kinash.space/PizzaPlanet';

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => $line_items,
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/checkout.php?payment=success',
    'cancel_url' => $YOUR_DOMAIN . '/checkout.php?payment=cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
