<?php
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

function user_signup($users, $user){
    // if(!user_already_registered($user)){

        array_push($users, $user);
        file_put_contents('../public.users.inc.php', print_r($users, true));
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

/*function show_coktails($coktails, $ingredients){
    foreach ($coktails as $coktail){
        echo '<div class="coktail">';
        echo '<h2>'.$coktail['name'].'</h2>';
        echo '<img src="'.$coktail['image'].'" alt="'.$coktail['name'].'">';
        echo '<p>'.$coktail['description'].'</p>';
        echo '<ul>';
        foreach ($coktail['ingredients'] as $ingredient){
            echo '<li>'.$ingredients[$ingredient]['name'].'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}*/

?>