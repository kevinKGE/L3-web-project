<?php
require_once 'Donnees.inc.php';


/*******************************************/
/*        Signup and login functions        /
/*******************************************/

/** summary: create a new user
 * @param $user
 */
function user_signup($user)
{

    $user_login = $user['login'];
    $user_data = var_export($user, true);

    if (!user_registered($user_login)) {
        file_put_contents('../public/users/' . $user_login . '.inc.php', print_r("<?php \$user =" . $user_data . "?>", true));
        file_put_contents('../public/favorites/' . $user_login . '.favorites.inc.php', print_r("<?php \$favorites = array (); ?>", true));
    } else {
        // ICI marche pas bien à supp ?
        echo "Utilisateur déjà enregistré";
    }
}

/** summary: check if the user is registered and if the password is correct
 * @param $user_login
 * @param $user_password
 * @return bool or $user
 */
function login($user_login, $user_password)
{
    if (user_registered($user_login)) {
        include '../public/users/' . $user_login . '.inc.php';
        if (sha1($user_password, false) == $user['password']) {
            return $user;
        } else {
            echo 'Mauvais login mot de passe<br>';
            return false;
        }
    } else {
        echo 'Mauvais login mot de passe<br>';
        return false;
    }
}

/** summary: check if the user is registered
 * @param $user_login
 * @return bool
 */
function user_registered($user_login)
{
    $file = '../public/users/' . $user_login . '.inc.php';
    if (file_exists($file)) {
        return true;
    } else {
        return false;
    }
}

/** summary: update the user information
 * @param $user_to_modify
 */
function modify_user($user_to_modify)
{

    // if the password is empty, we keep the old one
    if ($user_to_modify['password'] === "") {
        include '../public/users/' . $user_to_modify['login'] . '.inc.php';
        $user_to_modify['password'] = $user['password'];
    } else { // else we hash the new password
        $user_to_modify['password'] = sha1($user_to_modify['password'], false);
    }

    $user_data = var_export($user_to_modify, true);
    file_put_contents('../public/users/' . $user_to_modify['login'] . '.inc.php', print_r("<?php \$user =" . $user_data . "?>", true));
}


/*******************************************/
/*            Research fuctions:            /
/*******************************************/

/**
 * @param $chain
 * @return string
 */
function replace_special_char($chain)
{ // Replace special characters by a standard characters
    $standard = array(
        // Special char
        "œ" => "oe",
        "Œ" => "Oe",
        "æ" => "ae",
        "Æ" => "Ae",
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
    $chain = strtr($chain, $standard);
    return $chain;
}

/**
 * @param $chain
 * @return string
 */
function valid_name($chain)
{
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
    $new_chain = $new_chain . $convert; // Put the abreviation a the end of the chain
    return $new_chain;  // Return the new chain witch correct format 
}

/**
 * @param $array
 * @return array
 */
function delete_duplicate_cocktails($array)
{
    // Delete duplicates recipes in the list $cocktail
    $new_arrays = array(); // New list of cocktails to display
    $unwanted_arguments = array(); // List will contain the id to avoid
    foreach ($array as $ids) { // For each list of cocktails
        if (!in_array($ids['titre'], $unwanted_arguments)) {  // Check if the cocktail by is title is in the list and if it's not in the avoid list
            $new_arrays[] = $ids; // Add the cocktail in the new list
            $unwanted_arguments[] = $ids['titre']; // Add the title of the cocktail in the avoid list 
        }
    }
    return $new_arrays; // Return the new list of cocktails
}

/**
 * @param $check
 * @return array
 */
function research_recipe($check)
{
    $curent_page = $check;
    global $Recettes, $Hierarchie, $cocktails;
    $nb_sc = array();
    $iterator = -1;


    do {
        foreach ($Recettes as $index_recipe => $recipes) {
            foreach ($recipes[array_keys($recipes)[3]] as $rank => $ingredients) {
                if ($curent_page == 'Aliment') {
                    array_push($cocktails, $recipes);
                } else if ($ingredients == $curent_page) {
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

/**
 * @param $chain, $separator
 * @return array
 */
function split_chain($chain, $separator)
{
    $array_split = array();
    $array_split = explode($separator, $chain);
    $array_split = array_filter($array_split);
    return $array_split;
}

/**
 * @param $chain
 * @return int
 */
function get_index($chain)
{
    global $Recettes;
    $res = -1;
    foreach ($Recettes as $index_recipe => $recipes) {
        foreach ($recipes as $index => $value) {
            if ($value == $chain) {
                $res = $index_recipe;
            }
        }
    }
    return $res;
}

/**
 * @param $array_includes, $array_excludes
 * @return int
 */
function get_max_score($array_includes, $array_excludes)
{
    $nb_i = 0;
    $nb_e = 0;
    $nb = 0;

    foreach ($array_includes as $index_i => $includes) {
        $nb_i = count($array_includes);
    }

    foreach ($array_excludes as $index_e => $excludes) {
        $nb_e = count($array_excludes);
    }

    $nb = $nb_i + $nb_e;
    return $nb;
}

/**
 * @param $array_includes, $array_excludes, $array_recipes
 * @return int
 */
function get_score($array_includes, $array_excludes, $array_recipes)
{
    $nb_i = 0;
    $nb_e = 0;
    $nb = 0;
    $doubles_i = array();
    $doubles_e = array();

    foreach ($array_excludes as $index_e => $excludes) {
        $nb_e = count($array_excludes);
    }

    $index = $array_recipes[array_keys($array_recipes)[3]];
    foreach ($index as $key_i => $ingredients) {
        $ingredient = strtolower($ingredients);
        foreach ($array_includes as $key_in => $includes) {
            $include = strtolower($includes);
            if (empty($doubles_i)) {
                if (strpos($ingredient, $include) !== false) {
                    $nb_i++;
                    $doubles_i[] = $include;
                }
            } else {
                foreach ($doubles_i as $key_d => $double_i) {
                    if ($include != $double_i) {
                        if (strpos($ingredient, $include) !== false) {
                            $nb_i++;
                            $doubles_i[] = $include;
                        }
                    }
                }
            }
        }
        foreach ($array_excludes as $key_ex => $excludes) {
            $exclude = strtolower($excludes);
            if (empty($doubles_e)) {
                if (strpos($ingredient, $exclude) !== false) {
                    $nb_e--;
                    $doubles_e[] = $exclude;
                }
            } else {
                foreach ($doubles_e as $key_d => $double_e) {
                    if ($exclude != $double_e) {
                        if (strpos($ingredient, $exclude) !== false) {
                            $nb_e--;
                            $doubles_e[] = $exclude;
                        }
                    }
                }
            }
        }
    }

    $nb = $nb_i + $nb_e;
    return $nb;
}
