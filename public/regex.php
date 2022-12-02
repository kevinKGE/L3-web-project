<?php

/**@param value : value to test
* @param regex : regex to test against
* @return true if value matches regex, false otherwise
*/
function regex($value, $regex) {
    return preg_match($regex, $value);
}

function validate_format($user){

    $date_of_the_day = date("yyyy-mm-dd");
    $res = abs($date_of_the_day - $user['birthDate']);
    echo "<br>";
    echo $res;
    echo "<br>";

    if ($user['login'] === "" || !regex($user['login'], "/^[a-zA-Z0-9]*$/")) {
        return 'le login doit contenir uniquement des minuscules, majuscules non accentuées et des chiffres';
    }
    else if ($user['name'] !== "" && !regex($user['name'], "/^([A-Za-zÀ-ÖØ-öø-ÿ ']+((\-)*[A-Za-zÀ-ÖØ-öø-ÿ']+)*)$/")){
        return 'le nom doit contenir uniquement des minuscules, majuscules, des '-', des " \' " ou des espaces';
    }
    else if ($user['firstName'] !== "" && !regex($user['firstName'], "/^([A-Za-zÀ-ÖØ-öø-ÿ ']+((\-)*[A-Za-zÀ-ÖØ-öø-ÿ']+)*)$/")){
        return 'le nom doit contenir uniquement des minuscules, majuscules, des '-', des " \' " ou des espaces';
    }
    else if ($res < 18){
        return 'vous devez avoir au moins 18 ans pour pouvoir vous inscrire';
    }
    else {
        return true;
    }
}
