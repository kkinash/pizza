<div class="">
    <div class="Header flex ">
        <h3 class="Heading">Uw besteling</h3>
    </div>
    <?php
    $totalcost = 0;
    foreach ($_SESSION['cart'] as $cartItem) {

        $id = $cartItem->getProductid();
        $thispizza = $pizzaSvc->getPizzaByIdOverview($id);
        ?>

        <div class="cart-items check flex">
            <div style="width: 25%;">
                <?php print $cartItem->getNumber() ?> x
            </div>
            <div style="width: 50%">
                <?php print $thispizza->getName() ?>
            </div>
            <div style="width: 25%" class="right">

                <?php if (isset($_SESSION['user']) && $_SESSION["discount"] > 0) {
                    $price = $thispizza->getPromotionprice() * $cartItem->getNumber();
                    print $price;
                    $totalcost = $totalcost + $price;
                } else {
                    $price = $thispizza->getPrice() * $cartItem->getNumber();
                    print $price;
                    $totalcost = $totalcost + $price;
                } ?> €
            </div>



        </div>

    <?php }
    ?>


    <hr>
    <div class="checkout  border-top flex">

        <div class="subtotal">Sub-Total:</div>
        <div class="total-amount">
            <?php
            $_SESSION['totalcost'] = $totalcost;
            echo $totalcost;
            ?>€

        </div>

    </div> <a href="./index.php">Bewaar</a>
</div>