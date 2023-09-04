<?php
// Presentation/menu.php
?>

<body>
    <div class="page-header">
        <a href="./index.php">
            <img src="Design/img/pp_logo.svg" class="logo" style="width:162px;">
        </a>
        <a data-a11y-dialog-show="cart-dialog"><img src="Design/img/icons/abduction.svg" class="basket sticky pulse desktop-hidden <?php
                                                                                                                                    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) < 1) {
                                                                                                                                    ?>inactive <?php }
                                                                                                                                                ?>" style="width:85px;"></a>
        <!-- </div> <a href="./logout.php">Log out </a> -->
        <!-- <div> 
        <table>
             <?php

                //   echo "-->  Post ";
                //  foreach ($_POST as $key => $value) {
                //       echo "<tr>";
                //       echo "<td>";
                //       echo $key;
                //      echo "</td>";
                //       echo "<td>";
                //       echo $value;
                //       echo "</td>";
                //       echo "</tr>";
                //   } 
                ?><br><br>
            <?php
            //    echo "--> Session";
            //    foreach ($_SESSION as $key => $value) {
            //        echo "<tr>";
            //        echo "<td>";
            //        echo $key;
            //        echo "</td>";
            //        echo "<td>";
            //        var_dump($value);
            //        echo "</td>";
            //        echo "</tr>";
            //    }

            ?>
        </table>-->
    </div>




    <!--
    function stickyHeader() {
    var header = $('.page-header_mobile'),
        scroll = $(window).scrollTop();
    if ($('.main-section').length == 1 && $(document).outerWidth() < 1200) {
        $('.main-section').css('padding-top', header.outerHeight() + 15 + 'px');
        if (scroll >= $('.main-section').outerHeight()) {
            header.addClass('scroll');
        } else {
            header.removeClass('scroll');
        }
    } else {
        $('.main-section').css('padding-top', '15px');
        header.addClass('scroll');

        if ($(document).outerWidth() < 1200) {
            $('.page-wrapper').css('padding-top', header.outerHeight() + 25 + 'px');
        } else {
            $('.page-wrapper').css('padding-top', '');
        }
    }
}

-->