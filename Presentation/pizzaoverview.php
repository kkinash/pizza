<?php
$allPizzaId = [];

foreach ($pizzaList as $pizza) {
    $allPizzaId[] = $pizza->getId();
}

?>

<script type="module">
    import A11yDialog from 'https://cdn.jsdelivr.net/npm/a11y-dialog@8/dist/a11y-dialog.esm.min.js';
    var jsPizzaArray = <?php echo json_encode($allPizzaId); ?>;
    for (let index = 0; index < jsPizzaArray.length; ++index) {
        const element = jsPizzaArray[index];
        const container = document.querySelector(`#dialog` + element);
        const cartcontainer = document.querySelector('#cart-dialog');
        const dialog = new A11yDialog(container);
        const cartdialog = new A11yDialog(cartcontainer);
    }
</script>

<!-- start cart dialog -->
<div class="dialog-container" id="cart-dialog" aria-hidden="true" aria-labelledby="my-dialog-title" aria-describedby="my-dialog-description">
    <div class="dialog-overlay" data-a11y-dialog-hide></div>
    <div class="dialog-content " role="document">
        <button data-a11y-dialog-hide class="dialog-close " style="margin-bottom: 1rem;" aria-label="Close this dialog window">
            X
        </button>
        <?php include("Presentation/cart.php"); ?>
    </div>
</div>
<!-- end cart dialog -->

<div class="flex j-center box2 mobile-hidden roadmap border-bottom">
    <div class="box05 route active"><span>1</span>Pizzakeuze</div>
    <div class="box05 route"><span>2</span>Leveringsgegevens</div>
    <div class="box05 route"><span>3</span>Bevestiging en betaling</div>
