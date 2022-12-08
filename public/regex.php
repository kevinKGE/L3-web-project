<?php

function regex($value, $regex) {
    return preg_match($regex, $value);
}

function validate_format($user){

    $date_of_the_day = date("Y-m-d");

    $date_of_birth = $user['birthDate'];
    // ICI test à supprimer
    echo $date_of_the_day."<br>";
    echo $date_of_birth."<br>";

    // soustrait les deux dates:
    $res = ($date_of_the_day - $date_of_birth);

    echo $res."<br>";

    if ($user['login'] === "" || !regex($user['login'], "/^[a-zA-Z0-9]*$/")) {
        return 'le login doit contenir uniquement des minuscules, majuscules non accentuées et des chiffres';
    }
    else if ($user['name'] !== "" && !regex($user['name'], "/^([A-Za-zÀ-ÖØ-öø-ÿ']+((\-)*[A-Za-zÀ-ÖØ-öø-ÿ']+)*)$/")){
        return 'le nom doit contenir uniquement des minuscules, majuscules, des '-', des " \' " ou des espaces';
    }
    else if ($user['firstName'] !== "" && !regex($user['firstName'], "/^([A-Za-zÀ-ÖØ-öø-ÿ']+((\-)*[A-Za-zÀ-ÖØ-öø-ÿ']+)*)$/")){
        return 'le nom doit contenir uniquement des minuscules, majuscules, des '-', des " \' " ou des espaces';
    }
    else if ($user['birthDate'] !== "" && $res < 18){
        return 'vous devez avoir au moins 18 ans pour pouvoir vous inscrire';
    }

    return true;
    
}