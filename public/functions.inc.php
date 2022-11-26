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
        if($user['password'] == $user_password) {
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
    return password_hash($passwd, PASSWORD_ARGON2I);
}

function modify_user($user) {

    var_dump($user);

    $user_data = var_export($user, true);

   file_put_contents('../public/users/'.$user['login'].'.inc.php', print_r("<?php \$user =".$user_data."?>", true));
    
}

function replace_special_char($chain) { // Replace special characters by a standard characters
    $standard = array( 
            // Special char
            "œ"=>"oe",
            "Œ"=>"Oe",
            "æ"=>"ae",
            "Æ"=>"Ae",
            // A
            "À" => "A",
            "Á" => "A",
            "Â" => "A",
            "à" => "A",
            "Ä" => "A",
            "Å" => "A",
            "à" => "a",
            "á" => "a",
            "â" => "a",
            "à" => "a",
            "ä" => "a",
            "å" => "a",
            // C
            "Ç" => "C",
            "ç" => "c",
            // D
            "Ð" => "D",
            // E
            "È" => "E",
            "É" => "E",
            "Ê" => "E",
            "Ë" => "E",
            "è" => "e",
            "é" => "e",
            "ê" => "e",
            "ë" => "e",
            // I
            "Ì" => "I",
            "Í" => "I",
            "Î" => "I",
            "Ï" => "I",
            "ì" => "i",
            "í" => "i",
            "î" => "i",
            "ï" => "i",
            // N
            "Ñ" => "N",
            "ñ" => "n",
            // O
            "Ò" => "O",
            "Ó" => "O",
            "Ô" => "O",
            "Õ" => "O",
            "Ö" => "O",
            "Ø" => "O",
            "ò" => "o",
            "ó" => "o",
            "ô" => "o",
            "õ" => "o",
            "ö" => "o",
            "ø" => "o",
            "ð" => "o",
            // U
            "Ù" => "U",
            "Ú" => "U",
            "Û" => "U",
            "Ü" => "U",
            "ù" => "u",
            "ú" => "u",
            "û" => "u",
            "ü" => "u",
            // Y
            "Ý" => "Y",
            "ý" => "y",
            "ÿ" => "y",
            );
        $chain = strtr($chain,$standard);
        return $chain;
    }

    function valid_name($chain) { // Put the name of the cocktail in the right format to have the corresponding picture
        $patterns = array( 
            0 => '/[^a-zA-Z]/',
            1 => '/_/',
        ); 
        $new_chain = preg_replace($patterns, '', $chain); // Delete special characters / Allows only a-z, A-Z, _ 
        $new_chain = replace_special_char($chain); // Replace special characters in the chain by a standard characters
        $new_chain = strtolower($new_chain); // Put the chain in lowercase
        $new_chain = ucfirst($new_chain); // Put the first caracters of the chain in capital
        $new_chain = str_replace(' ', '_', $new_chain); // Replace the blank by _
        $convert = '.jpg'; 
        $new_chain = $new_chain.$convert; // Put the abreviation a the end of the chain
        return $new_chain;
    }

?>
