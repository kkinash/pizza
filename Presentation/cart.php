<div class="Header flex">
    <h3 class="Heading">Uw bestelling</h3>
    <h5 class="action-remove"><a class="link" href="./clearcart.php">Remove all</a></h5>
</div>
<?php
$totalcost = 0;
foreach ($_SESSION['cart'] as $cartItem) {

    $id = $cartItem->getProductid();
    $thispizza = $pizzaSvc->getPizzaByIdOverview($id);


?>
    <div class="cart-items flex">
        <div class="image-box">
            <img src="Design/img/<?php print $thispizza->getId() ?>.png" />
        </div>
        <div class="about">
            <h1 class="title">
                <?php print $thispizza->getName() ?>
            </h1>
            <h3 class="subtitle">
                <?php print $thispizza->getDescription() ?>
            </h3>

        </div>
        <div class="counter ">
            <div class="count flex">
                <?php print $cartItem->getNumber() ?>
            </div>

        </div>
        <div class="prices flex">
            <div class="amount">
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

    </div>
<?php }
?>

<hr>
<div class="checkout  border-top flex">
    <div class="total">
        <div class="Subtotal">Sub-Total:</div>
        <div class="total-amount">
            <?php
            $_SESSION['totalcost'] = $totalcost;
            echo $totalcost;
            ?>€
        </div>
    </div>

    <div class="checkout_button">
        <?php if (isset($_SESSION['orderid'])) {
        ?>
            <form method="get" style="width:250px">
                <button type="submit" name="order" formaction="./checkout.php" value="neworder" class="button justify-content-center"> <?php
                                                                                                                                        if (isset($_SESSION['orderid']) && isset($_SESSION['userid'])) {
                                                                                                                                        ?>Rond de bestelling af</button>
                <?php
                                                                                                                                        } else {

                ?>Nieuwe bestelling aanmaken</button>
            <?php } ?>
            </form>
        <?php } else { ?>
            <form style="width:250px" action="./checkpage.php"><button class="button justify-content-center">Checkout</button></form>
        <?php } ?>
    </div>
</div>
</div>
</div>