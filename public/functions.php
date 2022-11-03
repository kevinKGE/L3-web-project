<?php
require_once 'users.inc.php';

//work in progress ...

function user_already_registered($email) {
    foreach($users as $user){
        // if ($email === $user.$email) {
        if (strcasecmp($email, $user.'email')) {
            return true;
        }
    }
    return false;
}


function user_signup($user){
    // if(!user_already_registered($user)){
        array_push($users, $user); // ICI argument 1 null ???
    // }
}

function logout(){
    $_SESSION = array();

    session_destroy();
}

function hash_password(string $passwd){
    return password_hash($passwd, PASSWORD_ARGON2I);
}

function authentication_check(string $login, string $passwd){
// ICI email != username : à régler
    foreach ($users.$email as $user){
        if(($user.$email === $login) && (password_verify($user.$password, $passwd))){
            return true;
        }
    }
    return false;
}

function connection(string $login, string $passwd){ // ICI à reformuler
    if (authentication_check($login, $passwd)){
        return true;
    }
    return false;
}

function essai() {
    return 0;
}