</div>
<div class="flex ">
    <div id="content" class="content wrapper column">

        <h1 class="content-title">Menu</h1>

        <div id="list" class="product-list" name="list">

            <?php
            foreach ($pizzaList as $pizza) {
            ?>
                <div class="item">
                    <!-- start dialog -->
                    <div class="dialog-container" id="dialog<?php print($pizza->getId()); ?>" aria-hidden="true" aria-labelledby="my-dialog-title" aria-describedby="my-dialog-description">
                        <div class="dialog-overlay" data-a11y-dialog-hide></div>
                        <div class="dialog-content " role="document">
                            <button data-a11y-dialog-hide class="dialog-close" aria-label="Close this dialog window">
                                X
                            </button>
                            <div class="box-n-t flex popup-container ">
                                <div class="flex column dialog-item box05 prs50">
                                    <img src="Design/img/<?php print($pizza->getId()); ?>.png" style="width: 100%;">
                                </div>
                                <div class="flex column box05 dialog-item prs50">
                                    <div class="dialog-title">
                                        <?php print($pizza->getName()); ?>
                                    </div>
                                    <div class="flex row wrap border-bottom">
                                        <div class="box05 ttl-d" style="padding: 1rem 1rem 1rem .5rem;">
                                            <span>Productinhoud:</span>
                                            <?php print($pizza->getDescription()); ?>
                                        </div>
                                        <div class="box05 flex wrap w100">
                                            <div>
                                                <div class=" ttl-d"><span>Diameter: </span>30 cm</div>
                                                <div class=" ttl-r"><span>Gewicht: </span>450 ± 50 g </div>
                                            </div>
                                            <form method="POST" class="order-dialog flex row " role="form">
                                                <div class="dialog-order-bar">
                                                    <input type="hidden" name="product" value="<?php print($pizza->getId()); ?>" />
                                                    <input type="hidden" name="action" value="order" />
                                                    <button type="submit" value="submit" class="order-btn-white">Bestel</button>

                                                    <input name="count" class="count-txt" hidden type="number" min="1" value="1">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="desc-items flex wrap">
                                        <div class="dialog-block-item">


                                            <div class="ttl flex column">Openingsuren:</div>

                                            <div class="flex"><img src="Design/img/icons/time.svg" width="18px" style="margin-right: 6px;">
                                                <div class="txt">11:00 - 21:00</div>
                                            </div>

                                        </div>
                                        <div class="dialog-block-item column">


                                            <div class=" ttl flex">Koerier betaalmethoden:

                                            </div>
                                            <div class="flex">
                                                <img src="Design/img/icons/alien-cash.svg" width="30px" style="margin-right: 8px; padding: 2px;">
                                                <div class=" txt">Contant geld
                                                </div>

                                            </div>
                                            <div class="flex">
                                                <img src="Design/img/icons/monitor.svg" width="30px" style="margin-right: 8px;padding: 2px;">
                                                <div class="txt">Payconic</div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end dialog -->

                    <a class="relative mt1" data-a11y-dialog-show="dialog<?php print($pizza->getId()); ?>">
                        <div class="div-pizza-img"><img class="pizza-img" loading="lazy" src="Design/img/<?php print($pizza->getId()); ?>.png">
                        </div>


                        <div class="title">
                            <?php print($pizza->getName()); ?>
                        </div>
                    </a>
                    <div class="description">
                        <?php print($pizza->getDescription()); ?>
                    </div>

                    <div id="price-size" class="price-size">
                        <div class="size">Size - 30 cm</div>
                        <div id="price" class="price">
                            <?php
                            if (isset($_SESSION["discount"]) && $_SESSION["discount"] !== 0) {
                            ?><span style="text-decoration: line-through; color: grey;">
                                    <?php print($pizza->getPrice()); ?>
                                </span> &nbsp
                                <?php
                                print($pizza->getPromotionprice());
                            } else {
                                print($pizza->getPrice());
                            } ?>€
                        </div>
                    </div>
                    <form method="POST" class="order flex row" role="form">
                        <div class="order-bar">
                            <input type="hidden" name="product" value="<?php print($pizza->getId()); ?>" />
                            <input type="hidden" name="action" value="order" />
                            <button type="submit" value="submit" class="order-btn">Bestel</button>
                            <div class="cart-count">
                                <input name="count" class="count-txt" type="number" min="1" value="1">
                                <div class="btns">
                                    <span class="plus"></span>
                                    <span class="minus">
                                    </span>
                                </div>

                            </div>



                        </div>
                    </form>

                </div>
            <?php } ?>



        </div>
    </div>





    <div class="flex column cart-container sticky">
        <?php

        if (isset($_SESSION['orderid']) && isset($_SESSION['userid']) && isset($_SESSION['payedOrder']) && $_SESSION['payedOrder'] !== 1) { ?>
            <div class="cart-box flex column border-bottom pt-2rem ">
                <div class=" flex column  ">
                    <h1 class="flex t-center astronaut-icon ">Je hebt een onvoltooide
                        bestelling:</h1>
                    <center><a href="./checkpage.php">
                            <h2> #
                                <?php print $_SESSION['orderid'] ?>
                            </h2>
                        </a></center>

                </div>
            </div>
        <?php } ?>
        <div id="check-destination" class="cart-box flex column border-bottom pt-2rem">
            <h1 class="rocket-icon">Controleer en pas de bezorgzone toe</h1>
            <div class="flex column j-center">
                <?php include_once("Presentation/Forms/check-location.php"); ?>
            </div>
        </div>
        <div id="box" class="cart-box flex column">
            <h1 class="rover-icon">Je winkelmandje</h1>
            <?php if (isset($_SESSION['userid'])) {
            } else { ?>
                <p class="user-info"><a href="./checkpage.php">Log in</a> om kortingsprijzen te krijgen!</p><br><br>
            <?php }; ?>
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            ?>




            <?php include("Presentation/cart.php");
            } else { ?>
                <div class="flex j-center">
                    Winkelwagentje is leeg </div>
            <?php
            } ?>
            <?php
            ?>
        </div>
    </div>
</div>