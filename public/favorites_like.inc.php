<?php
session_start();

$index = null;

// if a like button is clicked, add the recipe to the favorites
if (isset($_GET['index'])) {
    if (isset($_SESSION['favorites_temp'])) {
        $index = $_SESSION['favorites_temp'];
    }
    // if the recipe is already in the favorites, remove it
    if ($index != null && in_array($_GET['index'], $index)) {
        array_splice($index, array_search($_GET['index'], $index), 1);
        if (count($index) == 0) {
            $index = null;
        }
    // else add it
    } else {
        $index[] = $_GET['index'];
    }
    // update the favorites list of the current user
    $_SESSION['favorites_temp'] = $index;
}

// update the favorites file of the current user with the new favorites list
if (isset($_SESSION['user'])) {
    file_put_contents('../public/favorites/' . $_SESSION['user']['login'] . '.favorites.inc.php', '<?php $favorites = ' . var_export($_SESSION['favorites_temp'], true) . ';');
}
