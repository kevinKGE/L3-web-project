<?php

/** summary: check if the value match the regex
 * @param string $value, string $regex
 * return true if the value match the regex
 */
function regex($value, $regex) {
    return preg_match($regex, $value);
}

/** summary: check if user informations are valid
 * @param $user
 * return true if the user is valid
 * return a string if the user is not valid
 */
function validate_format($user){

    // get the date of the day
    $date_of_the_day = date("Y-m-d");
    // get the birthday of the current user
    $birthday = $user['birthDate'];
    
    // substraction of the two dates
    $res = ($date_of_the_day - $birthday);

    // split the birthday for the checkdate function
    if($birthday !== ""){
        list($year,$month,$day) = explode('-',$birthday);
    }

    // Test if the user informations are valid
    if ($user['login'] === "" || !regex($user['login'], "/^[a-zA-Z0-9]*$/")) {
        return 'Le login doit contenir uniquement des minuscules, majuscules non accentuées et des chiffres.';
    }
    else if ($user['name'] !== "" && !regex($user['name'], "/^([A-Za-zÀ-ÖØ-öø-ÿ ])*([\-'])*([A-Za-zÀ-ÖØ-öø-ÿ ])*$/")){
        return "Le nom doit contenir uniquement des minuscules, majuscules, des '-', des ' ou des espaces.";
    }
    else if ($user['firstName'] !== "" && !regex($user['firstName'], "/^([A-Za-zÀ-ÖØ-öø-ÿ ])*([\-'])*([A-Za-zÀ-ÖØ-öø-ÿ ])*$/")){
        return "Le nom doit contenir uniquement des minuscules, majuscules, des '-', des ' ou des espaces.";
    }
    else if ($user['birthDate'] !== "" && $res < 18){
        return 'Vous devez avoir au moins 18 ans pour pouvoir vous inscrire.';
    }
    else if ($user['birthDate'] !== "" && !checkdate($month,$day,$year)){
        return 'Date invalide.';
    }
    else if (($user['sex'] != "male") && ($user['sex'] != "female")) {
        return 'Le sexe est invalide.';
    }

    // If the user informations are valid return true
    return true;
}