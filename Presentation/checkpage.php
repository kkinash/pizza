<?php

declare(strict_types=1);

?>




<div class="flex j-center box2 mobile-hidden roadmap border-bottom">
    <div class="box05 route "><span>1</span>Pizzakeuze</div>
    <div class="box05 route active"><span>2</span>Leveringsgegevens</div>
    <div class="box05 route"><span>3</span>Bevestiging en betaling</div>
</div>
<div id="content" class="content wrap-reverse-mob">

    <div class="flex flex-2 border mr-3" id="order">

        <div class="flex " id="order-or-login">

            <div id="login" class="box-r flex column ai-center">
                <h3 class="h3-login">Ik heb een account</h3>
                <h4><span>Login</span></h4>
                <span style="color:red;">
                    <?php print $error_login ?>
                </span>


                <?php if (!isset($_SESSION["user"])) { ?>

                    <div class="form ">
                        <form class="flex column " action="./checkpage.php?action=process" method="POST">
                            <label for="username" class="form-label">Login (email): </label>
                            <input type="text" class="form-control" name="username" id="username" <?php if (isset($_COOKIE['email'])) { ?> value="<?php print $_COOKIE['email']; ?>"><?php } else { ?> > <?php } ?>
                        <label for="password" class="form-label">Wachtwoord: </label>
                        <input type="password" class="form-control" name="password" id="password">
                        <button type="submit" class="button justify-content-center" formaction="./checkpage.php?action=process">Login</button>
                        </form>

                    </div>
            </div>
        <?php } ?>


        <div id="register" class="box-l flex column">

            <h3>Ik heb geen account</h3>
            <h4><span>Bestel</span></h4>
            <span style="color:red;">
                <?php print $error_register ?>
            </span>


            <div class="form login">
                <form class="flex column" action="./checkpage.php?action=signup" method="POST">

                    <h4>Adres</h4>
                    <label for="postcode">Postcode</label>
                    <input type="number" id="xpostcode" name="postcode" onkeyup="trackChange(this.value)" required <?php if (isset($_SESSION['userpostcode'])) { ?> value="<?php echo $_SESSION['userpostcode'] ?>" <?php } ?>>
                    <label id="delivering-yes" class="success" style="display: none;">Yes, we can deliver
                        there!</label>
                    <label id="delivering-no" class="error" style="display: none;">Sorry, we can't deliver
                        there</label>
                    <label id="need4" class="error" style="display: none;">Postcode moet 4 letters zijn</label>

                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>

                    <label for="street">Street</label>
                    <input type="text" id="street" name="street" required>

                    <label for="housenr">House Number</label>
                    <input type="number" id="housenr" name="housenr" min="0">
                    <h4>Persoonlijke gegevens</h4>
                    <label for="name">First Name:</label>
                    <input type="text" id="name" name="name" value="John" required>

                    <label for="familyname">Family Name:</label>
                    <input type="text" id="fname" name="fname" value="Doe" required>


                    <label for="additionalinfo">Additional info</label>
                    <input type="text" id="additionalinfo" name="additionalinfo">

                    <div class="flex " style="margin: .5rem;"><input style="margin-right: 1rem;" type="checkbox" id="agree" name="agree" onclick="boxChecked()"><label for="agree">
                            <h3>I
                                want to create an account</h3>
                        </label>

                    </div>

                    <input type="submit" class="button" id="order-btn" name="btnGoahead" value="Order" style="display:block" formaction="./checkout.php?action=goahead">
                    <div id="emailandpass" style="display:none">
                        <div class="flex column">
                            <h4>Account gegevens</h4>
                            <label for="email">Email:</label>
                            <input type="email" id="reg-email" name="email">

                            <label for="password">Wachtwoord:</label>
                            <input type="password" id="reg-password" name="password">

                            <label for="rpassword">Herhaal wachtwoord:</label>
                            <input type="password" id="reg-rpassword" name="rpassword">

                            <br>
                            <input type="submit" class="button" name=" btnSingUp" value="Sign Up">
                        </div>
                    </div>
                </form>

            </div>
        </div>




        </div>
    </div>
    <div class="box flex-1 border mr-3" id="bill">
        <?php include_once("Presentation/short-cart.php"); ?>
    </div>
</div>

<script>
    /* PHP POSTCODES ARRAY TO JS */
    <?php
    $js_deliverible = json_encode($deliverible);
    echo "var deliverible_js_array = " . $js_deliverible . ";\n";
    ?>
    // function isInArray(array, search) {
    //     return array[] >= 0;
    // }



    function trackChange(value) {
        let a = 'a';
        let code = parseInt(value);;
        if (value.toString().length == 4) {
            document.getElementById("need4").style.display = "none";
            let a = isInArray(deliverible_js_array, code);
            console.log(a);
            if (a == true) {
                document.getElementById("delivering-yes").style.display = "block";
                document.getElementById("delivering-no").style.display = "none";

            } else {
                document.getElementById("delivering-yes").style.display = "none";
                document.getElementById("delivering-no").style.display = "block";
            }
        } else {
            document.getElementById("need4").style.display = "block";
            document.getElementById("delivering-yes").style.display = "none";
            document.getElementById("delivering-no").style.display = "none";


        }

    }
</script>