//checked.js


function boxChecked() {
    var checkBox = document.getElementById("agree");
    var text = document.getElementById("emailandpass");
    var btn = document.getElementById("order-btn");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
        console.log('true!')
        text.style.display = "block";
        btn.style.display = "none";
        document.getElementById("email").required = false;
        document.getElementById("password").required = false;
        document.getElementById("rpassword").required = false;

    } else {
        console.log('false!')
        text.style.display = "none";
        btn.style.display = "block";
        document.getElementById("reg-email").required = true;
        document.getElementById("reg-password").required = true;
        document.getElementById("reg-rpassword").required = true;
    }
}

