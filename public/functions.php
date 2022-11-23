<?php
//work in progress ...

function user_registered($user_login) {
    $file = '../public/users/'.$user_login.'.inc.php';
    if (file_exists($file)) {
        echo 'true';
    } else {
        echo 'false';
    }
}

function user_signup($user) {
    // Pour pouvoir recuperer les données utilisateur : include
    $user_login = $user['login'];

    $user_data = var_export($user, true);

    if(!user_registered($user_login)){
        file_put_contents('../public/users/'.$user_login.'.inc.php', print_r("<?php ".$user_data."?>", true));
    } else {
        echo "User already registered";
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