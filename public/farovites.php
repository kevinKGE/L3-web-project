<?php 
/*
Salut Romain, je pense qu'ici il faudra faire des tableaux de 
cocktails en association avec les users, à voir comment on peut faire ça

ou

Sinon il faudrait juste donner à chaque user un array() de favoris ... on en discutera
*/

function addFavorite($favorite)
{
    $user = getCurrentUser(); //Recupérer les information de l'utilisateur si connecté

    if ($user) {
        // Si l'utilateur est connecté, on stocke les favoris dans un fichier permanent situé en ...

        $favoritesList = []; // We create an array to store the favorites of the user

        $login = $user["login"]; // We get the login of the user

        if (exist("favorite/$login")) { // If the file exists
            $favoritesList = get("favorite/$login"); // We get the favorites of the user
        }
        
        $favoritesList[] = $favorite;

        save("favorite/$login", $favoritesList);
    } else {
        //if the user is not connected, we store the favorites in a session variable
        $favoritesList = getFavorite();

        $favoritesList[] = $favorite;

        setcookie("favorite", serialize($favoritesList), 2147483647, '/'); 
    }
}

function deleteFavorite($favorite)  
{
    $user = getCurrentUser();
    $favoritesList = getFavorite();
    $favoritesList = array_diff($favoritesList, [$favorite]);

    if ($user) {
        $login = $user["login"];

        save("favorite/$login", $favoritesList);
    } else {
        setcookie("favorite", serialize($favoritesList), 2147483647, '/');
    }
}


function getFavorite()
{
    $user = getCurrentUser();

    if ($user) {
        $login = $user["login"];
        $favoritesList = [];

        if (exist("favorite/$login")) {
            $favoritesList = get("favorite/$login");
        }
        return $favoritesList;
    } else {
        $favoritesList = isset($_COOKIE["favorite"]) ? unserialize($_COOKIE["favorite"]) : [];

        if (!is_array($favoritesList))
            return []; // force the array type

        return $favoritesList;
    }
}

?>