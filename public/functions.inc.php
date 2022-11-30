<?php

function user_signup($user) {
    // Pour pouvoir recuperer les données utilisateur : include
    $user_login = $user['login'];
    // ICI a finir
    //hashage du mot de passe
    echo ($user['password']);   
    // $user['password'] = hash_password($user['password']);

    $user_data = var_export($user, true);

    if(!user_registered($user_login)){
        file_put_contents('../public/users/'.$user_login.'.inc.php', print_r("<?php \$user =".$user_data."?>", true));
    } else {
        echo "User already registered";
    }
}

function login($user_login, $user_password) {
    if(user_registered($user_login)) {
        include '../public/users/'.$user_login.'.inc.php';
        var_dump($user);
        echo "password:".$user['password'].'<br>';
        if(check_password($user_password, $user['password'])) {
            echo 'Connexion réussie</br>';
            return $user;
        } else {
            echo 'Mauvais mot de passe</br>';
            return false;
        }
    } else {
        echo 'Utilisateur non enregistré</br>';
        return false;
    }
}

function logout() {
    echo "déconnexion PHP</br>";

    $_SESSION = array();
    session_destroy();

    header("Refresh:0");
}

function user_registered($user_login) {
    $file = '../public/users/'.$user_login.'.inc.php';
    if (file_exists($file)) {
       return true;
    } else {
        return false;
    }
}

function hash_password(string $passwd){
    return password_hash($passwd, PASSWORD_DEFAULT);
}

function check_password(string $passwd, string $hash){
    return password_verify($passwd, $hash);
}

function modify_user($user) {

    var_dump($user);

    $user_data = var_export($user, true);

   file_put_contents('../public/users/'.$user['login'].'.inc.php', print_r("<?php \$user =".$user_data."?>", true));
    
}

?>