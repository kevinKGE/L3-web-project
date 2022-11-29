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

    $cocktails = Tourner_Recettes($curent_page);

    var_dump($cocktails);
    echo"<br>";


    // Delete duplicates recipes in the list $cocktail
    $new_cocktails = array(); // New list of cocktails to show
    $unwanted_arguments = array(); // List will contain the id to avoid
    foreach($cocktails as $ids){
        if(!in_array($ids['titre'], $unwanted_arguments)){ 
            $new_cocktails[] = $ids;
            $unwanted_arguments[] = $ids['titre'];   
        }
    }

  require_once 'show.php'; // Show the cocktails
?>

