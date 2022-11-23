<?php 
if(!isset($_GET['page'])){ // If the page is not defined
    $page = 'Aliment'; // Add the page to the page
}
else{ // If the page is defined
    $page = $_GET['page']; // Get the page where we are
}
?>

<?php
    //Get the recipe that corresponds with the food (page where we are)
    $Cocktail = array(); // List of cocktails to show

    foreach($Recettes as $OneRecipe => $ListInRecettes){ // For each element of the array 'Recettes'
        foreach($ListInRecettes[array_keys($ListInRecettes)[3]] as $rank => $ingredient){ // For each element of the array 'index'
            if($page == 'Aliment' && !in_array($ListInRecettes, $Cocktail)){ // If the element is the home page we need to take all the recipes 
                array_push($Cocktail, $ListInRecettes); // Add the recipe to the list of cocktails
            }
            else{ // If the element is not the page where we are we need to take all the recipes where the page where we are is in the array 'index'
                if($ingredient == $page && !in_array($ListInRecettes, $Cocktail)){ // If the element is the page where we are
                    array_push($Cocktail, $ListInRecettes); // Add the recipe to the list of cocktails
                }
            }
        }
    }
?>

<?php
    show_coktails($Coktails);
?>