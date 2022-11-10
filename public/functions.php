<?php
//work in progress ...

function user_registered($user_login) {
    $file = 'users/$user_login.inc.php';
    if (file_exists($file)) {
        return true;
    }
    return false;
}

function user_signup($user) {
    // Pour pouvoir recuperer les données utilisateur : include
    $user_login = $user['login'];

    $user_data = var_export($user, true);
    echo "ICI :".$user_data;

    if(!user_registered($user_login)){
        file_put_contents('../public/users/'.$user_login.'.inc.php', print_r("<?php ".$user_data."?>", true));
    }
    
}

function logout() {
    $_SESSION = array();

    session_destroy();
}

function hash_password(string $passwd){
    return password_hash($passwd, PASSWORD_ARGON2I);
}

function authentication_check(string $login, string $passwd){
    //ICI tout à refaire
    foreach ($users . $login as $user) {
        if (($user . $login === $login) && (password_verify($user . $password, $passwd))) {
            return true;
        }
    }
    return false;
}

function connection(string $login, string $passwd) { // ICI à reformuler
    if (authentication_check($login, $passwd)) {
        return true;
    }
    return false;
}

?>