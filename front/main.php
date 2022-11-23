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
                //var_dump($ListInRecettes);
            }
            else{ // If the element is not the page where we are we need to take all the recipes where the page where we are is in the array 'index'
                if($ingredient == $page && !in_array($ListInRecettes, $Cocktail)){ // If the element is the page where we are
                    array_push($Cocktail, $ListInRecettes); // Add the recipe to the list of cocktails
                    //var_dump($ListInRecettes);
                }else{ //il faut regarder si la page actuelle est une super categorie et si oui, il faut mettre toutes les recettes dispo dans cette categories.
                    /*$ListRecipe=$Hierarchie[$_GET['page']];
                    if($page = $ListRecipe){
                        foreach ($ListRecipe as $key => $SC) { // For each element of the array 'ListRecipe', SC = sous-categorie
                            if($key == "super-categorie"){ // If the element is a super-category
                                foreach($SC as $indice => $Fruit) { // For each element of the array 'sous-categorie'
                                    if($ingredient == $Fruit && !in_array($ListInRecettes, $Cocktail)){
                                        array_push($Cocktail, $ListInRecettes); // Add the recipe to the list of cocktails
                                        var_dump($Cocktail);
                                    }
                                }
                            }
                        }
                    }*/
                }
            }
        }
    }
?>

<?php
    //show_coktails($Coktails);
?>