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

    research_recipe($curent_page); // Get the recipe that corresponds with the ingredients (page where we are)
    $cocktails = delete_duplicate_cocktails($cocktails); // Delete the duplicate cocktails in the list to show   

  require_once 'show.php'; // Show the cocktails
?>

