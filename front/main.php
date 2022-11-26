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
                if($ingredient == $page){ // If the element is the page where we are
                    if(!in_array($ListInRecettes, $Cocktail)){
                        array_push($Cocktail, $ListInRecettes); // Add the recipe to the list of cocktails
                    }
                }else{  
                    if (isset($Hierarchie[$ingredient]['super-categorie'])){ // If it's a 'super-categorie'
                        $Check = $Hierarchie[$ingredient]['super-categorie'][0]; // Get the super-category of the ingredient
                    }
                    while(isset($Hierarchie[$Check]['super-categorie'])) {  // While the super-category is not empty
                        if ($Check == $page){
                            if(!in_array($ListInRecettes, $Cocktail)){
                                array_push($Cocktail, $ListInRecettes); // Add the recipe to the list of cocktails
                            }
                        }
                        $Check = $Hierarchie[$Check]['super-categorie'][0]; //iteration
                    }
                }
            }
        }
    }

    // Delete duplicates recipes in the list $cocktail
    $NewCocktailArray = array(); // New list of cocktails to show
    $WasteArgument = array(); // List will contain the id to avoid
    foreach($Cocktail as $Id){
        if(!in_array($Id['titre'], $WasteArgument)){ 
            $NewCocktailArray[] = $Id;
            $WasteArgument[] = $Id['titre'];   
        }
    }
    var_dump($NewCocktailArray);

    
?>

<?php
   // require_once();
?>