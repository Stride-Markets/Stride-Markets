<?php
function isValidName($name){
    return preg_match("/^[a-zA-Z-' áéíóúÁÉÍÓÚ]*$/",$name);
}

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPhone($phone){
    return isANumber($phone);
}

function isANumber($phone){
    return preg_match("/^[0-9]*$/",$phone);
}
?>