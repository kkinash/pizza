<script>
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }

    function openForm2() {
        document.getElementById("popupForm2").style.display = "block";
    }

    function closeForm2() {
        document.getElementById("popupForm2").style.display = "none";
    }

    function openForm3() {
        document.getElementById("popupForm3").style.display = "block";
    }

    function closeForm3() {
        document.getElementById("popupForm3").style.display = "none";
    }
</script>


<div class="flex j-center box2 mobile-hidden roadmap border-bottom">
    <div class="box05 route "><span>1</span>Pizzakeuze</div>
    <div class="box05 route"><span>2</span>Leveringsgegevens</div>
    <div class="box05 route active"><span>3</span>Bevestiging en betaling</div>
</div>
<div id="content" class="content wrap ai-center jc-center">
    <?php if (isset($_SESSION["orderid"])) { ?>
        <div class="flex column" style="width: auto;">


            <div class="flex column ai-center ">
                <?php if (isset($_GET['payment']) && $_GET['payment'] == 'cancel') { ?>
                    <h2 class="flex t-center red">Betaling geannuleerd. Probeer het nog eens</h2>
                <?php
                } elseif (isset($_GET['payment']) && $_GET['payment'] == 'success') {
                    $_SESSION['payedOrder'] = 1;
                    unset($_SESSION['cart']);
                ?>
                    <h2 class="flex t-center green">Betaling ontvangen! De bestelling is verzonden!</h2>
                <?php
                } else { ?>
                    <h2 class="flex t-center">Uw bestelling is klaar voor betaling</h2>
                <?php } ?><br>
                <div class="box05 flex row ai-center jc-center">
                    <div class="flex column ai-center"> <img class="box05" width="85px" src="Design/img/icons/ship-pizza.svg" />
                    </div>
                    <h4>Bestellingsnummer:
                        <?php
                        print $_SESSION["orderid"]; ?>
                    </h4>
                </div>
            </div>
            <div class="flex row border wrap cart-items">
                <div class="flex column box">
                    <h3 class="Heading">Your
                        Details
                        <a onclick='openForm()'></a>
                    </h3>
                    <div class="user-item">
                        Name:
                        <?php print $user->getName() ?>&nbsp;
                        <?php print $user->getFamilyName() ?>
                    </div>

                    <div class="user-item">
                        Discount:
                        <?php
                        $disc = $user->getDiscount();
                        if ($disc == 1) {
                            echo "50%";
                        } else {
                            echo "no discount";
                        }
                        ?>
                    </div>

                </div>
                <div class="flex row box column">


                    <h3 class="">Bestel adres:
                        <?php
                        // if (in_array($place->getPostcode(), $_SESSION['deliverible'])) {
                        //     
                        ?><span style="color:var(--ins-color);">

                            <?php // print "We can deliver here"; 
                            ?>

                        </span>

                        <?php
                        // } else { 
                        ?><span style="color:var(--del-color);">

                            <?php // print "We can NOT deliver here"; 
                            ?>

                        </span>

                        <?php
                        // }
                        ?>
                    </h3>
                    <div class="user-item">

                        <?php print($place->getPostcode()); ?>
                        ,
                        <?php print($place->getName()); ?>
                        ,</p>
                        <p>
                            <?php print($user->getStreet()); ?>
                            ,
                            <?php print($user->getHousenr()); ?>
                        </p>
                    </div>


                </div>
            </div>

            <div class="cart-items flex column border">
                <h3 class="p-2-2-0-2">Beestelling <span>
                </h3>
                <?php foreach ($orderitems as $item) {
                    $id = $item->getProductid();
                    $thispizza = $pizzaSvc->getPizzaByIdOverview($id);
                ?>

                    <div class="Item flex  box">
                        <div class="image-box">
                            <img width="64px" src="Design/img/<?php print $thispizza->getId() ?>.png" />
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
                                <?php print $item->getNumber() ?>
                            </div>
                        </div>
                        <div class="prices">
                            <div class="amount flex">
                                <?php if (isset($_SESSION['user']) && $_SESSION["discount"] > 0) {
                                    $price = $thispizza->getPromotionprice() * $item->getNumber();
                                    print $price;
                                    $totalcost = $totalcost + $price;
                                } else {
                                    $price = $thispizza->getPrice() * $item->getNumber();
                                    print $price;
                                    $totalcost = $totalcost + $price;
                                } ?> €
                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>
            <?php if (isset($_GET['payment']) && $_GET['payment'] == 'success') {
            } else { ?>
                <div class="box flex stripe j-center" style="width:96%">
                    <div class="total">
                        <div>
                            <div class="Subtotal">Total</div>

                        </div>
                        <div class="total-amount">
                            <?php
                            print($order->getTotalprice());
                            ?>€
                        </div>
                    </div>

                    <form action="./stripecheckout.php" method="POST">
                        <button type="submit" id="checkout-button">Uitchecken</button>
                    </form>
                </div>
                <div id="test-payment" class="j-center flex column ">
                    <h5>Betaalgegevens voor testbetaling:</h5>
                    <div class="credit-card flex column">
                        <div class="card-number">4242 4242 4242 4242</div>
                        <div class="name">ANY NAME</div>
                        <div class="flex name-cv">

                            <div class="date">ANY/DATE</div>
                            <div class="cv2">ANY-CV2</div>
                        </div>
                    </div>
                </div>
        </div>
</div>

<?php } ?>



</div>

</div>
<script src="Design/js/stripe.js" defer></script>
<?php
    } else {
    } ?>