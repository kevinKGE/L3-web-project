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

function Transformation_Fromat($element){// Change the format of the name of cocktails to have the good pictures

}

function getCurrentUser(){
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return false;
}

function buildPath($path) {
    return _DIR_ . "/../../users/" . $file; 
}

function save($path, $data) {
    $path = buildPath($path);
    if($data == NULL){
        unlink($path); } //delete file
    else {
        file_put_contents($path, serialize($data)); } //save file
    
}

function exists($path) { 
    $path = buildPath($path);
    return file_exists($path);
}

function get($path) {
    $path = buildPath($path);
    $rawdata = file_get_contents($path);
    $data = json_decode($rawdata, true);
   return $data;
}

?>