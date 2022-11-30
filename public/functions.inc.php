<?php
require_once 'Donnees.inc.php';
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

    function valid_name($chain) { 
        // Put the name of the cocktail in the right format to have the corresponding picture
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
        return $new_chain;  // Return the new chain witch correct format 
    }

    function delete_duplicate_cocktails($array){
        // Delete duplicates recipes in the list $cocktail
        $new_arrays = array(); // New list of cocktails to show
        $unwanted_arguments = array(); // List will contain the id to avoid
        foreach($array as $ids){ // For each list of cocktails
            if(!in_array($ids['titre'], $unwanted_arguments)){  // Check if the cocktail by is title is in the list and if it's not in the avoid list
                $new_arrays[] = $ids; // Add the cocktail in the new list
                $unwanted_arguments[] = $ids['titre']; // Add the title of the cocktail in the avoid list 
            }
        }
        return $new_arrays; // Return the new list of cocktails
    }

    function research_recipe($check)
    {
        $curent_page = $check;
        global $Recettes, $Hierarchie, $cocktails;
        $nb_sc = array();
        $iterator = -1;
        
    
        do {
            foreach ($Recettes as $index_recipe => $recipes) {                                    
                foreach ($recipes[array_keys($recipes)[3]] as $rank => $ingredients) { 
                    if($curent_page == 'Aliment'){
                        array_push($cocktails, $recipes);
                    }else if ($ingredients == $curent_page) {               
                        if (!isset($cocktails)) { 
                            array_push($cocktails, $recipes);                                             
                        } elseif (!in_array($recipes, $cocktails)) {                            
                            array_push($cocktails, $recipes);                 
                        }
                    }
                    if (isset($Hierarchie[$check]['sous-categorie'])) {                                       
                        foreach ($Hierarchie[$check]['sous-categorie'] as $index_sc => $sc) {    
                            if (!isset($nb_sc)) { 
                                array_push($nb_sc, $sc);                                        
                            } else if (!in_array($sc, $nb_sc)) {                        
                                array_push($nb_sc, $sc);                                     
                            }
                            if ($ingredients == $sc) {                             
                                if (!isset($cocktails)) { 
                                    array_push($cocktails, $recipes);                                   
                                } else if (!in_array($recipes, $cocktails)) {                    
                                    array_push($cocktails, $recipes);                                             
                                }
                            }
                        }
                    }
                }
            }
    
            $iterator++;                                                                               
            if (isset($nb_sc[$iterator])) {                                                               
                $Hierarchie[$check] = $Hierarchie[$nb_sc[$iterator]];                                                   
            }
            
        } while ($iterator < count($nb_sc));                                                               
    }

    ?>
