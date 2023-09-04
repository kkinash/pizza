<form method="POST" class="form flex column j-center postcode">

    <!-- <label for="postcode">Postcode</label> -->
    <input type="number" placeholder="postcode" min="1000" id="xpostcode" name="postcode"
        onkeyup="trackChange(this.value)" required>
    <label id="delivering-yes" class="success" style="display: none;">Ja, we kunnen daar leveren
        !</label>
    <label id="need4" class="error" style="display: none;">Postcode moet 4 letters bevatten</label>
    <label id="delivering-no" class="error" style="display: none;">Sorry, daar kunnen we niet bezorgen</label>
    <button class="white button-3-6">Instellen</button>
</form>

<script>
    /* PHP POSTCODES ARRAY TO JS */
    <?php
    $js_deliverible = json_encode($deliverible);
    echo "var deliverible_js_array = " . $js_deliverible . ";\n";
    ?>
    // function isInArray(array, search) {
    //     return array;
    // }

    function trackChange(value) {
        let wecandeliver = '';
        let code = parseInt(value);;
        if (value.toString().length == 4) {
            document.getElementById("need4").style.display = "none";
            console.log(code);
            let wecandeliver = deliverible_js_array.includes(code);
            if (wecandeliver == true) {
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