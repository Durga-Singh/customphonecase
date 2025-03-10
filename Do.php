<?php

function valid_email($email){
    $result = trim($email);
    if(filter_var($result, FILTER_VALIDATE_EMAIL)){
        return "Email Valid";
    } else {
        echo "Email not Valid";
    }
}

echo valid_email("abc@gmail.com");

?>



<label for="username">
    Username: (3-10 characters)
</label>
<input type="text" pattern="\w{3,10}" id="username" name="username" value="Percent" required/>

<label for="pin">
    PIN: (4 digits)
</label>
<input type="password" pattern="\d{4,4}" id="pin" name="pin" required/>
