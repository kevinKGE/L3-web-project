<?php 
if(!isset($_GET['page'])){ // If the page is not defined
    $curent_page = 'Aliment'; // Add the page to the page
}
else{ // If the page is defined
    $curent_page = $_GET['page']; // Get the page where we are
}
?>

<?php
    //Get the recipe that corresponds with the ingredients (page where we are)
    $cocktails = array(); // List of cocktails to show

    foreach($Recettes as $index_recipe => $recipes){ // For each element of the array 'Recettes'
        foreach($recipes[array_keys($recipes)[3]] as $rank => $ingredients){ // For each element of the array 'index'
            if($curent_page == 'Aliment' && !in_array($recipes, $cocktails)){ // If the element is the home page we need to take all the recipes 
                array_push($cocktails, $recipes); // Add the recipe to the list of cocktails
            }
            else{ // If the element is not the page where we are we need to take all the recipes where the page where we are is in the array 'index'
                if($ingredients == $curent_page){ // If the element is the page where we are
                    if(!in_array($recipes, $cocktails)){
                        array_push($cocktails, $recipes); // Add the recipe to the list of cocktails
                    }
                }else{  
                    if (isset($Hierarchie[$ingredients]['super-categorie'])){ // If it's a 'super-categorie'
                        $check = $Hierarchie[$ingredients]['super-categorie'][0]; // Get the super-category of the ingredient
                    }
                    while(isset($Hierarchie[$check]['super-categorie'])) {  // While the super-category is not empty
                        if ($check == $curent_page){
                            if(!in_array($recipes, $cocktails)){
                                array_push($cocktails, $recipes); // Add the recipe to the list of cocktails
                            }
                        }
                        $check = $Hierarchie[$check]['super-categorie'][0]; //iteration
                    }
                }
            }
        }
    }

    // Delete duplicates recipes in the list $cocktail
    $new_cocktails = array(); // New list of cocktails to show
    $unwanted_arguments = array(); // List will contain the id to avoid
    foreach($cocktails as $ids){
        if(!in_array($ids['titre'], $unwanted_arguments)){ 
            $new_cocktails[] = $ids;
            $unwanted_arguments[] = $ids['titre'];   
        }
    }
?>

<?php
   require_once 'show.php';
?>